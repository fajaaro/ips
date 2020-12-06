<?php 

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function() {
	Route::get('/', [UserController::class, 'index'])->name('backend.users.index');
	Route::get('/create', [UserController::class, 'create'])->name('backend.users.create');
	Route::get('/{id}', [UserController::class, 'show'])->name('backend.users.show');
	Route::post('/', [UserController::class, 'store'])->name('backend.users.store');
	Route::delete('/{id}', [UserController::class, 'destroy'])->name('backend.users.destroy');
	Route::get('/{id}/edit', [UserController::class, 'edit'])->name('backend.users.edit');
	Route::put('/{id}', [UserController::class, 'update'])->name('backend.users.update');
});