<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kiba;
use Illuminate\Http\Request;

class OPDControllerA extends Controller
{
    public function getKIBA($kode_upb)
    {
        $kiba = Kiba::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kiba);
    }

    public function showKiba($kode_upb, $id)
    {
        $kiba = Kiba::where('KODE_UPB', $kode_upb)
            ->where('id', $id)->get();
        return response()->json($kiba);
    }
}
