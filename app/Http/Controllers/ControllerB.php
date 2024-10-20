<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\UPB;
use App\Models\Kibb;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExportb;
use App\Exports\DataExportAllb;
use Illuminate\Support\Facades\Storage;

class ControllerB extends Controller
{
    public function index()
    {
        $bidangs = Bidang::all();
        return view('kib_b.data_kibb', compact('bidangs'));
    }
    public function getByUPB($kodeUPB)
    {
        $kibbs = Kibb::where('KODE_UPB', $kodeUPB)->paginate(100);
        return response()->json($kibbs);
    }

    public function create()
    {
        return view('kib_b.tambah-b');
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
            'KODE_BIDANG' => 'required|numeric',
            'KODE_UNITS' => 'required|numeric',
            'KODE_SUB_UNITS' => 'required|numeric',
            'KODE_UPB' => 'required|numeric',
            'PENGGUNA_BARANG' => 'required|string|max:100'
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
            return redirect('/data_kibb')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function detail($id, Request $request)
    {
        $request->session()->put('previous_url', url()->previous());
        $kibb = Kibb::find($id);
        if (!$kibb) {
            return redirect('/data_kibb')->with('error', 'Data tidak ditemukan');
        }
        return view('kib_b.detail-b', compact('kibb'));
    }

    public function edit(Request $request, $id)
    {
        $kibb = Kibb::where('id', $id)->first();
        return view('kib_b.edit-b', compact('kibb'));
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

        $oldData = DB::table('kibbs')->where('id', $id)->first();

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
            DB::table('kibbs')->where('id', $id)->update($data);
            return redirect()->route('detailDataKibb', ['id' => $id])->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal edit data: ' . $e->getMessage()]);
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

            $deleted = Kibb::where('id', $id)->delete();
            if (!$deleted) {
                return redirect()->route('kib_b.data_kibb')->with('error', 'Data tidak ditemukan');
            }
            return redirect()->route('datakibb')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('datakibb')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $bidang = $request->input('bidang');
        $unit = $request->input('unit');
        $subunit = $request->input('subunit');
        $upb = $request->input('upb');

        $namaUPB = UPB::where('KODE_UPB', $upb)->value('nama_upb');

        $kibb = Kibb::where('KODE_BIDANG', $bidang)
            ->where('KODE_UNITS', $unit)
            ->where('KODE_SUB_UNITS', $subunit)
            ->where('KODE_UPB', $upb)
            ->get([
                'NAMA_BARANG',
                'KODE_BARANG',
                'NOMOR_REGISTER',
                'MERK_TYPE',
                'UKURAN_CC',
                'BAHAN',
                'TAHUN_PEMBELIAN',
                'NOMOR_PABRIK',
                'NOMOR_MESIN',
                'NOMOR_POLISI',
                'NOMOR_BPKB',
                'ASAL_USUL',
                'HARGA',
                'KETERANGAN',
            ]);

        $columnsb = [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Merk/Type',
            'Ukuran/CC',
            'Bahan',
            'Tahun Pembelian',
            'Nomor Pabrik',
            'Nomor Rangka',
            'Nomor Mesin',
            'Nomor Polisi',
            'Nomor BPKB',
            'Asal Usul',
            'Harga(Dalam Ribuan)',
            'Keterangan'
        ];

        $namaFile = $namaUPB . '-KIB-B.xlsx';

        return Excel::download(new DataExportb($kibb, $columnsb), $namaFile);
    }

    public function exportAll()
    {
        $all = Kibb::orderBy('kode_upb')->get();

        $namaFile = 'All-Data-KIB-B.xlsx';

        $columnsall = [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Merk/Type',
            'Ukuran/CC',
            'Bahan',
            'Tahun Pembelian',
            'Nomor Pabrik',
            'Nomor Rangka',
            'Nomor Mesin',
            'Nomor Polisi',
            'Nomor BPKB',
            'Asal Usul',
            'Harga(Dalam Ribuan)',
            'Keterangan'
        ];

        return Excel::download(new DataExportAllb($all, $columnsall), $namaFile);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $kibb = Kibb::where('NAMA_BARANG', 'like', "%$keyword%")
            ->orWhere('KODE_BARANG', 'like', "%$keyword%")
            ->orWhere('NOMOR_REGISTER', 'like', "%$keyword%")
            ->orWhere('MERK_TYPE', 'like', "%$keyword%")
            ->orWhere('TAHUN_PEMBELIAN', 'like', "%$keyword%")
            ->orWhere('UKURAN_CC', 'like', "%$keyword%")
            ->orWhere('BAHAN', 'like', "%$keyword%")
            ->orWhere('NOMOR_PABRIK', 'like', "%$keyword%")
            ->orWhere('NOMOR_MESIN', 'like', "%$keyword%")
            ->orWhere('NOMOR_POLISI', 'like', "%$keyword%")
            ->orWhere('NOMOR_BPKB', 'like', "%$keyword%")
            ->orWhere('ASAL_USUL', 'like', "%$keyword%")
            ->orWhere('HARGA', 'like', "%$keyword%")
            ->orWhere('KETERANGAN', 'like', "%$keyword%")
            ->orWhere('PENGGUNA_BARANG', 'like', "%$keyword%")
            ->paginate(50);
        return view('kib_b.search-b', compact('kibb'));
    }
}
