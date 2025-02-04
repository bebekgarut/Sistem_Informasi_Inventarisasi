<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibc;
use Illuminate\Http\Request;

class ControllerC extends Controller
{
    public function getKIBC($kode_upb)
    {
        $kibc = Kibc::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibc);
    }

    public function showKIBC($id)
    {
        $kibc = Kibc::findOrFail($id);
        return response()->json($kibc);
    }
}
