<?php

namespace App\Http\Controllers\Api;

//import model Post
use App\Models\Bidang;

use App\Http\Controllers\Controller;

//import resource PostResource
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
}
