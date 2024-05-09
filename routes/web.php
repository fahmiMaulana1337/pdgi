<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role=="1") {
        return redirect()->route('isSuperAdmin');
    }
    elseif (Auth::check() && Auth::user()->role=="2") {
        return redirect()->route('isSuperAdmin');
    }
    elseif (Auth::check() && Auth::user()->role=="3") {
        return redirect()->route('isSuperAdmin');
    }
    return view('auth.login');
});


Route::group(['prefix'=>'superAdmin', 'middleware'=>['roleSuperAdmin','auth']], function(){
    Route::get('/', [SuperAdminController::class, 'index'])->name('isSuperAdmin');
    Route::get('tambahAkun',[SuperAdminController::class,'tambahAkun'])->name('tambahAkun');
    Route::get('daftarSurat',[SuperAdminController::class,'daftarSurat'])->name('daftarSurat');
    Route::get('daftarSuratValidasi',[SuperAdminController::class,'daftarSuratValidasi'])->name('daftarSuratValidasi');
    
    Route::post('tambahAkun',[SuperAdminController::class,'postAkun'])->name('postAkun');

    Route::get('databaseAkun',[SuperAdminController::class,'databaseAkun'])->name('databaseAkun');
    Route::get('editAkun/{id}',[SuperAdminController::class,'editAkun'])->name('editAkun');
    Route::post('editAkun/{id}',[SuperAdminController::class,'updateAkun'])->name('updateAkun');
    Route::get('delete/{id}',[SuperAdminController::class,'deleteAkun'])->name('deleteAkun');
    Route::get('download/surat/file={file}', [SuperAdminController::class, 'downloadSurat'])->name('super-downloadSurat');

    Route::get('validasiSurat/{id}',[SuperAdminController::class,'acceptSurat'])->name('acceptSurat');
    Route::post('validasiSurat/{id}',[SuperAdminController::class,'postAccept'])->name('postAccept');
    Route::get('tolakSurat/{id}',[SuperAdminController::class,'tolakSurat'])->name('tolakSurat');
    Route::post('tolakSurat/{id}',[SuperAdminController::class,'postTolak'])->name('postTolak');

    Route::get('arsipSurat',[SuperAdminController::class,'arsipSurat'])->name('arsipSurat');
    Route::get('searchArsip',[SuperAdminController::class,'searchArsip'])->name('search');
    Route::get('arsipSurat/Umum',[SuperAdminController::class,'filterKategoriUmum'])->name('filterUmum');
    Route::get('arsipSurat/Cabang',[SuperAdminController::class,'filterKategoriCabang'])->name('filterCabang');
    Route::get('filterTerlama',[SuperAdminController::class,'filterTerlama'])->name('filterTerlama');
    Route::get('filterTerbaru',[SuperAdminController::class,'filterTerbaru'])->name('filterTerbaru');



});

Route::group(['prefix'=>'admin', 'middleware'=>['roleAdmin','auth']], function(){
    Route::get('/', [AdminController::class, 'index'])->name('isAdmin');
    Route::get('daftarPengajuan', [AdminController::class, 'daftarPengajuan'])->name('admin-daftarPengajuan');
    Route::get('suratKeluar', [AdminController::class, 'suratKeluar'])->name('admin-suratKeluar');
    Route::get('/', [AdminController::class, 'index'])->name('isAdmin');
    Route::get('/uploadSurat', [AdminController::class, 'uploadSurat'])->name('admin-uploadSurat');
    Route::post('/uploadSurat', [AdminController::class, 'postUpload'])->name('admin-postUpload');
    Route::get('/balasSurat', [AdminController::class, 'balasSurat'])->name('admin-balasSurat');
    Route::post('/balasSurat', [AdminController::class, 'postBalas'])->name('admin-postBalas');
    Route::get('download/surat/file={file}', [AdminController::class, 'downloadSurat'])->name('downloadSurat');
    Route::get('teruskanSurat/{id}', [AdminController::class, 'teruskanSurat'])->name('teruskanSurat');
    Route::get('mail', [MailController::class, 'index'])->name('mail');
    Route::get('daftarSuratValidasi',[AdminController::class,'daftarSuratValidasi'])->name('admin-daftarSuratValidasi');

    Route::get('arsipSurat',[AdminController::class,'arsipSurat'])->name('admin-arsipSurat');
    Route::get('searchArsip',[AdminController::class,'searchArsip'])->name('admin-search');
    Route::get('arsipSurat/Umum',[AdminController::class,'filterKategoriUmum'])->name('admin-filterUmum');
    Route::get('arsipSurat/Cabang',[AdminController::class,'filterKategoriCabang'])->name('admin-filterCabang');
    Route::get('filterTerlama',[AdminController::class,'filterTerlama'])->name('admin-filterTerlama');
    Route::get('filterTerbaru',[AdminController::class,'filterTerbaru'])->name('admin-filterTerbaru');
   
});


    Route::group(['prefix'=>'user', 'middleware'=>['roleUser','auth']], function(){
        Route::get('/', [UserController::class, 'index'])->name('isUser');
        Route::get('/uploadSurat', [UserController::class, 'uploadSurat'])->name('uploadSurat');
        Route::post('/uploadSurat', [UserController::class, 'postUpload'])->name('postUpload');
        Route::get('/daftarPengajuanSurat', [UserController::class, 'pengajuanSurat'])->name('daftarPengajuan');
        Route::get('/suratMasuk', [UserController::class, 'suratMasuk'])->name('suratMasuk');
        Route::get('download/surat/file={file}', [UserController::class, 'userDownloadSurat'])->name('user-downloadSurat');
 
});
