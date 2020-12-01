<?php 

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses/categories'], function() {
	Route::get('/', [CategoryController::class, 'index'])->name('backend.courseCategories.index');
	Route::get('/create', [CategoryController::class, 'create'])->name('backend.courseCategories.create');
	Route::post('/', [CategoryController::class, 'store'])->name('backend.courseCategories.store');
	Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('backend.courseCategories.destroy');
	Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('backend.courseCategories.edit');
	Route::put('/{id}', [CategoryController::class, 'update'])->name('backend.courseCategories.update');
});