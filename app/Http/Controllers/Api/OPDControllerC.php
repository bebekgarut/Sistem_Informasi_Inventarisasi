<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibc;
use App\Models\Subunit;
use App\Models\UPB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OPDControllerC extends Controller
{
    public function getKIBC($kode_upb)
    {
        $kibc = Kibc::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibc);
    }


    public function showKibc($kode_upb, $id)
    {
        $kibc = Kibc::where('KODE_UPB', $kode_upb)
            ->where('id', $id)->get();
        return response()->json($kibc);
    }

    public function store(Request $request, $kode_upb)
    {
        $validatedData = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'KONDISI_BANGUNAN' => 'nullable|string|max:255',
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
            'DOWNLOAD' => 'nullable|file|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ]);

        $upb = UPB::where('KODE_UPB', $kode_upb)->first();
        $validatedData['KODE_BIDANG'] = $upb->KODE_BIDANG;
        $validatedData['KODE_UNITS'] = $upb->KODE_UNITS;
        $validatedData['KODE_SUB_UNITS'] = $upb->KODE_SUB_UNITS;
        $validatedData['KODE_UPB'] = $kode_upb;

        $sub_unit = SubUnit::where('KODE_SUB_UNITS', $upb->KODE_SUB_UNITS)->first();
        $validatedData['PENGGUNA_BARANG'] = $sub_unit->NAMA_SUB_UNITS;

        if ($request->hasFile('FOTO')) {
            $path = $request->file('FOTO')->store('private/photos', 'public');
            $validatedData['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            $path = $request->file('DOWNLOAD')->store('private/files', 'public');
            $validatedData['DOWNLOAD'] = $path;
        }
        try {
            Kibc::create($validatedData);
            return response()->json(['message' => 'Data berhasil ditambahkan',]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $KODE_UPB, $id)
    {
        $validatedDatac = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'KONDISI_BANGUNAN' => 'nullable|string|max:255',
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
            'DOWNLOAD' => 'nullable|file|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ]);

        $kibc = Kibc::findOrFail($id);

        if ($request->hasFile('FOTO')) {
            if ($kibc && $kibc->FOTO) {
                Storage::delete($kibc->FOTO);
            }
            $path = $request->file('FOTO')->store('private/photos');
            $validatedDatac['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            if ($kibc && $kibc->DOWNLOAD) {
                Storage::delete($kibc->DOWNLOAD);
            }
            $path = $request->file('DOWNLOAD')->store('private/files');
            $validatedDatac['DOWNLOAD'] = $path;
        }

        try {
            DB::table('kibcs')->where('id', $id)->where('KODE_UPB', $KODE_UPB)->update($validatedDatac);
            return response()->json('berhasil mengubah data');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($kode_upb, $id)
    {
        $kibc = Kibc::findOrFail($id);

        try {
            if ($kibc && $kibc->FOTO) {
                Storage::delete($kibc->FOTO);
            }

            if ($kibc && $kibc->DOWNLOAD) {
                Storage::delete($kibc->DOWNLOAD);
            }
            Kibc::where('id', $id)->where('KODE_UPB', $kode_upb)->delete();

            return response()->json("data berhasil dihapus");
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'gagal menghapus data',
                'error' => $e->getMessage()
            ]);
        }
    }
}
