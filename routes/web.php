<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\RiwayatStrukturalController;
use App\Http\Controllers\RiwayatKeaktifanController;
use App\Models;
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
Route::get('/',function(){
    return redirect('/crud');
});
Route::get('/crud',[CrudController::class,'index'])->name('crud.list');
Route::post('/crud/store', [CrudController::class, 'store'])->name('crud.store');

Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');

Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');
Route::put('/crud/{id}',[CrudController::class,'update'])->name('crud.update');

Route::get('/crud/{id}/keluarga',[KeluargaController::class,'profileKaryawan'])->name('crud.keluarga');
Route::get('/keluarga/create/{pegawai}',[KeluargaController::class,'create'])->name('keluarga.create');
Route::post('/keluarga/store',[KeluargaController::class,'store'])->name('keluarga.store');
Route::delete('/keluarga/{id}',[KeluargaController::class,'destroy'])->name('keluarga.destroy');
Route::get('/keluarga/{id}',[KeluargaController::class,'editkeluarga'])->name('keluarga.edit');
Route::put('/keluarga/{id}',[KeluargaController::class,'updatekeluarga'])->name('keluarga.update');
Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');


Route::get('/crud/{id}/struktural',[RiwayatStrukturalController::class,'riwayatStruktural'])->name('crud.struktural');
Route::get('/struktural/create/{pegawai}',[RiwayatStrukturalController::class,'create'])->name('struktural.create');
Route::post('/struktural/store',[RiwayatStrukturalController::class,'store'])->name('struktural.store');
Route::delete('/struktural/{id}',[RiwayatStrukturalController::class,'destroy'])->name('struktural.destroy');
Route::get('/struktural/{id}',[RiwayatStrukturalController::class,'editstruktural'])->name('struktural.edit');
Route::put('/struktural/{id}',[RiwayatStrukturalController::class,'updatestruktural'])->name('struktural.update');

Route::get('/crud/{id}/keaktifan',[RiwayatKeaktifanController::class,'riwayatKeaktifan'])->name('crud.keaktifan');
Route::get('/keaktifan/create/{pegawai}',[RiwayatKeaktifanController::class,'create'])->name('keaktifan.create');
Route::post('/keaktifan/store',[RiwayatKeaktifanController::class,'store'])->name('keaktifan.store');
Route::delete('/keaktifan/{id}',[RiwayatKeaktifanController::class,'destroy'])->name('keaktifan.destroy');
Route::get('/keaktifan/{id}',[RiwayatKeaktifanController::class,'editkeaktifan'])->name('keaktifan.edit');
Route::put('/keaktifan/{id}',[RiwayatKeaktifanController::class,'updatekeaktifan'])->name('keaktifan.update');