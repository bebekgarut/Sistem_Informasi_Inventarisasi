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
        $arsip = Arsip::with('files')->paginate(50);
        return view('arsip.index-arsip', compact('arsip'));
    }

    public function tambah()
    {
        return view('arsip.tambah-arsip');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_subjek' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'files.*' => 'nullable|mimes:pdf|max:10000',
        ]);

        $arsip = Arsip::create($request->only('nama_subjek', 'alamat'));


        // Tambahkan file baru
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filepath = 'private/arsip/' . $filename . '.' . $extension;
                $counter = 1;

                // Cek apakah file dengan nama yang sama sudah ada
                while (Storage::exists($filepath)) {
                    // Jika file ada, tambahkan angka dalam kurung
                    $filepath = 'private/arsip/' . $filename . "($counter)." . $extension;
                    $counter++;
                }

                // Simpan file baru ke dalam storage
                $file->storeAs('private/arsip', basename($filepath));

                // Simpan path yang benar ke dalam database
                $arsip->files()->create(['file_path' => $filepath]);
            }
        }

        return redirect()->route('arsip')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        try {
            $arsip = Arsip::with('files')->findOrFail($id);
            return view('arsip.edit-arsip', compact('arsip'));
        } catch (\Exception $e) {
            return redirect()->route('arsip')->with('error', 'Data tidak ditemukan');
        }
    }

    public function hapusFileEdit($id)
    {
        try {
            // Temukan file berdasarkan ID
            $file = ArsipFile::findOrFail($id);

            // Dapatkan path file di storage
            $filePath = storage_path('app/public/' . $file->file_path);

            // Hapus file dari storage
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus data file dari database
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
        // Validasi input
        $request->validate([
            'nama_subjek' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'files.*' => 'nullable|mimes:pdf|max:10000',
        ]);

        $arsip = Arsip::findOrFail($id);

        // Update data arsip (nama_subjek dan alamat)
        $arsip->update($request->only('nama_subjek', 'alamat'));

        // Tambahkan file baru
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $filepath = 'private/arsip/' . $filename . '.' . $extension;
                $counter = 1;

                // Cek apakah file dengan nama yang sama sudah ada
                while (Storage::exists($filepath)) {
                    // Jika file ada, tambahkan angka dalam kurung
                    $filepath = 'private/arsip/' . $filename . "($counter)." . $extension;
                    $counter++;
                }

                // Simpan file baru ke dalam storage
                $file->storeAs('private/arsip', basename($filepath));

                // Simpan path yang benar ke dalam database
                $arsip->files()->create(['file_path' => $filepath]);
            }
        }

        return redirect()->route('arsip')->with('success', 'Data arsip berhasil diperbarui.');
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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $arsip = Arsip::with('files')
            ->where('nama_subjek', 'like', "%$keyword%")
            ->orWhere('alamat', 'like', "%$keyword%")
            ->orWhereHas('files', function ($query) use ($keyword) {
                $query->where('file_path', 'like', "%$keyword%");
            })
            ->paginate(50);

        return view('arsip.index-arsip', compact('arsip'));
    }

    public function hapusArsip($id)
    {
        try {
            // Temukan arsip berdasarkan ID beserta file yang terkait
            $arsip = Arsip::with('files')->findOrFail($id);

            // Loop melalui setiap file yang terkait dan hapus file dari storage
            foreach ($arsip->files as $file) {
                $filePath = storage_path('app/public/' . $file->file_path);

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                // Hapus data file dari database
                $file->delete();
            }

            // Hapus data arsip dari database
            $arsip->delete();

            return redirect()->route('arsip')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
