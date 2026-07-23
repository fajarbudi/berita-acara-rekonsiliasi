<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\referensi\RekeningController;
use App\Http\Controllers\referensi\BelanjaController;
use App\Http\Controllers\referensi\MekanismeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaAcara;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\referensi\SKPDController;
use Illuminate\Support\Facades\Route;

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

    Route::get('auth/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('auth/login', [AuthController::class, 'goLogin'])->name('auth.goLogin');
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/ubah_user', [UserController::class, 'ubah']);
    Route::get('/login-etam/{id}', [AuthController::class, 'loginEtam']);

route::group(['middleware' => ['isLogin']], function () {
    Route::get('/', [Dashboard::class, 'view'])->name('dashboard');

    Route::get('/berita-acara/detailKonten/{id}',[BeritaAcara::class, 'kontenDetail'])->name('getKontenDetail');

    Route::get('/user', [UserController::class, 'view'])->name('user.view');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/user/simpan', [UserController::class, 'simpan'])->name('user.simpan');

    Route::get('/rekening', [RekeningController::class, 'view'])->name('rekening.view');
    Route::post('/rekening/delete', [RekeningController::class, 'delete'])->name('rekening.delete');
    Route::post('/rekening/simpan', [RekeningController::class, 'simpan'])->name('rekening.simpan');

    Route::get('/skpd', [SKPDController::class, 'view'])->name('skpd.view');
    Route::post('/skpd/delete', [SKPDController::class, 'delete'])->name('skpd.delete');
    Route::post('/skpd/simpan', [SKPDController::class, 'simpan'])->name('skpd.simpan');

    Route::get('/belanja', [BelanjaController::class, 'view'])->name('belanja.view');
    Route::post('/belanja/delete', [BelanjaController::class, 'delete'])->name('belanja.delete');
    Route::post('/belanja/simpan', [BelanjaController::class, 'simpan'])->name('belanja.simpan');

    Route::get('/mekanisme', [MekanismeController::class, 'view'])->name('mekanisme.view');
    Route::post('/mekanisme/delete', [MekanismeController::class, 'delete'])->name('mekanisme.delete');
    Route::post('/mekanisme/simpan', [MekanismeController::class, 'simpan'])->name('mekanisme.simpan');

    Route::get('/berita-acara', [BeritaAcara::class, 'view'])->name('berita_acara.view');
    Route::get('/berita-acara/new', [BeritaAcara::class, 'new'])->name('berita_acara.new');
    Route::post('/berita-acara/delete', [BeritaAcara::class, 'hapus'])->name('berita_acara.delete');
    Route::get('/berita-acara/detail/{id}', [BeritaAcara::class, 'detail'])->name('berita_acara.detail');
    Route::get('/berita-acara/edit/{id}', [BeritaAcara::class, 'edit'])->name('berita_acara.edit');
    Route::post('/berita-acara/simpan', [BeritaAcara::class, 'simpan'])->name('berita_acara.simpan');
    Route::get('/berita-acara/{id}/excel', [BeritaAcara::class, 'excel'])->name('berita_acara.excel');
    Route::get('/cetak-berita-acara/{id}', function ($id) {
        return view('berita_acara.cetak', compact('id'));
    })->name('berita_acara.cetak');
    Route::post('/berita-acara/upFile/{id}',[BeritaAcara::class, 'upFile'])->name('berita_acara.upFile');
    Route::get('/berita-acara/kunciData/{id}',[BeritaAcara::class, 'kunciData'])->name('berita_acara.kunciData');
    Route::get('/berita-acara/cetakPDF/{id}',[BeritaAcara::class, 'createPDF'])->name('berita_acara.cetakPDF');
});