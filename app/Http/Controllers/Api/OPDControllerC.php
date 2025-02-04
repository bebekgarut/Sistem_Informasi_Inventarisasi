<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibc;
use Illuminate\Http\Request;

class OPDControllerC extends Controller
{
    public function getKIBC($kode_upb)
    {
        $kibc = Kibc::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibc);
    }


    public function showKibc($kode_upb, $id)
    {
        $kibc = Kibc::where('KODE_UPB', $kode_upb)
            ->where('id', $id)->get();
        return response()->json($kibc);
    }
}
