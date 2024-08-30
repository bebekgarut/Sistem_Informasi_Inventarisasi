<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subunit;
use App\Models\UPB;
use App\Models\Kibc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUPBC;

class UserControllerC extends Controller
{
    public function index($KODE_UPB)
    {
        // if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
        //     $kiba = KIBA::where('KODE_UPB', $KODE_UPB)->get();
        //     return view('test', compact('kiba'));
        // }

        // abort(403, 'Unauthorized action.');
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibc = Kibc::where('kode_upb', $KODE_UPB)->paginate(100);
            return view('upb_kib_c.halaman-upb-c', compact('kibc'));
        }
    }


    public function detail($KODE_UPB, $id, Request $request)
    {
        $request->session()->put('previous_url', url()->previous());
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibc = Kibc::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_c.detail-upb-c', compact('kibc'));
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

            $sub_unit = SubUnit::where('KODE_SUB_UNITS', $KODE_SUB_UNITS)->first();
            $PENGGUNA_BARANG = $sub_unit->NAMA_SUB_UNITS;

            return view('upb_kib_c.add-upb-c', compact('KODE_BIDANG', 'KODE_UNITS', 'KODE_SUB_UNITS', 'KODE_UPB', 'PENGGUNA_BARANG'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function storeUPB(Request $request, $KODE_UPB)
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
            Kibc::create($validatedData);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'Gagal menambahkan data. Silakan coba lagi.']);
        }

        return redirect()->route('data-upb-c', ['KODE_UPB' => $KODE_UPB])->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($KODE_UPB, $id)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibc = Kibc::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_c.edit-upb-c', compact('kibc'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function updatec(Request $request, $KODE_UPB, $id)
    {

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

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
            $path = $request->file('FOTO')->store('private/photos');
            $validatedDatac['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            $path = $request->file('DOWNLOAD')->store('private/files');
            $validatedDatac['DOWNLOAD'] = $path;
        }


        try {
            DB::table('kibcs')->where('id', $id)->where('KODE_UPB', $KODE_UPB)->update($validatedDatac);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'Gagal menambahkan data. Silakan coba lagi.']);
        }
        return redirect()->route('detail-upb-c', ['KODE_UPB' => $kibc->KODE_UPB, 'id' => $kibc->id])->with('success', 'Data berhasil diupdate');
    }

    public function destroy($KODE_UPB, $id)
    {

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $kibc = Kibc::findOrFail($id);

        try {
            $deleted = Kibc::where('id', $id)->where('KODE_UPB', $KODE_UPB)->delete();

            if (!$deleted) {
                return redirect()->route('detail-upb-c', ['KODE_UPB' => $kibc->KODE_UPB, 'id' => $kibc->id])->with('error', 'Data tidak ditemukan');
            }
            return redirect()->route('data-upb-c', ['KODE_UPB' => $KODE_UPB])->with('hapus', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal menghapus data. Silakan coba lagi.']);
        }
    }

    public function export($KODE_UPB)
    {
        $namaUPB = UPB::where('KODE_UPB', $KODE_UPB)->value('nama_upb');

        $fileName = $namaUPB . '-KIB-C.xlsx';

        return Excel::download(new ExportUPBC($KODE_UPB), $fileName);
    }

    public function search(Request $request, $KODE_UPB)
    {
        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $keyword = $request->input('keyword');

        $kibc = Kibc::where('KODE_UPB', Auth::user()->KODE_UPB)
            ->where(function ($query) use ($keyword) {
                $query->where('NAMA_BARANG', 'like', "%$keyword%")
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
                    ->orWhere('KETERANGAN', 'like', "%$keyword%");
            })
            ->paginate(50);

        return view('upb_kib_c.search-upb-c', compact('kibc'));
    }
}
