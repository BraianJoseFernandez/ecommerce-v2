<?php

use App\Http\Controllers\ProfilePhotoController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Models\Variant;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\FamilyController;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Ruta para servir fotos de perfil
Route::get('/profile-photo/{user}', [ProfilePhotoController::class, 'show'])->name('profile.photo');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');