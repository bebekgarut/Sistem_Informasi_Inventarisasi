<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibb;
use Illuminate\Http\Request;

class OPDControllerB extends Controller
{
    public function getKIBB($kode_upb)
    {
        $kibb = Kibb::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibb);
    }

    public function showKibb($kode_upb, $id)
    {
        $kibb = Kibb::where('KODE_UPB', $kode_upb)
            ->where('id', $id)->get();
        return response()->json($kibb);
    }
}
