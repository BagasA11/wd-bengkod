<?php 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\JanjiPeriksaController;
use App\Http\Controllers\RiwayatPeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->group(function (){
    // dashboard
    Route::get('/pasien/dashboard', [PasienController::class, 'index'])->name('pasien.dashboard');

    Route::prefix('pasien/janji-periksa')->group(function() {
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
        // Route::get('/create', [JanjiPeriksaController::class, 'create'])->name('pasien.janji-periksa.create');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
        
        Route::get('/{id}/edit', [JanjiPeriksaController::class, 'edit'])->name('pasien.janji-periksa.edit');
        Route::put('/{id}/update', [JanjiPeriksaController::class, 'update'])->name('pasien.janji-periksa.update');
        Route::delete('/{id}/cancel', [JanjiPeriksaController::class, 'cancel'])->name('pasien.janji-periksa.cancel');
    });

    Route::prefix('pasien/riwayat-periksa')->group(function() {
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.detail');
    });
});


?>