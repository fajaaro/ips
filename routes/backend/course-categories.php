<?php 

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses/categories'], function() {
	Route::get('/', [CategoryController::class, 'index'])->name('backend.course-categories.index');
	Route::get('/create', [CategoryController::class, 'create'])->name('backend.course-categories.create');
	Route::post('/', [CategoryController::class, 'store'])->name('backend.course-categories.store');
	Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('backend.course-categories.destroy');
	Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('backend.course-categories.edit');
	Route::put('/{id}', [CategoryController::class, 'update'])->name('backend.course-categories.update');
});