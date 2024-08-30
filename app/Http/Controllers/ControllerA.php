<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\Unit;
use App\Models\Subunit;
use App\Models\UPB;
use App\Models\Kiba;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExport;
use App\Exports\DataExportAlla;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ControllerA extends Controller
{

    public function index()
    {
        $bidangs = Bidang::all();
        return view('kib_a.data_kiba', compact('bidangs'));
    }

    public function getUnits($kodeBidang)
    {
        $units = Unit::where('KODE_BIDANG', $kodeBidang)->get();
        Log::info('Units fetched for KODE_BIDANG ' . $kodeBidang . ': ' . $units);
        return response()->json($units);
    }

    public function getSubunits($kodeUnits)
    {
        $subunits = Subunit::where('KODE_UNITS', $kodeUnits)->get();
        Log::info('Subunits fetched for KODE_UNITS ' . $kodeUnits . ': ' . $subunits);
        return response()->json($subunits);
    }

    public function getUPB($kodeSubunits)
    {
        $UPB = UPB::where('KODE_SUB_UNITS', $kodeSubunits)->get();
        Log::info('Subunits fetched for KODE_SUB_UNITS ' . $kodeSubunits . ': ' . $UPB);
        return response()->json($UPB);
    }

    public function getByUPB($kodeUPB)
    {
        $kibas = Kiba::where('KODE_UPB', $kodeUPB)->paginate(100);
        return response()->json($kibas);
    }

    public function detail($id, Request $request)
    {
        // $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        $request->session()->put('previous_url', url()->previous());
        $kiba = Kiba::find($id);
        if (!$kiba) {
            return redirect('/data_kiba')->with('error', 'Data tidak ditemukan');
        }
        return view('kib_a.detail', compact('kiba'));
        // return view('kib_a.detail', compact('kiba', 'googleMapsApiKey'));
    }

    public function edit(Request $request, $id)
    {
        $kiba = Kiba::where('id', $id)->first();
        return view('kib_a.edit', compact('kiba'));
    }

    public function update(Request $request, $id)
    {
        try {
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
                'KOORDINAT' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('FOTO')) {
                $request->validate([
                    'FOTO' => 'image|mimes:jpeg,png,jpg,gif|max:3072'
                ]);

                $file = $request->file('FOTO');
                $path = $file->store('private/photos');
                $data['FOTO'] = $path;
            } else {
                unset($data['FOTO']);
            }

            if ($request->hasFile('DOWNLOAD')) {
                $request->validate([
                    'DOWNLOAD' => 'mimes:pdf|max:4096'
                ]);

                $file = $request->file('DOWNLOAD');
                $path = $file->store('private/files');
                $data['DOWNLOAD'] = $path;
            } else {
                unset($data['DOWNLOAD']);
            }

            DB::table('kibas')->where('id', $id)->update($data);

            return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function hapusDataKiba($id)
    {
        try {
            $deleted = Kiba::where('id', $id)->delete();

            if (!$deleted) {
                return redirect()->route('kib_a.data_kiba')->with('error', 'Data tidak ditemukan');
            }

            return redirect()->route('datakiba')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('datakiba')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
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
            'KODE_BIDANG' => 'required|numeric',
            'KODE_UNITS' => 'required|numeric',
            'KODE_SUB_UNITS' => 'required|numeric',
            'KODE_UPB' => 'required|numeric',
            'PENGGUNA_BARANG' => 'required|string|max:100'
        ]);


        try {
            if ($request->hasFile('FOTO')) {
                $path = $request->file('FOTO')->store('private/photos');
                $data['FOTO'] = $path;
            }

            if ($request->hasFile('DOWNLOAD')) {
                $path = $request->file('DOWNLOAD')->store('private/files');
                $data['DOWNLOAD'] = $path;
            }

            Kiba::create($data);

            return redirect()->route('datakiba')->with('add', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        $bidang = $request->input('bidang');
        $unit = $request->input('unit');
        $subunit = $request->input('subunit');
        $upb = $request->input('upb');

        $namaUPB = UPB::where('KODE_UPB', $upb)->value('nama_upb');

        $data = Kiba::where('KODE_BIDANG', $bidang)
            ->where('KODE_UNITS', $unit)
            ->where('KODE_SUB_UNITS', $subunit)
            ->where('KODE_UPB', $upb)
            ->get([
                'NAMA_BARANG', 'KODE_BARANG', 'NOMOR_REGISTER',
                'LUAS',
                'TAHUN_PENGADAAN',
                'LETAK_ALAMAT',
                'HAK',
                'TANGGAL_SERTIFIKAT',
                'NO_SERTIFIKAT',
                'PENGGUNAAN',
                'ASAL_USUL',
                'HARGA',
                'KETERANGAN',
                'KOORDINAT'
            ]);

        $columns = [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Luas',
            'Tahun Pengadaan',
            'Letak/Alamat',
            'Hak(Dalam Ribuan)',
            'Tanggal Sertifikat',
            'Nomor Sertifikat',
            'Penggunaan',
            'Asal Usul',
            'Harga',
            'Keterangan',
            'Koordinat'
        ];

        $namaFile = $namaUPB . '-KIB-A.xlsx';

        return Excel::download(new DataExport($data, $columns), $namaFile);
    }

    public function exportAll()
    {
        $all = Kiba::orderBy('kode_upb')->get();

        $namaFile = 'All-Data-KIB-A.xlsx';

        $columnsall = [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Luas',
            'Tahun Pengadaan',
            'Letak/Alamat',
            'Hak',
            'Tanggal Sertifikat',
            'Nomor Sertifikat',
            'Pengguna Barang',
            'Penggunaan',
            'Asal Usul',
            'Harga(Dalam Ribuan)',
            'Keterangan',
            'Koordinat'
        ];

        return Excel::download(new DataExportAlla($all, $columnsall), $namaFile);
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $kiba = Kiba::where('NAMA_BARANG', 'like', "%$keyword%")
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
            ->orWhere('KETERANGAN', 'like', "%$keyword%")
            ->orWhere('PENGGUNA_BARANG', 'like', "%$keyword%")
            ->paginate(50);

        return view('kib_a.search-a', compact('kiba'));
    }

    public function rekapKoordinat()
    {
        // $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        // $kibas = Kiba::all();
        $kibas = Kiba::whereNotNull('KOORDINAT')
            ->get(['NAMA_BARANG', 'NOMOR_REGISTER', 'KODE_BARANG', 'PENGGUNAAN', 'KOORDINAT']);
        $countKoordinat = $kibas->filter(function ($kiba) {
            return !empty($kiba->KOORDINAT);
        })->count();

        return view('kib_a.rekapkoordinat-a', compact('kibas', 'countKoordinat'));
        // return view('kib_a.rekapkoordinat-a', compact('kibas', 'countKoordinat', 'googleMapsApiKey'));
    }

    public function showFile($filename)
    {
        $path = 'private/files/' . $filename;

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

    public function showPhoto($filename)
    {
        $path = 'private/photos/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        $file = Storage::get($path);
        $mimeType = Storage::mimeType($path);

        return response($file, 200)->header('Content-Type', $mimeType);
    }
}
