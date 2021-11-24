<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

    Route::get('products-all', [ProductController::class, 'products']);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('all-category', [CategoryController::class, 'getAllCategory']);
});

Route::get('/', function(){
    return view('user.user_master');
});

Route::get('/admin', function(){
    return view('admin.admin_master');
});

Route::get('/admin', function(){
    return view('admin.admin_master');
});

Route::get('/', function(){
    return view('user.user_master');
});

Route::get('/{any}', function(){
    return view('user.user_master');
});

Route::get('/admin/{any}', function(){
    return view('admin.admin_master');
});

Route::get('/admin/{any}/{id}', function () {
    return view('admin.admin_master');
});

Route::get('/{any}/{id}', function () {
    return view('user.user_master');
});

Route::get('/admin/{any}/{path}/{id}', function () {
    return view('admin.admin_master');
});
