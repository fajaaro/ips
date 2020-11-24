<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);

Route::get('/subdistricts/{id}', [RegisterController::class, 'getSubdistrict'])->name('api.register.getSubdistrict');
Route::get('/provinces/{code}', [RegisterController::class, 'getProvince'])->name('api.register.getProvince');

Route::get('/courses/bundle/{id}', [CourseController::class, 'getBundleCourses'])->name('api.courses.getBundleCourses');
Route::get('/courses/{id}', [CourseController::class, 'getCourse'])->name('api.courses.getCourse');
