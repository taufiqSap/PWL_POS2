<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\LevelController;
use App\http\Controllers\UserController;
use App\http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/hello', [WelcomeController::class,'hello']); 
//Route::get('/greeting', [WelcomeController::class,'greeting']); 
Route::get('/', function(){
    return view('welcome');
});
Route::get('/level', [LevelController::class,'index']);
Route::get('/kategori',[KategoriController::class, 'index']);
Route::get('/user',[UserController::class, 'index']);
Route::get('/user/tambah',[UserController::class, 'tambah']);
Route::get('/user/tambah_simpan',[UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}',[UserController::class, 'ubah']);
Route::get('/user/ubah_simpan/{id}',[UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/hapus/{id}',[UserController::class, 'hapus']);