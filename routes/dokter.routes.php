<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\JadwalPeriksaController;
use App\Http\Controllers\DetailPeriksaController;

Route::middleware(['auth', 'role:dokter'])->group(function (){
    // dashboard
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    
    // obat
    Route::get('/obat', [ObatController::class, 'index'])->name('dokter.obat.index');

    Route::get('/obat/create', [ObatController::class, 'create'])->name('dokter.obat.create');
    Route::post('/obat/create', [ObatController::class, 'store'])->name('dokter.obat.store');

    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
    Route::put('/obat/{id}/update', [ObatController::class, 'update'])->name('dokter.obat.update');
    
    
    Route::delete('/obat/{id}/softdelete', [ObatController::class, 'softdelete'])->name('dokter.obat.softdelete');
    Route::get('/obat/trash', [ObatController::class, 'trash'])->name('dokter.obat.trash');
    Route::patch('/obat/{id}/trash/recover', [ObatController::class, 'recover'])->name('dokter.obat.recover');
    Route::delete('/obat/{id}/force-delete', [ObatController::class, 'forceDelete'])->name('dokter.obat.force-delete');


    // jadwal
    Route::get('/dokter/jadwal-periksa/', [JadwalPeriksaController::class, 'index'])->
        name('dokter.jadwal-periksa.index');
    // create
    Route::get('/dokter/jadwal-periksa/create', [JadwalPeriksaController::class, 'create'])->
        name('dokter.jadwal-periksa.create');
    // store
    Route::post('/dokter/jadwal-periksa/store', [JadwalPeriksaController::class, 'store'])->
        name('dokter.jadwal-periksa.store');
    // enable or disable
    Route::get('/dokter/jadwal-periksa/{id}/enable', [JadwalPeriksaController::class, 'enable'])->
        name('dokter.jadwal-periksa.enable');
    Route::get('/dokter/jadwal-periksa/{id}/disable', [JadwalPeriksaController::class, 'disable'])->
        name('dokter.jadwal-periksa.disable');
    // delete
    Route::delete('/dokter/jadwal-periksa/{id}/destroy', [JadwalPeriksaController::class, 'destroy'])->
        name('dokter.jadwal-periksa.destroy');
    
    // memeriksa pasien
    Route::get('/dokter/memeriksa', [PeriksaController::class, 'index'])->name('dokter.memeriksa.index');
    Route::get('/dokter/memeriksa/{id}/periksa', [PeriksaController::class, 'create'])->name('dokter.memeriksa.periksa');
    Route::post('/dokter/memeriksa/{id}/store', [PeriksaController::class, 'store'])->name('dokter.memeriksa.store');
    Route::get('/dokter/memeriksa/{id}/detail', [PeriksaController::class, 'detail'])->name('dokter.memeriksa.detail');
    Route::get('/dokter/memeriksa/{id}/edit', [PeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
    Route::patch('/dokter/memeriksa/{id}/update', [PeriksaController::class, 'update'])->name('dokter.memeriksa.update');
   
    // detail periksa
    Route::post('/dokter/memeriksa/periksa/detail/{id}/delete', [DetailPeriksaController::class, 'delete'])->
    name('dokter.detail-periksa.delete');

});

?>