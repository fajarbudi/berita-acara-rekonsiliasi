<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\referensi\RekeningController;
use App\Http\Controllers\referensi\BelanjaController;
use App\Http\Controllers\referensi\MekanismeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaAcara;
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

route::group(['middleware' => ['isLogin']], function () {
    Route::get('/', function () {
        return view('welcome');
    });


    Route::get('/user/{kewenangan}', [UserController::class, 'view'])->name('user.view');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/user/simpan', [UserController::class, 'simpan'])->name('user.simpan');

    Route::get('/rekening', [RekeningController::class, 'view'])->name('rekening.view');
    Route::post('/rekening/delete', [RekeningController::class, 'delete'])->name('rekening.delete');
    Route::post('/rekening/simpan', [RekeningController::class, 'simpan'])->name('rekening.simpan');

    Route::get('/belanja', [BelanjaController::class, 'view'])->name('belanja.view');
    Route::post('/belanja/delete', [BelanjaController::class, 'delete'])->name('belanja.delete');
    Route::post('/belanja/simpan', [BelanjaController::class, 'simpan'])->name('belanja.simpan');

    Route::get('/mekanisme', [MekanismeController::class, 'view'])->name('mekanisme.view');
    Route::post('/mekanisme/delete', [MekanismeController::class, 'delete'])->name('mekanisme.delete');
    Route::post('/mekanisme/simpan', [MekanismeController::class, 'simpan'])->name('mekanisme.simpan');

    Route::get('/berita-acara', [BeritaAcara::class, 'view'])->name('berita_acara.view');
    Route::get('/berita-acara/new', [BeritaAcara::class, 'new'])->name('berita_acara.new');
    Route::get('/berita-acara/detail/{id}', [BeritaAcara::class, 'detail'])->name('berita_acara.detail');
    Route::get('/berita-acara/edit/{id}', [BeritaAcara::class, 'edit'])->name('berita_acara.edit');
    Route::post('/berita-acara/simpan', [BeritaAcara::class, 'simpan'])->name('berita_acara.simpan');
});