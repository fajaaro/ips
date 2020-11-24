<?php 

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/'], function() {
	Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
});
