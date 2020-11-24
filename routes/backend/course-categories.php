<?php 

use App\Http\Controllers\Backend\CourseCategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'course-categories'], function() {
	Route::get('/', [CourseCategoryController::class, 'index'])->name('backend.courseCategories.index');
	Route::get('/create', [CourseCategoryController::class, 'create'])->name('backend.courseCategories.create');
	Route::post('/', [CourseCategoryController::class, 'store'])->name('backend.courseCategories.store');
	Route::delete('/{id}', [CourseCategoryController::class, 'destroy'])->name('backend.courseCategories.destroy');
	Route::get('/{id}/edit', [CourseCategoryController::class, 'edit'])->name('backend.courseCategories.edit');
	Route::put('/{id}', [CourseCategoryController::class, 'update'])->name('backend.courseCategories.update');
});