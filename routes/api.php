<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ControllerA;
use App\Http\Controllers\Api\ControllerB;
use App\Http\Controllers\Api\ControllerC;
use App\Http\Controllers\Api\OPDControllerA;
use App\Http\Controllers\Api\OPDControllerB;
use App\Http\Controllers\Api\OPDControllerC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/bidang', App\Http\Controllers\Api\BidangController::class);
Route::apiResource('/test', App\Http\Controllers\Api\ControllerA::class)->middleware(['auth:sanctum']);


Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);

Route::middleware(['auth:sanctum', 'apiAdmin'])->group(function () {
    Route::get('/getBidang', [ControllerA::class, 'getBidang']);
    Route::get('/getUnit/{kode_bidang}', [ControllerA::class, 'getUnit']);
    Route::get('/getSubUnit/{kode_units}', [ControllerA::class, 'getSubUnit']);
    Route::get('/getUPB/{kode_sub_unit}', [ControllerA::class, 'getUPB']);

    Route::get('/getKIBA/{kode_upb}', [ControllerA::class, 'getKIBA']);
    Route::get('/showKIBA/{id}', [ControllerA::class, 'showKIBA']);
    Route::post('/kiba', [ControllerA::class, 'store']);
    Route::post('/kiba/{id}', [ControllerA::class, 'update']);
    Route::delete('/kiba/{id}', [ControllerA::class, 'destroy']);
    Route::get('/kiba/search', [ControllerA::class, 'search']);

    Route::get('/getKIBB/{kode_upb}', [ControllerB::class, 'getKIBB']);
    Route::get('/showKIBB/{id}', [ControllerB::class, 'showKIBB']);
    Route::post('/kibb', [ControllerB::class, 'store']);
    Route::post('/kibb/{id}', [ControllerB::class, 'update']);
    Route::delete('/kibb/{id}', [ControllerB::class, 'destroy']);
    Route::get('/kibb/search', [ControllerB::class, 'search']);

    Route::get('/getKIBC/{kode_upb}', [ControllerC::class, 'getKIBC']);
    Route::get('/showKIBC/{id}', [ControllerC::class, 'showKIBC']);
    Route::post('/kibc', [ControllerC::class, 'store']);
    Route::post('/kibc/{id}', [ControllerC::class, 'update']);
    Route::delete('/kibc/{id}', [ControllerC::class, 'destroy']);
    Route::get('/kibc/search', [ControllerC::class, 'search']);
    Route::apiResource('/user', App\Http\Controllers\Api\UserController::class);
});

Route::middleware(['auth:sanctum', 'apiUPB'])->group(function () {
    Route::get('opd/getKIBA/{kode_upb}', [OPDControllerA::class, 'getKIBA']);
    Route::get('opd/showKIBA/{kode_upb}/{id}', [OPDControllerA::class, 'showKIBA']);
    Route::post('opd/kiba/{kode_upb}', [OPDControllerA::class, 'store']);
    Route::post('opd/kiba/{kode_upb}/{id}', [OPDControllerA::class, 'update']);
    Route::delete('opd/kiba/{kode_upb}/{id}', [OPDControllerA::class, 'destroy']);
    Route::get('opd/kiba/search/{kode_upb}', [OPDControllerA::class, 'search']);

    Route::get('opd/getKIBB/{kode_upb}', [OPDControllerB::class, 'getKIBB']);
    Route::get('opd/showKIBB/{kode_upb}/{id}', [OPDControllerB::class, 'showKIBB']);
    Route::post('opd/kibb/{kode_upb}', [OPDControllerB::class, 'store']);
    Route::post('opd/kibb/{kode_upb}/{id}', [OPDControllerB::class, 'update']);
    Route::delete('opd/kibb/{kode_upb}/{id}', [OPDControllerB::class, 'destroy']);
    Route::get('opd/kibb/search/{kode_upb}', [OPDControllerB::class, 'search']);

    Route::get('opd/getKIBC/{kode_upb}', [OPDControllerc::class, 'getKIBC']);
    Route::get('opd/showKIBC/{kode_upb}/{id}', [OPDControllerC::class, 'showKIBC']);
    Route::post('opd/kibc/{kode_upb}', [OPDControllerC::class, 'store']);
    Route::post('opd/kibc/{kode_upb}/{id}', [OPDControllerC::class, 'update']);
    Route::delete('opd/kibc/{kode_upb}/{id}', [OPDControllerC::class, 'destroy']);
    Route::get('opd/kibc/search/{kode_upb}', [OPDControllerC::class, 'search']);
});
