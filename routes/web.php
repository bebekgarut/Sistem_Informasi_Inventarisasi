<?php

use App\Http\Controllers\ArsipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerA;
use App\Http\Controllers\ControllerB;
use App\Http\Controllers\ControllerC;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserControllerA;
use App\Http\Controllers\UserControllerB;
use App\Http\Controllers\UserControllerC;
use App\Models\Arsip;
use Illuminate\Auth\Events\Login;

Route::get('/', function () {
    return redirect('/login');
})->middleware('redirectUPB');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/photos/{filename}', [ControllerA::class, 'showPhoto'])->middleware('auth')->name('photos.show');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/data_kiba', [ControllerA::class, 'index'])->name('datakiba');
    Route::get('/getUnits/{kodeBidang}', [ControllerA::class, 'getUnits']);
    Route::get('/getSubunits/{kodeUnits}', [ControllerA::class, 'getSubunits']);
    Route::get('/getUPB/{kodeSubunits}', [ControllerA::class, 'getUPB']);
    Route::get('/getKibaByUPB/{kodeUPB}', [ControllerA::class, 'getByUPB']);
    Route::get('/add', function () {
        return view('kib_a.tambah');
    });
    Route::post('/add', [ControllerA::class, 'store'])->name('storeDataKiba');
    Route::get('/detail/{id}', [ControllerA::class, 'detail'])->name('detailDataKiba');
    Route::get('/edit/{id}', [ControllerA::class, 'edit'])->name('editDataKiba');
    Route::put('/update/{id}', [ControllerA::class, 'update'])->name('updateDataKiba');
    Route::delete('/hapus/{id}', [ControllerA::class, 'hapusDataKiba'])->name('hapusDataKiba');
    Route::get('/export', [ControllerA::class, 'export'])->name('export');
    Route::get('/export-all', [ControllerA::class, 'exportAll'])->name('exportAll');
    Route::get('/search-a', [ControllerA::class, 'search'])->name('search-a');
    Route::get('/rekapkoordinat-a', [ControllerA::class, 'rekapKoordinat'])->name('koordinat-a');

    Route::get('/getKibbByUPB/{kodeUPB}', [ControllerB::class, 'getByUPB']);
    Route::get('/data_kibb', [ControllerB::class, 'b'])->name('datakibb');
    Route::get('/add-b', function () {
        return view('kib_b.tambah-b');
    });
    Route::post('/add-b', [ControllerB::class, 'storeb'])->name('storeDataKibb');
    Route::get('/detail-b/{id}', [ControllerB::class, 'detailb'])->name('detailDataKibb');
    Route::get('/edit-b/{id}', [ControllerB::class, 'editb'])->name('editDataKibb');
    Route::put('/update-b/{id}', [ControllerB::class, 'updateb'])->name('updateDataKibb');
    Route::delete('/hapus-b/{id}', [ControllerB::class, 'hapusDataKibb'])->name('hapusDataKibb');
    Route::get('/exportb', [ControllerB::class, 'exportb'])->name('exportb');
    Route::get('/export-allb', [ControllerB::class, 'exportAllb'])->name('exportAllb');
    Route::get('/search-b', [ControllerB::class, 'search'])->name('search-b');

    Route::get('/getKibcByUPB/{kodeUPB}', [ControllerC::class, 'getByUPB']);
    Route::get('/data_kibc', [ControllerC::class, 'c'])->name('datakibc');
    Route::get('/add-c', function () {
        return view('kib_c.tambah-c');
    });
    Route::post('/add-c', [ControllerC::class, 'storec'])->name('storeDataKibc');
    Route::get('/detail-c/{id}', [ControllerC::class, 'detailc'])->name('detailDataKibc');
    Route::get('/edit-c/{id}', [ControllerC::class, 'editc'])->name('editDataKibc');
    Route::put('/update-c/{id}', [ControllerC::class, 'updatec'])->name('updateDataKibc');
    Route::delete('/hapus-c/{id}', [ControllerC::class, 'hapusDataKibc'])->name('hapusDataKibc');
    Route::get('/exportc', [ControllerC::class, 'exportc'])->name('exportc');
    Route::get('/export-allc', [ControllerC::class, 'exportAllc'])->name('exportAllc');
    Route::get('/search-c', [ControllerC::class, 'search'])->name('search-c');

    Route::get('/data_user', [UserController::class, 'data'])->name('datauser');
    Route::get('/tambah-user', [UserController::class, 'tambah'])->name('tambahUser');
    Route::post('/tambah-user', [UserController::class, 'store'])->name('storeUser');
    Route::get('/edit_user/{id}', [UserController::class, 'edit'])->name('editDataUser');
    Route::post('/edit_user/{id}', [UserController::class, 'update'])->name('updateDataUser');
    Route::delete('/hapus-user/{id}', [UserController::class, 'destroy'])->name('hapusDataUser');

    Route::get('/files/{filename}', [ControllerA::class, 'showFile'])->middleware('auth')->name('files.download');

    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip');
    Route::get('/arsip/tambah', [ArsipController::class, 'tambah'])->name('arsipTambah');
    Route::post('/arsip/store', [ArsipController::class, 'store'])->name('arsipStore');
    Route::get('/arsip/edit/{id}', [ArsipController::class, 'edit'])->name('arsipEdit');
    Route::get('arsip/files/{filename}', [ArsipController::class, 'showFile'])->name('filesArsip');
});

