<?php
use App\Http\Controllers\Auth;
use App\Http\Controllers\evidencias;
use App\Http\Controllers\exts;
use App\Http\Controllers\registro;

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
// usuario
Route::get('/',[Auth::class,'index'])->name('login');
Route::post('/logear',[Auth::class,'logear'])->name('logear');
Route::get('/logout',[Auth::class, 'logout'])->name('logout');
Route::get('/nuevo_usuario',[Auth::class,'nuevo_usuario']);
Route::get('/inicio',[exts::class,'index'])->name('inicio');

// alumno
Route::post('/store',[registro::class,'store'])->name('store');
Route::put('update/{id}', [registro::class, 'update'])->name('update');
Route::get('/edit/{id}', [alumnos::class, 'edit'])->name('edit');
Route::get('/show/{id}',[alumnos::class,'show'])->name('show');
Route::delete('/destroy/{id}',[registro:: class, 'destroy'])->name('destroy');

// creditos
Route::get('/creditos/{id}', [evidencias::class, 'index'])->name('creditos');
Route::post('/store_credito',[evidencias::class,'store'])->name('store_credito');
Route::put('/update_evidencias/{id}', [evidencias::class, 'update_evidencias'])->name('update_evidencias');
Route::get('/edit_evidencias/{id}', [evidencias::class, 'edit_evidencias'])->name('edit_evidencias');