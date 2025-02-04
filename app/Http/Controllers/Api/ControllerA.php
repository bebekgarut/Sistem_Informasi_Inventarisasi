<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Kiba;
use App\Models\Unit;
use App\Models\Subunit;
use App\Models\UPB;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ControllerA extends Controller
{
    public function getBidang()
    {
        $bidang = Bidang::all();
        return response()->json($bidang);
    }

    public function getUnit($kode_bidang)
    {
        $unit = Unit::where('KODE_BIDANG', $kode_bidang)->get();
        return response()->json($unit);
    }

    public function getSubUnit($kode_unit)
    {
        $sub_unit = Subunit::where('KODE_UNITS', $kode_unit)->get();
        return response()->json($sub_unit);
    }

    public function getUPB($kode_sub_unit)
    {
        $upb = UPB::where('KODE_SUB_UNITS', $kode_sub_unit)->get();
        return response()->json($upb);
    }

    public function getKIBA($kode_upb)
    {
        $kiba = Kiba::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kiba);
    }

    public function showKiba($id)
    {
        $kiba = Kiba::findOrFail($id);
        return response()->json($kiba);
    }
}
