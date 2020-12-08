<?php 

use App\Http\Controllers\Backend\CourseBundleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses/bundles'], function() {
	Route::get('/', [CourseBundleController::class, 'index'])->name('backend.course-bundles.index');
	Route::get('/create', [CourseBundleController::class, 'create'])->name('backend.course-bundles.create');
	Route::post('/', [CourseBundleController::class, 'store'])->name('backend.course-bundles.store');
	Route::delete('/{id}', [CourseBundleController::class, 'destroy'])->name('backend.course-bundles.destroy');
	Route::get('/{id}/edit', [CourseBundleController::class, 'edit'])->name('backend.course-bundles.edit');
	Route::get('/{id}/add-course', [CourseBundleController::class, 'editCourse'])->name('backend.course-bundles.editCourse');
	Route::post('/{id}/add-course', [CourseBundleController::class, 'updateCourse'])->name('backend.course-bundles.updateCourse');
	Route::put('/{id}', [CourseBundleController::class, 'update'])->name('backend.course-bundles.update');
});