<?php 

use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile'], function() {
	Route::get('/', [ProfileController::class, 'index'])->name('frontend.profiles.index');
	Route::get('/edit', [ProfileController::class, 'edit'])->name('frontend.profiles.edit');
	Route::put('/change-password', [ProfileController::class, 'changePassword'])->name('frontend.profiles.changePassword');
	Route::put('/', [ProfileController::class, 'update'])->name('frontend.profiles.update');
});
