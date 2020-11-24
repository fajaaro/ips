<?php 

use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile'], function() {
	Route::get('/', [ProfileController::class, 'index'])->name('frontend.profiles.index');
});
