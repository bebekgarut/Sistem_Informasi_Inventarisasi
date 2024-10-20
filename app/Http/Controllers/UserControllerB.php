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
use Illuminate\Support\Facades\Storage;

class UserControllerB extends Controller
{
    public function index($KODE_UPB)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
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
    }

    public function create($KODE_UPB)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            return view('upb_kib_b.add-upb-b', compact('KODE_UPB'));
        }
    }

    public function store(Request $request, $KODE_UPB)
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
            'DOWNLOAD_2' => 'nullable|mimes:pdf|max:4096',
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
            return redirect()->route('data-upb-b', ['KODE_UPB' => $KODE_UPB])->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function edit($KODE_UPB, $id)
    {
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
            $kibb = Kibb::where('kode_upb', $KODE_UPB)->where('id', $id)->findOrFail($id);
            return view('upb_kib_b.edit-upb-b', compact('kibb'));
        }
    }

    public function update(Request $request, $KODE_UPB, $id)
    {
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
            if ($kibb && $kibb->FOTO) {
                Storage::delete($kibb->FOTO);
            }

            $file = $request->file('FOTO');
            $path = $file->store('private/photos');
            $validatedDatab['FOTO'] = $path;
        } else {
            unset($validatedDatab['FOTO']);
        }

        if ($request->hasFile('DOWNLOAD')) {
            if ($kibb && $kibb->DOWNLOAD) {
                Storage::delete($kibb->DOWNLOAD);
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
            $validatedDatab['DOWNLOAD'] = $filepath;
        }

        if ($request->hasFile('DOWNLOAD_2')) {
            if ($kibb && $kibb->DOWNLOAD_2) {
                Storage::delete($kibb->DOWNLOAD_2);
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
            $validatedDatab['DOWNLOAD_2'] = $filepath;
        }

        try {
            DB::table('kibbs')->where('id', $id)->where('KODE_UPB', $KODE_UPB)->update($validatedDatab);
            return redirect()->route('detail-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id])->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
        }
    }

    public function destroy($KODE_UPB, $id)
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
            $deleted = Kibb::where('id', $id)->where('KODE_UPB', $KODE_UPB)->delete();

            if (!$deleted) {
                return redirect()->route('detail-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id])->with('error', 'Data tidak ditemukan');
            }
            return redirect()->route('data-upb-b', ['KODE_UPB' => $KODE_UPB])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan data: ' . $e->getMessage()]);
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
        if (Auth::user()->role == 'upb' && Auth::user()->KODE_UPB == $KODE_UPB) {
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
}
