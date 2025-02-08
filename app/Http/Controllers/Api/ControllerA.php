<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Kiba;
use App\Models\Unit;
use App\Models\Subunit;
use App\Models\UPB;
use Illuminate\Http\Request;

class ControllerA extends Controller
{
    public function getBidang()
    {
        $bidang = Bidang::all();
        return response()->json($bidang);
    }

    public function getUnit($kode_bidang)
    {
        $unit = Unit::where('KODE_BIDANG', $kode_bidang)->get();
        return response()->json($unit);
    }

    public function getSubUnit($kode_unit)
    {
        $sub_unit = Subunit::where('KODE_UNITS', $kode_unit)->get();
        return response()->json($sub_unit);
    }

    public function getUPB($kode_sub_unit)
    {
        $upb = UPB::where('KODE_SUB_UNITS', $kode_sub_unit)->get();
        return response()->json($upb);
    }

    public function getKIBA($kode_upb)
    {
        $kiba = Kiba::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kiba);
    }

    public function showKiba($id)
    {
        $kiba = Kiba::findOrFail($id);
        return response()->json($kiba);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:50',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'LUAS' => 'nullable|numeric',
            'TAHUN_PENGADAAN' => 'nullable|date_format:Y',
            'LETAK_ALAMAT' => 'nullable|string|max:255',
            'HAK' => 'nullable|string|max:255',
            'TANGGAL_SERTIFIKAT' => 'nullable|date',
            'NO_SERTIFIKAT' => 'nullable|string|max:100',
            'PENGGUNAAN' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
            'KOORDINAT' => 'nullable|string|max:255',
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
            Kiba::create($data);
            return response()->json(['message' => 'Data berhasil ditambahkan',]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }
}
