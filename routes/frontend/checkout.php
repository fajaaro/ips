<?php 

use App\Http\Controllers\Frontend\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'checkout'], function() {
	Route::get('/{id}', [CheckoutController::class, 'index'])->name('frontend.courses.index');
});