<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\ArsipFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArsipController extends Controller
{
    public function index()
    {
        $arsip = Arsip::with('files')->get();
        return view('arsip.index-arsip', compact('arsip'));
    }

    public function tambah()
    {
        return view('arsip.tambah-arsip');
    }

    public function store(Request $request)
    {
        $arsip = Arsip::create($request->only('nama_subjek', 'alamat'));

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $randomString = Str::random(2);
                $filename = $randomString . '_' . $file->getClientOriginalName();
                $filepath = 'private/arsip/' . $filename;

                // Menyimpan file PDF dengan nama asli (ditambah string acak untuk menghindari konflik nama)
                $file->storeAs('private/arsip', $filename);

                // Simpan path yang benar ke dalam database
                $arsip->files()->create(['file_path' => $filepath]);
            }
        }

        return redirect()->route('arsip');
    }

    public function edit($id)
    {
        $arsip = Arsip::findorFail($id);
        $file = ArsipFile::where('arsip_id', $id);
        return view('arsip.edit-arsip', compact('arsip', 'file'));
    }

    public function showFile($filename)
    {
        $path = 'private/arsip/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $file = Storage::get($path);
        $mimeType = Storage::mimeType($path);

        return response($file, 200)->header('Content-Type', $mimeType);
    }
}
