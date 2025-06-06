<?php 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\JanjiPeriksaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->group(function (){
    // dashboard
    Route::get('/pasien/dashboard', [PasienController::class, 'index'])->name('pasien.dashboard');

    Route::prefix('pasien/janji-periksa')->group(function() {
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
        // Route::get('/create', [JanjiPeriksaController::class, 'create'])->name('pasien.janji-periksa.create');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
    });
});


?>