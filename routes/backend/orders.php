<?php 
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'orders'], function() {
	Route::get('/', [OrderController::class, 'index'])->name('backend.orders.index');
	Route::get('/create', [OrderController::class, 'create'])->name('backend.orders.create');
	Route::get('/{id}', [OrderController::class, 'show'])->name('backend.orders.show');
	Route::post('/', [OrderController::class, 'store'])->name('backend.orders.store');
	Route::delete('/{id}', [OrderController::class, 'destroy'])->name('backend.orders.destroy');
	Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('backend.orders.edit');
	Route::put('/{id}', [OrderController::class, 'update'])->name('backend.orders.update');
});
