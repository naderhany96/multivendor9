<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->group(function () {

    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    // admin middleware
    Route::group(['middleware' => 'admin'], function () {

        Route::controller(AdminController::class)->group(function () {
          
            Route::get('dashboard',  'dashboard');
            Route::get('logout',  'logout');
    
            Route::match(['get', 'post'], 'update-password',  'updatePassword');

            Route::match(['get', 'post'], 'check-password',  'checkPassword');
        });
   
    });
});
