<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UPB;
use App\Models\Subunit;
use App\Models\Kibb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUPBB;

class UserControllerB extends Controller
{
    public function index($KODE_UPB)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            // $kiba = Kiba::where('KODE_UPB', $KODE_UPB)->get();
            $kibb = Kibb::where('kode_upb', $KODE_UPB)->paginate(100);
            return view('upb_kib_b.halaman-upb-b', compact('kibb'));
        }
    }


    public function detail($KODE_UPB, $id, Request $request)
    {
        $request->session()->put('previous_url', url()->previous());
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibb = Kibb::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_b.detail-upb-b', compact('kibb'));
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

            return view('upb_kib_b.add-upb-b', compact('KODE_BIDANG', 'KODE_UNITS', 'KODE_SUB_UNITS', 'KODE_UPB', 'PENGGUNA_BARANG'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function storeUPB(Request $request, $KODE_UPB)
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
            'NOMOR_POLISI' => 'nullable|string|max:255',
            'NOMOR_BPKB' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|max:255',
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
            Kibb::create($validatedData);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'Gagal menambahkan data. Silakan coba lagi.']);
        }

        return redirect()->route('data-upb-b', ['KODE_UPB' => $KODE_UPB])->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($KODE_UPB, $id)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibb = Kibb::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_b.edit-upb-b', compact('kibb'));
        }

        abort(403, 'Unauthorized action.');
    }

    public function updateb(Request $request, $KODE_UPB, $id)
    {

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $validatedDatab = $request->validate([
            'NAMA_BARANG' => 'required|string|max:255',
            'KODE_BARANG' => 'required|string|max:255',
            'NOMOR_REGISTER' => 'required|string|max:255',
            'MERK_TYPE' => 'nullable|string|max:255',
            'UKURAN_CC' => 'nullable|string|max:100',
            'BAHAN' => 'nullable|string|max:255',
            'TAHUN_PEMBELIAN' => 'nullable|date_format:Y',
            'NOMOR_PABRIK' => 'nullable|string|max:50',
            'NOMOR_RANGKA' => 'nullable|string|max:50',
            'NOMOR_MESIN' => 'nullable|string|max:255',
            'NOMOR_POLISI' => 'nullable|string|max:50',
            'NOMOR_BPKB' => 'nullable|string|max:255',
            'ASAL_USUL' => 'nullable|string|max:255',
            'HARGA' => 'nullable|numeric',
            'KETERANGAN' => 'nullable|max:255',
            'DOWNLOAD' => 'nullable|file|mimes:pdf|max:4096',
            'FOTO' => 'nullable|image|mimes:jpg,jpeg,png|max:3072'
        ]);

        $kibb = Kibb::findOrFail($id);

        if ($request->hasFile('FOTO')) {
            $path = $request->file('FOTO')->store('private/photos');
            $validatedDatab['FOTO'] = $path;
        }

        if ($request->hasFile('DOWNLOAD')) {
            $path = $request->file('DOWNLOAD')->store('private/files');
            $validatedDatab['DOWNLOAD'] = $path;
        }

        try {
            DB::table('kibbs')->where('id', $id)->where('KODE_UPB', $KODE_UPB)->update($validatedDatab);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'Gagal menambahkan data. Silakan coba lagi.']);
        }
        return redirect()->route('detail-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id])->with('success', 'Data berhasil diupdate');
    }

    public function destroy($KODE_UPB, $id)
    {

        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $kibb = Kibb::findOrFail($id);

        try {
            $deleted = Kibb::where('id', $id)->where('KODE_UPB', $KODE_UPB)->delete();

            if (!$deleted) {
                return redirect()->route('detail-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id])->with('error', 'Data tidak ditemukan');
            }
            return redirect()->route('data-upb-b', ['KODE_UPB' => $KODE_UPB])->with('hapus', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Gagal menghapus data. Silakan coba lagi.']);
        }
    }

    public function export($KODE_UPB)
    {
        $namaUPB = UPB::where('KODE_UPB', $KODE_UPB)->value('nama_upb');

        $fileName = $namaUPB . '-KIB-B.xlsx';

        return Excel::download(new ExportUPBB($KODE_UPB), $fileName);
    }

    public function search(Request $request, $KODE_UPB)
    {
        if (Auth::user()->role !== 'upb' && Auth::user()->KODE_UPB !== $KODE_UPB) {
            abort(403, 'Unauthorized action.');
        }

        $keyword = $request->input('keyword');

        $kibb = Kibb::where('KODE_UPB', Auth::user()->KODE_UPB)
            ->where(function ($query) use ($keyword) {
                $query->where('NAMA_BARANG', 'like', "%$keyword%")
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
                    ->orWhere('KETERANGAN', 'like', "%$keyword%");
            })
            ->paginate(50);

        return view('upb_kib_b.search-upb-b', compact('kibb'));
    }
}
