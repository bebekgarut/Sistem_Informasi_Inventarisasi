<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibb;
use App\Models\Subunit;
use App\Models\UPB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OPDControllerB extends Controller
{
    public function getKIBB($kode_upb)
    {
        $kibb = Kibb::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibb);
    }

    public function showKibb($kode_upb, $id)
    {
        $kibb = Kibb::where('KODE_UPB', $kode_upb)
            ->where('id', $id)->get();
        return response()->json($kibb);
    }

    public function store(Request $request, $kode_upb)
    {
        $validatedData = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'MERK_TYPE' => 'nullable|string|max:255',
            'UKURAN_CC' => 'nullable|string|max:100',
            'BAHAN' => 'nullable|string|max:255',
            'TAHUN_PEMBELIAN' => 'nullable|date_format:Y',
            'NOMOR_PABRIK' => 'nullable|string|max:50',
            'NOMOR_RANGKA' => 'nullable|string|max:50',
            'NOMOR_MESIN' => 'nullable|string|max:255',
            'NOMOR_POLISI' => 'nullable|string|max:15',
            'NOMOR_BPKB' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|max:255',
            'DOWNLOAD' => 'nullable|mimes:pdf|max:4096',
            'DOWNLOAD_2' => 'nullable|mimes:pdf|max:4096',
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
            $path = $request->file('FOTO')->store('private/photos');
            $validatedData['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            $filename = pathinfo($request->File('DOWNLOAD')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->File('DOWNLOAD')->getClientOriginalExtension();
            $filepath = 'private/files/' . $filename . '.' . $extension;
            $counter = 1;

            while (Storage::exists($filepath)) {
                $filepath = 'private/files/' . $filename . "($counter)." . $extension;
                $counter++;
            }

            $request->File('DOWNLOAD')->storeAs('private/files', basename($filepath));
            $validatedData['DOWNLOAD'] = $filepath;
        }

        if ($request->hasFile('DOWNLOAD_2')) {
            $filename = pathinfo($request->File('DOWNLOAD_2')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->File('DOWNLOAD_2')->getClientOriginalExtension();
            $filepath = 'private/files/' . $filename . '.' . $extension;
            $counter = 1;

            while (Storage::exists($filepath)) {
                $filepath = 'private/files/' . $filename . "($counter)." . $extension;
                $counter++;
            }

            $request->File('DOWNLOAD_2')->storeAs('private/files', basename($filepath));
            $validatedData['DOWNLOAD_2'] = $filepath;
        }

        try {
            Kibb::create($validatedData);
            return response()->json(['message' => 'Data berhasil ditambahkan',]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan data',
                'error' => $e->getMessage()
            ]);
        }
    }
}
