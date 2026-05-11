<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShipmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image.update');
    Route::get('profile/change-avatar', [ProfileController::class, 'showChangeAvatar'])->name('profile.changeAvatar.show');
    Route::post('profile/change-avatar', [ProfileController::class, 'changeAvatar'])->name('profile.changeAvatar');
});

Route::view('/products', 'create_product');
Route::post('/products/create', [ProductsController::class, 'create']);
Route::get('/products/flush', [ProductsController::class, 'flush']);

Route::resource('shipments', ShipmentController::class);

require __DIR__.'/auth.php';



