<?php

namespace App\Http\Controllers\Api;

use App\Models\Bidang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BidangResource;

class BidangController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $bidang = Bidang::all();
        return new BidangResource(true, 'Data Bidang', $bidang);
    }

    public function show($id)
    {
        $bidang = Bidang::findOrFail($id);
        return response()->json($bidang);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'KODE_BIDANG' => 'required|integer',
            'NAMA_BIDANG' => 'required|string|max:100'
        ]);

        Bidang::create($data);
        return response()->json([
            'message' => 'Berhasil menambahkan data',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'NAMA_BIDANG' => 'required|string|max:100'
        ]);

        $bidang = Bidang::findOrFail($id);
        $bidang->update($data);
        return response()->json([
            'message' => 'Berhasil mengubah data',
            'data' => $data
        ]);
    }

    public function  destroy($id)
    {
        $bidang = Bidang::findOrFail($id);
        $bidang->delete();
        return response()->json('Berhasil menghapus data');
    }
}
