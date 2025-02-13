<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ControllerB extends Controller
{
    public function getKIBB($kode_upb)
    {
        $kibb = Kibb::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibb);
    }

    public function showKIBB($id)
    {
        $kibb = Kibb::findOrFail($id);
        return response()->json($kibb);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'MERK_TYPE' => 'nullable|string|max:255',
            'UKURAN_CC' => 'nullable|string|max:255',
            'BAHAN' => 'nullable|string|max:255',
            'TAHUN_PEMBELIAN' => 'nullable|date_format:Y',
            'NOMOR_PABRIK' => 'nullable|string|max:100',
            'NOMOR_RANGKA' => 'nullable|string|max:50',
            'NOMOR_MESIN' => 'nullable|string|max:255',
            'NOMOR_POLISI' => 'nullable|string|max:20',
            'NOMOR_BPKB' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|mimes:pdf|max:4096',
            'DOWNLOAD_2' => 'nullable|mimes:pdf|max:4096',
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
            $filename = pathinfo($request->File('DOWNLOAD')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->File('DOWNLOAD')->getClientOriginalExtension();
            $filepath = 'private/files/' . $filename . '.' . $extension;
            $counter = 1;

            while (Storage::exists($filepath)) {
                $filepath = 'private/files/' . $filename . "($counter)." . $extension;
                $counter++;
            }

            $request->File('DOWNLOAD')->storeAs('private/files', basename($filepath));
            $data['DOWNLOAD'] = $filepath;
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
            $data['DOWNLOAD_2'] = $filepath;
        }

        try {
            Kibb::create($data);
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
        $data = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:50',
            'MERK_TYPE' => 'nullable|string|max:255',
            'UKURAN_CC' => 'nullable|string|max:255',
            'BAHAN' => 'nullable|string|max:255',
            'TAHUN_PEMBELIAN' => 'nullable|date_format:Y',
            'NOMOR_PABRIK' => 'nullable|string|max:100',
            'NOMOR_RANGKA' => 'nullable|string|max:50',
            'NOMOR_MESIN' => 'nullable|string|max:255',
            'NOMOR_POLISI' => 'nullable|string|max:20',
            'NOMOR_BPKB' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|mimes:pdf|max:4096',
            'DOWNLOAD_2' => 'nullable|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $oldData = Kibb::findOrFail($id);

        if ($request->hasFile('FOTO')) {
            if ($oldData && $oldData->FOTO) {
                Storage::delete($oldData->FOTO);
            }

            $file = $request->file('FOTO');
            $path = $file->store('private/photos');
            $data['FOTO'] = $path;
        } else {
            unset($data['FOTO']);
        }

        if ($request->hasFile('DOWNLOAD')) {
            if ($oldData && $oldData->DOWNLOAD) {
                Storage::delete($oldData->DOWNLOAD);
            }

            $filename = pathinfo($request->File('DOWNLOAD')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->File('DOWNLOAD')->getClientOriginalExtension();
            $filepath = 'private/files/' . $filename . '.' . $extension;
            $counter = 1;

            while (Storage::exists($filepath)) {
                $filepath = 'private/files/' . $filename . "($counter)." . $extension;
                $counter++;
            }

            $request->File('DOWNLOAD')->storeAs('private/files', basename($filepath));
            $data['DOWNLOAD'] = $filepath;
        }

        if ($request->hasFile('DOWNLOAD_2')) {
            if ($oldData && $oldData->DOWNLOAD_2) {
                Storage::delete($oldData->DOWNLOAD_2);
            }

            $filename = pathinfo($request->File('DOWNLOAD_2')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->File('DOWNLOAD_2')->getClientOriginalExtension();
            $filepath = 'private/files/' . $filename . '.' . $extension;
            $counter = 1;

            while (Storage::exists($filepath)) {
                $filepath = 'private/files/' . $filename . "($counter)." . $extension;
                $counter++;
            }

            $request->File('DOWNLOAD_2')->storeAs('private/files', basename($filepath));
            $data['DOWNLOAD_2'] = $filepath;
        }

        try {
            $kibb = Kibb::findOrFail($id);
            $kibb->update($data);
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
            $kibb = Kibb::findOrFail($id);

            if ($kibb && $kibb->FOTO) {
                Storage::delete($kibb->FOTO);
            }

            if ($kibb && $kibb->DOWNLOAD) {
                Storage::delete($kibb->DOWNLOAD);
            }

            if ($kibb && $kibb->DOWNLOAD_2) {
                Storage::delete($kibb->DOWNLOAD_2);
            }

            Kibb::where('id', $id)->delete();
            return response()->json('data berhasil dihapus');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'gagal menghapus data',
                'error' => $e->getMessage()
            ]);
        }
    }
}
