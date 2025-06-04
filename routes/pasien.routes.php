<?php 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pasien'])->group(function (){
    // dashboard
    Route::get('/pasien/dashboard', [PasienController::class, 'index'])->name('pasien.dashboard');
});


?>