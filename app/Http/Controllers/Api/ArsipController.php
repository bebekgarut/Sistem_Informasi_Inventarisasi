<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use App\Models\ArsipFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index()
    {
        $arsip = Arsip::with('files')->paginate(50);
        return response()->json($arsip);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_subjek' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'files.*' => 'nullable|mimes:pdf|max:25000',
        ]);

        $arsip = Arsip::create($request->only('nama_subjek', 'alamat'));

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filepath = 'private/arsip/' . $filename . '.' . $extension;
                $counter = 1;

                while (Storage::exists($filepath)) {
                    $filepath = 'private/arsip/' . $filename . "($counter)." . $extension;
                    $counter++;
                }

                $file->storeAs('private/arsip', basename($filepath));

                $arsip->files()->create(['file_path' => $filepath]);
            }
        }
        return response()->json("data berhasil ditambahkan");
    }

    public function hapusFileEdit($id)
    {
        try {
            $file = ArsipFile::findOrFail($id);

            $filePath = storage_path('app/public/' . $file->file_path);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $deleted = $file->delete();

            if (!$deleted) {
                return redirect()->route('arsip')->with('error', 'Data tidak ditemukan');
            }

            return back()->with('success', 'File berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_subjek' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'files.*' => 'nullable|mimes:pdf|max:25000',
        ]);

        $arsip = Arsip::findOrFail($id);

        $arsip->update($request->only('nama_subjek', 'alamat'));

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filepath = 'private/arsip/' . $filename . '.' . $extension;
                $counter = 1;

                while (Storage::exists($filepath)) {
                    $filepath = 'private/arsip/' . $filename . "($counter)." . $extension;
                    $counter++;
                }

                $file->storeAs('private/arsip', basename($filepath));

                $arsip->files()->create(['file_path' => $filepath]);
            }
        }
        return response()->json("data berhasil diupdate");
    }

    public function destroy($id)
    {
        try {
            $arsip = Arsip::with('files')->findOrFail($id);

            foreach ($arsip->files as $file) {
                $filePath = storage_path('app/public/' . $file->file_path);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $file->delete();
            }
            $arsip->delete();
            return response()->json("data berhasil ditambahkan");
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }
}
