<?php 

use App\Http\Controllers\Backend\CourseCategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses/categories'], function() {
	Route::get('/', [CourseCategoryController::class, 'index'])->name('backend.course-categories.index');
	Route::get('/create', [CourseCategoryController::class, 'create'])->name('backend.course-categories.create');
	Route::post('/', [CourseCategoryController::class, 'store'])->name('backend.course-categories.store');
	Route::delete('/{id}', [CourseCategoryController::class, 'destroy'])->name('backend.course-categories.destroy');
	Route::get('/{id}/edit', [CourseCategoryController::class, 'edit'])->name('backend.course-categories.edit');
	Route::put('/{id}', [CourseCategoryController::class, 'update'])->name('backend.course-categories.update');
});