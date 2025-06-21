<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsDokter;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     $user = Auth::user();

//     return view('dashboard', ['user'=>$user]);
// })->middleware(['auth', 'verified'])->name('dashboard');

// route::middleware(['auth', IsDokter::class])->group(function (){
//     Route::get('/users/dokter/jadwal', [DokterController::class, 'create']);
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.routes.php';
require __DIR__.'/dokter.routes.php';
require __DIR__.'/pasien.routes.php';
