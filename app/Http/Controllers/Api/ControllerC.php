<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ControllerC extends Controller
{
    public function getKIBC($kode_upb)
    {
        $kibc = Kibc::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibc);
    }

    public function showKIBC($id)
    {
        $kibc = Kibc::findOrFail($id);
        return response()->json($kibc);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'KONDISI_BANGUNAN' => 'nullable|string|string|max:255',
            'BANGUNAN_BERTINGKAT' => 'nullable|string|max:255',
            'BANGUNAN_BETON' => 'nullable|string|max:255',
            'LUAS_LANTAI' => 'nullable|numeric',
            'LETAK_ALAMAT' => 'nullable|string|max:255',
            'TANGGAL_DOKUMEN' => 'nullable|date',
            'NOMOR_DOKUMEN' => 'nullable|string|max:255',
            'LUAS' => 'nullable|numeric',
            'STATUS_TANAH' => 'nullable|string|max:255',
            'NOMOR_KODE_TANAH' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'ASAL_USUL' => 'nullable|string|max:255',
            'KETERANGAN' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
            'KODE_BIDANG' => 'required|numeric|exists:bidangs,KODE_BIDANG',
            'KODE_UNITS' => 'required|numeric|exists:units,KODE_UNITS',
            'KODE_SUB_UNITS' => 'required|numeric|exists:subunits,KODE_SUB_UNITS',
            'KODE_UPB' => 'required|numeric|exists:upbs,KODE_UPB',
            'PENGGUNA_BARANG' => 'required|string|max:100||exists:subunits,NAMA_SUB_UNITS'
        ]);

        if ($request->hasFile('FOTO')) {
            $path = $request->file('FOTO')->store('private/photos');
            $data['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            $path = $request->file('DOWNLOAD')->store('private/files');
            $data['DOWNLOAD'] = $path;
        }
        try {
            Kibc::create($data);
            return response()->json(['message' => 'Data berhasil ditambahkan',]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $datac = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'KONDISI_BANGUNAN' => 'nullable|string|string|max:255',
            'BANGUNAN_BERTINGKAT' => 'nullable|string|max:255',
            'BANGUNAN_BETON' => 'nullable|string|max:255',
            'LUAS_LANTAI' => 'nullable|numeric',
            'LETAK_ALAMAT' => 'nullable|string|max:255',
            'TANGGAL_DOKUMEN' => 'nullable|date',
            'NOMOR_DOKUMEN' => 'nullable|string|max:255',
            'LUAS' => 'nullable|numeric',
            'STATUS_TANAH' => 'nullable|string|max:255',
            'NOMOR_KODE_TANAH' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'ASAL_USUL' => 'nullable|string|max:255',
            'KETERANGAN' => 'nullable|string|max:255',
            'FOTO' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
            'DOWNLOAD' => 'mimes:pdf|max:4096'
        ]);

        $oldData = Kibc::findOrFail($id);

        if ($request->hasFile('FOTO')) {
            if ($oldData && $oldData->FOTO) {
                Storage::delete($oldData->FOTO);
            }
            $file = $request->file('FOTO');
            $path = $file->store('private/photos');
            $datac['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            if ($oldData && $oldData->DOWNLOAD) {
                Storage::delete($oldData->DOWNLOAD);
            }
            $file = $request->file('DOWNLOAD');
            $path = $file->store('private/files');
            $datac['DOWNLOAD'] = $path;
        }

        try {
            $kibc = Kibc::findOrFail($id);
            $kibc->update($datac);
            return response()->json(['message' => 'Data berhasil diubah',]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengubah data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $kibc = Kibc::findOrFail($id);

            if ($kibc && $kibc->FOTO) {
                Storage::delete($kibc->FOTO);
            }

            if ($kibc && $kibc->DOWNLOAD) {
                Storage::delete($kibc->DOWNLOAD);
            }

            Kibc::where('id', $id)->delete();

            return response()->json('data berhasil dihapus');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $kibc = Kibc::where('NAMA_BARANG', 'like', "%$keyword%")
            ->orWhere('KODE_BARANG', 'like', "%$keyword%")
            ->orWhere('NOMOR_REGISTER', 'like', "%$keyword%")
            ->orWhere('KONDISI_BANGUNAN', 'like', "%$keyword%")
            ->orWhere('BANGUNAN_BERTINGKAT', 'like', "%$keyword%")
            ->orWhere('BANGUNAN_BETON', 'like', "%$keyword%")
            ->orWhere('LUAS_LANTAI', 'like', "%$keyword%")
            ->orWhere('LETAK_ALAMAT', 'like', "%$keyword%")
            ->orWhere('TANGGAL_DOKUMEN', 'like', "%$keyword%")
            ->orWhere('NOMOR_DOKUMEN', 'like', "%$keyword%")
            ->orWhere('LUAS', 'like', "%$keyword%")
            ->orWhere('STATUS_TANAH', 'like', "%$keyword%")
            ->orWhere('NOMOR_KODE_TANAH', 'like', "%$keyword%")
            ->orWhere('ASAL_USUL', 'like', "%$keyword%")
            ->orWhere('HARGA', 'like', "%$keyword%")
            ->orWhere('KETERANGAN', 'like', "%$keyword%")
            ->orWhere('PENGGUNA_BARANG', 'like', "%$keyword%")
            ->paginate(50);
        return response()->json($kibc);
    }
}
