<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kibb;
use Illuminate\Http\Request;

class ControllerB extends Controller
{
    public function getKIBB($kode_upb)
    {
        $kibb = Kibb::where('KODE_UPB', $kode_upb)->get();
        return response()->json($kibb);
    }

    public function showKIBB($id)
    {
        $kibb = Kibb::findOrFail($id);
        return response()->json($kibb);
    }
}
