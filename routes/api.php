<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Admin\LoginController::class, 'index', ['as' => 'admin']]);

    //group route with middleware "auth:api_admin"
    Route::group(['middleware' => 'auth:api_admin'], function() {

        //data user
        Route::get('/user', [App\Http\Controllers\Api\Admin\LoginController::class, 'getUser', ['as' => 'admin']]);

        //refresh token JWT
        Route::get('/refresh', [App\Http\Controllers\Api\Admin\LoginController::class, 'refreshToken', ['as' => 'admin']]);

        //logout
        Route::post('/logout', [App\Http\Controllers\Api\Admin\LoginController::class, 'logout', ['as' => 'admin']]);
        
        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Api\Admin\DashboardController::class, 'index', ['as' => 'admin']]);

        //categories resource
        Route::apiResource('/categories', App\Http\Controllers\Api\Admin\CategoryController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

        //products resource
        Route::apiResource('/products', App\Http\Controllers\Api\Admin\ProductController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

        //invoices resource
        Route::apiResource('/invoices', App\Http\Controllers\Api\Admin\InvoiceController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);

        //customer
        Route::get('/customers', [App\Http\Controllers\Api\Admin\CustomerController::class, 'index', ['as' => 'admin']]);

        //sliders resource
        Route::apiResource('/sliders', App\Http\Controllers\Api\Admin\SliderController::class, ['except' => ['create', 'show', 'edit', 'update'], 'as' => 'admin']);

        //users resource
        Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

    });
});

//route login
Route::prefix('customer')->group(function () {

    //route register
    Route::post('/register', [App\Http\Controllers\Api\Customer\RegisterController::class, 'store'], ['as' => 'customer']);

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Customer\LoginController::class, 'index'], ['as' => 'customer']);

    //group route with middleware "auth:api_customer"
    Route::group(['middleware' => 'auth:api_customer'], function() {

        //data user
        Route::get('/user', [App\Http\Controllers\Api\Customer\LoginController::class, 'getUser'], ['as' => 'customer']);

        //refresh token JWT
        Route::get('/refresh', [App\Http\Controllers\Api\Customer\LoginController::class, 'refreshToken'], ['as' => 'customer']);

        //logout
        Route::post('/logout', [App\Http\Controllers\Api\Customer\LoginController::class, 'logout'], ['as' => 'customer']);

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Api\Customer\DashboardController::class, 'index'], ['as' => 'customer']);
    });

});