<?php 

use App\Http\Controllers\Backend\CourseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses'], function() {
	Route::get('/', [CourseController::class, 'index'])->name('backend.courses.index');
	Route::get('/create', [CourseController::class, 'create'])->name('backend.courses.create');
	Route::get('/{id}', [CourseController::class, 'show'])->name('backend.courses.show');
	Route::post('/', [CourseController::class, 'store'])->name('backend.courses.store');
	Route::delete('/{id}', [CourseController::class, 'destroy'])->name('backend.courses.destroy');
	Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('backend.courses.edit');
	Route::put('/{id}', [CourseController::class, 'update'])->name('backend.courses.update');
});