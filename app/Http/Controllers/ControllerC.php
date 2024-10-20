<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\UPB;
use App\Models\Kibc;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExportc;
use App\Exports\DataExportAllc;
use Illuminate\Support\Facades\Storage;

class ControllerC extends Controller
{
    public function index()
    {
        $bidangs = Bidang::all();
        return view('kib_c.data_kibc', compact('bidangs'));
    }

    public function getByUPB($kodeUPB)
    {
        $kibbs = Kibc::where('KODE_UPB', $kodeUPB)->paginate(100); // 100 item per halaman
        return response()->json($kibbs);
    }

    public function create()
    {
        return view('kib_c.tambah-c');
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
            'KODE_BIDANG' => 'required|numeric',
            'KODE_UNITS' => 'required|numeric',
            'KODE_SUB_UNITS' => 'required|numeric',
            'KODE_UPB' => 'required|numeric',
            'PENGGUNA_BARANG' => 'required|string|max:255'
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
            return redirect('/data_kibc')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function detail($id, Request $request)
    {
        $request->session()->put('previous_url', url()->previous());
        $kibc = Kibc::find($id);
        if (!$kibc) {
            return redirect('/data_kibc')->with('error', 'Data tidak ditemukan');
        }
        return view('kib_c.detail-c', compact('kibc'));
    }

    public function edit(Request $request, $id)
    {
        $kibc = Kibc::where('id', $id)->first();
        return view('kib_c.edit-c', compact('kibc'));
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

        $oldData = DB::table('kibcs')->where('id', $id)->first();

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
            DB::table('kibcs')->where('id', $id)->update($datac);
            return redirect()->route('detailDataKibc', ['id' => $id])->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal edit data: ' . $e->getMessage()]);
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

            $deleted = Kibc::where('id', $id)->delete();

            if (!$deleted) {
                return redirect()->route('kib_c.data_kibc')->with('error', 'Data tidak ditemukan');
            }
            return redirect()->route('datakibc')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('datakibc')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $bidang = $request->input('bidang');
        $unit = $request->input('unit');
        $subunit = $request->input('subunit');
        $upb = $request->input('upb');

        $namaUPB = UPB::where('KODE_UPB', $upb)->value('nama_upb');

        $kib = Kibc::where('KODE_BIDANG', $bidang)
            ->where('KODE_UNITS', $unit)
            ->where('KODE_SUB_UNITS', $subunit)
            ->where('KODE_UPB', $upb)
            ->get([
                'NAMA_BARANG',
                'KODE_BARANG',
                'NOMOR_REGISTER',
                'KONDISI_BANGUNAN',
                'BANGUNAN_BERTINGKAT',
                'BANGUNAN_BETON',
                'LUAS_LANTAI',
                'LETAK_ALAMAT',
                'TANGGAL_DOKUMEN',
                'NOMOR_DOKUMEN',
                'LUAS',
                'STATUS_TANAH',
                'NOMOR_KODE_TANAH',
                'ASAL_USUL',
                'HARGA',
                'KETERANGAN',
            ]);

        $columnsc = [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Kondisi Bangunan',
            'Bangunan Bertingkat',
            'Bangunan Beton',
            'Luas Lantai',
            'Letak/Alamat',
            'Tanggal Dokumen',
            'Nomor Dokumen',
            'Luas',
            'Status Tanah',
            'Nomor Kode Tanah',
            'Asal Usul',
            'Harga(Dalam Ribuan)',
            'Keterangan'

        ];

        $namaFile = $namaUPB . '-KIB-C.xlsx';

        return Excel::download(new DataExportc($kib, $columnsc), $namaFile);
    }

    public function exportAll()
    {
        $all = Kibc::orderBy('kode_upb')->get();

        $namaFile = 'All-Data-KIB-C.xlsx';

        $columnsall = [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Kondisi Bangunan',
            'Bangunan Bertingkat',
            'Bangunan Beton',
            'Luas Lantai',
            'Letak/Alamat',
            'Tanggal Dokumen',
            'Nomor Dokumen',
            'Luas',
            'Status Tanah',
            'Nomor Kode Tanah',
            'Asal Usul',
            'Harga(Dalam Ribuan)',
            'Keterangan'
        ];

        return Excel::download(new DataExportAllc($all, $columnsall), $namaFile);
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
        return view('kib_c.search-c', compact('kibc'));
    }
}
