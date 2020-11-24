<?php 

use App\Http\Controllers\Frontend\CourseController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'courses'], function() {
	Route::get('/', [CourseController::class, 'index'])->name('frontend.courses.index');
	Route::get('/{id}', [CourseController::class, 'show'])->name('frontend.courses.show');
	Route::get('/{id}/watch', [CourseController::class, 'watch'])->middleware('course.subscriber')->name('frontend.courses.watch');
});
