<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\JadwalPeriksaController;

Route::middleware(['auth', 'role:dokter'])->group(function (){
    // dashboard
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
    
    // obat
    Route::get('/obat', [ObatController::class, 'index'])->name('dokter.obat.index');

    Route::get('/obat/create', [ObatController::class, 'create'])->name('dokter.obat.create');
    Route::post('/obat/create', [ObatController::class, 'store'])->name('dokter.obat.store');

    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
    Route::put('/obat/{id}/update', [ObatController::class, 'update'])->name('dokter.obat.update');
    
    
    Route::delete('/obat/{id}/destroy', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');

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
});

?>