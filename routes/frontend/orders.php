<?php 

use App\Http\Controllers\Frontend\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function() {
	Route::post('/', [OrderController::class, 'store'])->name('frontend.orders.store');
	Route::get('/{id}/checkout', [OrderController::class, 'checkout'])->name('frontend.orders.checkout');
});