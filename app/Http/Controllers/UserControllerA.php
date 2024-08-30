<?php

namespace App\Http\Controllers;

use App\Exports\ExportUPBA;
use Illuminate\Http\Request;
use App\Models\Kiba;
use Illuminate\Support\Facades\Auth;
use App\Models\UPB;
use App\Models\Subunit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UserControllerA extends Controller
{
    public function index($KODE_UPB)
    {

        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kiba = Kiba::where('KODE_UPB', $KODE_UPB)->paginate(100);
            return view('upb_kib_a.halaman-upb-a', compact('kiba'));
        }
    }

    public function home($KODE_UPB)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kiba = Kiba::where('KODE_UPB', $KODE_UPB)->get();
            return view('home-upb', compact('kiba'));
        }
        abort(403, 'Unauthorized action.');
    }

    public function detail($KODE_UPB, $id, Request $request)
    {
        $request->session()->put('previous_url', url()->previous());
        // $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kiba = Kiba::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_a.detail-upb-a', compact('kiba'));
            // return view('upb_kib_a.detail-upb-a', compact('kiba', 'googleMapsApiKey'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function create($KODE_UPB)
    {

        $user = Auth::user();

        if ($user->role == 'upb' && $user->KODE_UPB == $KODE_UPB) {
            $UPB = UPB::where('KODE_UPB', $KODE_UPB)->first();
            $KODE_BIDANG = $UPB->KODE_BIDANG;
            $KODE_UNITS = $UPB->KODE_UNITS;
            $KODE_SUB_UNITS = $UPB->KODE_SUB_UNITS;

            $sub_unit = Subunit::where('KODE_SUB_UNITS', $KODE_SUB_UNITS)->first();
            $PENGGUNA_BARANG = $sub_unit->NAMA_SUB_UNITS;

            return view('upb_kib_a.add-upb-a', compact('KODE_BIDANG', 'KODE_UNITS', 'KODE_SUB_UNITS', 'KODE_UPB', 'PENGGUNA_BARANG'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function storeUPB(Request $request, $KODE_UPB)
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

        $user = Auth::user();
        $KODE_UPB = $user->KODE_UPB;

        $upb = UPB::where('KODE_UPB', $KODE_UPB)->first();
        $validatedData['KODE_BIDANG'] = $upb->KODE_BIDANG;
        $validatedData['KODE_UNITS'] = $upb->KODE_UNITS;
        $validatedData['KODE_SUB_UNITS'] = $upb->KODE_SUB_UNITS;
        $validatedData['KODE_UPB'] = $KODE_UPB;

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
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'Gagal menambahkan data. Silakan coba lagi.']);
        }

        return redirect()->route('data-upb-a', ['KODE_UPB' => $KODE_UPB])->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($KODE_UPB, $id)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kiba = Kiba::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_a.edit-upb-a', compact('kiba'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function update(Request $request, $KODE_UPB, $id)
    {

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

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
            'LINK' => 'nullable|string|max:255',
            'DOWNLOAD' => 'nullable|file|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ]);

        $kiba = Kiba::findOrFail($id);

        if ($request->hasFile('FOTO')) {
            $path = $request->file('FOTO')->store('private/photos');
            $validatedData['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            $path = $request->file('DOWNLOAD')->store('private/files');
            $validatedData['DOWNLOAD'] = $path;
        }

        try {
            DB::table('kibas')->where('id', $id)->where('KODE_UPB', $KODE_UPB)->update($validatedData);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'Gagal update data. Silakan coba lagi.']);
        }
        return redirect()->route('detail-upb-a', ['KODE_UPB' => $kiba->KODE_UPB, 'id' => $kiba->id])->with('success', 'Data berhasil diupdate');
    }

    public function destroy($KODE_UPB, $id)
    {

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $kiba = Kiba::findOrFail($id);

        try {
            $deleted = Kiba::where('id', $id)->where('KODE_UPB', $KODE_UPB)->delete();

            if (!$deleted) {
                return redirect()->route('detail-upb-a', ['KODE_UPB' => $kiba->KODE_UPB, 'id' => $kiba->id])->with('error', 'Data tidak ditemukan');
            }
            return redirect()->route('data-upb-a', ['KODE_UPB' => $KODE_UPB])->with('hapus', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal menghapus data. Silakan coba lagi.']);
        }
    }

    public function export($KODE_UPB)
    {
        $namaUPB = UPB::where('KODE_UPB', $KODE_UPB)->value('nama_upb');

        $fileName = $namaUPB . '-KIB-A.xlsx';

        return Excel::download(new ExportUPBA($KODE_UPB), $fileName);
    }

    public function search(Request $request, $KODE_UPB)
    {
        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $keyword = $request->input('keyword');

        $kiba = Kiba::where('KODE_UPB', Auth::user()->KODE_UPB)
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

        return view('upb_kib_a.search-upb-a', compact('kiba'));
    }

    public function rekapKoordinat($KODE_UPB)
    {
        // $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibas = Kiba::where('KODE_UPB', $KODE_UPB)->whereNotNull('KOORDINAT')
                ->get(['NAMA_BARANG', 'NOMOR_REGISTER', 'KODE_BARANG', 'PENGGUNAAN', 'KOORDINAT']);;
            return view('upb_kib_a.koordinat-upb-a', compact('kibas'));
            // return view('upb_kib_a.koordinat-upb-a', compact('kibas', 'googleMapsApiKey'));
        }
    }

    public function showFile($KODE_UPB, $filename)
    {
        $path = 'private/files/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            return redirect()->route('login');
        }

        $file = Storage::get($path);
        $mimeType = Storage::mimeType($path);

        return response($file, 200)->header('Content-Type', $mimeType);
    }
}