Route::group(['middleware' => 'upb'], function () {

    Route::get('/home-upb/{KODE_UPB}', [UserControllerA::class, 'home'])->name('home-upb');

    Route::get('/halaman-upb-a/{KODE_UPB}', [UserControllerA::class, 'index'])->name('data-upb-a');
    Route::get('/halaman-upb-b/{KODE_UPB}', [UserControllerB::class, 'index'])->name('data-upb-b');
    Route::get('/halaman-upb-c/{KODE_UPB}', [UserControllerC::class, 'index'])->name('data-upb-c');

    Route::get('/detail-upb-a/{KODE_UPB}/{id}', [UserControllerA::class, 'detail'])->name('detail-upb-a');
    Route::get('/detail-upb-b/{KODE_UPB}/{id}', [UserControllerB::class, 'detail'])->name('detail-upb-b');
    Route::get('/detail-upb-c/{KODE_UPB}/{id}', [UserControllerC::class, 'detail'])->name('detail-upb-c');

    Route::get('/add-upb-a/{KODE_UPB}', [UserControllerA::class, 'create'])->name('add-upb-a');
    Route::post('/add-upb-a/{KODE_UPB}', [UserControllerA::class, 'storeUPB'])->name('store-upb-a');
    Route::get('/add-upb-b/{KODE_UPB}', [UserControllerB::class, 'create'])->name('add-upb-b');
    Route::post('/add-upb-b/{KODE_UPB}', [UserControllerB::class, 'storeUPB'])->name('store-upb-b');
    Route::get('/add-upb-c/{KODE_UPB}', [UserControllerC::class, 'create'])->name('add-upb-c');
    Route::post('/add-upb-c/{KODE_UPB}', [UserControllerC::class, 'storeUPB'])->name('store-upb-c');

    Route::get('/edit-upb-a/{KODE_UPB}/{id}', [UserControllerA::class, 'edit'])->name('edit-upb-a');
    Route::post('/edit-upb-a/{KODE_UPB}/{id}', [UserControllerA::class, 'update'])->name('update-upb-a');
    Route::get('/edit-upb-b/{KODE_UPB}/{id}', [UserControllerB::class, 'edit'])->name('edit-upb-b');
    Route::post('/edit-upb-b/{KODE_UPB}/{id}', [UserControllerB::class, 'updateb'])->name('update-upb-b');
    Route::get('/edit-upb-c/{KODE_UPB}/{id}', [UserControllerC::class, 'edit'])->name('edit-upb-c');
    Route::post('/edit-upb-c/{KODE_UPB}/{id}', [UserControllerC::class, 'updatec'])->name('update-upb-c');

    Route::delete('/delete-upb-a/{KODE_UPB}/{id}', [UserControllerA::class, 'destroy'])->name('delete-upb-a');
    Route::delete('/delete-upb-b/{KODE_UPB}/{id}', [UserControllerB::class, 'destroy'])->name('delete-upb-b');
    Route::delete('/delete-upb-c/{KODE_UPB}/{id}', [UserControllerC::class, 'destroy'])->name('delete-upb-c');

    Route::get('/export-a/{KODE_UPB}', [UserControllerA::class, 'export'])->name('export-upb-a');
    Route::get('/export-b/{KODE_UPB}', [UserControllerB::class, 'export'])->name('export-upb-b');
    Route::get('/export-c/{KODE_UPB}', [UserControllerC::class, 'export'])->name('export-upb-c');

    Route::get('/search-upb-a/{KODE_UPB}', [UserControllerA::class, 'search'])->name('search-upb-a');
    Route::get('/search-upb-b/{KODE_UPB}', [UserControllerB::class, 'search'])->name('search-upb-b');
    Route::get('/search-upb-c/{KODE_UPB}', [UserControllerC::class, 'search'])->name('search-upb-c');

    Route::get('/koordinat-upb-a/{KODE_UPB}', [UserControllerA::class, 'rekapKoordinat'])->name('koordinat-upb-a');

    Route::get('/files/{KODE_UPB}/{filename}', [UserControllerA::class, 'showFile'])->name('files.show-upb');

    // Route::get('/photos/{KODE_UPB}/{filename}', [UserControllerA::class, 'showPhoto'])->name('photos.show-upb');
});
