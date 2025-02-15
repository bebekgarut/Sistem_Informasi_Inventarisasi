<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kiba;
use App\Models\Subunit;
use App\Models\UPB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class OPDControllerA extends Controller
{
    public function getKIBA($kode_upb)
    {
        $kiba = Kiba::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kiba);
    }

    public function showKiba($kode_upb, $id)
    {
        $kiba = Kiba::where('KODE_UPB', $kode_upb)
            ->where('id', $id)->get();
        return response()->json($kiba);
    }

    public function store(Request $request, $kode_upb)
    {
        $validatedData = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:255',
            'LUAS' => 'nullable|numeric',
            'TAHUN_PENGADAAN' => 'nullable|date_format:Y',
            'LETAK_ALAMAT' => 'nullable|string|max:255',
            'HAK' => 'nullable|string|max:255',
            'TANGGAL_SERTIFIKAT' => 'nullable|date',
            'NO_SERTIFIKAT' => 'nullable|string|max:255',
            'PENGGUNAAN' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|string|max:255',
            'KOORDINAT' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
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
            Kiba::create($validatedData);
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
        $validatedData = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:255',
            'LUAS' => 'nullable|numeric',
            'TAHUN_PENGADAAN' => 'nullable|date_format:Y',
            'LETAK_ALAMAT' => 'nullable|string|max:255',
            'HAK' => 'nullable|string|max:255',
            'TANGGAL_SERTIFIKAT' => 'nullable|date',
            'NO_SERTIFIKAT' => 'nullable|string|max:255',
            'PENGGUNAAN' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|string|max:255',
            'KOORDINAT' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|file|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ]);

        $kiba = Kiba::findOrFail($id);

        if ($request->hasFile('FOTO')) {
            if ($kiba && $kiba->FOTO) {
                Storage::delete($kiba->FOTO);
            }
            $path = $request->file('FOTO')->store('private/photos');
            $validatedData['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            if ($kiba && $kiba->DOWNLOAD) {
                Storage::delete($kiba->DOWNLOAD);
            }
            $path = $request->file('DOWNLOAD')->store('private/files');
            $validatedData['DOWNLOAD'] = $path;
        }

        try {
            DB::table('kibas')->where('id', $id)->where('KODE_UPB', $KODE_UPB)->update($validatedData);
            return response()->json("data berhasil diubah");
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengubah data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($kode_upb, $id)
    {
        try {
            $kiba = Kiba::findOrFail($id);

            if ($kiba && $kiba->FOTO) {
                Storage::delete($kiba->FOTO);
            }

            if ($kiba && $kiba->DOWNLOAD) {
                Storage::delete($kiba->DOWNLOAD);
            }

            Kiba::where('id', $id)->where('KODE_UPB', $kode_upb)->delete();

            return response()->json("data berhasil dihapus");
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request, $kode_upb)
    {
        $keyword = $request->input('keyword');

        $kiba = Kiba::where('KODE_UPB', $kode_upb)
            ->where(function ($query) use ($keyword) {
                $query->where('NAMA_BARANG', 'like', "%$keyword%")
                    ->orWhere('KODE_BARANG', 'like', "%$keyword%")
                    ->orWhere('NOMOR_REGISTER', 'like', "%$keyword%")
                    ->orWhere('LUAS', 'like', "%$keyword%")
                    ->orWhere('TAHUN_PENGADAAN', 'like', "%$keyword%")
                    ->orWhere('LETAK_ALAMAT', 'like', "%$keyword%")
                    ->orWhere('HAK', 'like', "%$keyword%")
                    ->orWhere('TANGGAL_SERTIFIKAT', 'like', "%$keyword%")
                    ->orWhere('NO_SERTIFIKAT', 'like', "%$keyword%")
                    ->orWhere('PENGGUNAAN', 'like', "%$keyword%")
                    ->orWhere('ASAL_USUL', 'like', "%$keyword%")
                    ->orWhere('HARGA', 'like', "%$keyword%")
                    ->orWhere('KETERANGAN', 'like', "%$keyword%");
            })
            ->paginate(50);

        return response()->json($kiba);
    }
}
