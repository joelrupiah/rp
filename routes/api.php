<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:admin-api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ADMIN ROUTES

Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthenticateController::class, 'login']);
    Route::post('/register', [AuthenticateController::class, 'register']);
});

Route::middleware(['auth:admin-api', 'scope:admin'])->prefix('admin')->group(function () {
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    Route::post('/logout', [AuthenticateController::class, 'logout']);

    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    Route::post('create-user', [AdminController::class, 'store']);
    Route::post('edit-admin/{id}', [AdminController::class, 'update']);
    Route::delete('delete-admin/{id}', [AdminController::class, 'delete']);

    Route::get('get-all-admins', [AdminController::class, 'getAllAdmins']);
    Route::get('get-all-roles', [RoleController::class, 'getAllRoles']);
    Route::get('get-all-permissions', [PermissionController::class, 'getAllPermissions']);

    Route::get('get-admins', [AdminController::class, 'index']);
    Route::get('get-roles', [RoleController::class, 'index']);
    Route::get('get-permissions', [PermissionController::class, 'index']);

    Route::resource('category', CategoryController::class);
    Route::post('update-category/{id}', [CategoryController::class, 'update']);

    Route::get('products-all', [ProductController::class, 'products']);
    Route::resource('product', ProductController::class);
    Route::post('edit-product/{id}', [ProductController::class, 'update']);
    // Route::get('show-product/{product}', [ProductController::class, 'show']);
    Route::get('all-category', [CategoryController::class, 'getAllCategory']);
    Route::get('active-categories', [CategoryController::class, 'activeCategories']);

    Route::get('all-user-order', [OrderController::class, 'index']);
    Route::get('order-details/{order_id}', [OrderController::class, 'orderDetail']);

    Route::get('get-users', [UserController::class, 'index']);

});

// END ADMIN ROUTES


// USER ROUTES

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::post('send-token', [AuthController::class, 'sendToken']);
Route::post('validate-token', [AuthController::class, 'validateToken']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::get('active-all-categories', [CategoryController::class, 'allActiveCategories']);
Route::get('single-product/{slug}', [ProductController::class, 'showUserSingleProduct'])->name('userSingleProduct');
Route::get('category-product/{slug}', [ProductController::class, 'showCategoryProduct']);

Route::get('user-all-categories', [CategoryController::class, 'allUserCategories']);
Route::get('products-categories', [CategoryController::class, 'productsCategories']);

Route::get('products', [ProductController::class, 'showUserProducts']);

Route::get('cart/cart-items', [CartController::class, 'index'])->middleware(['auth:api', 'scope:user']);
Route::post('cart/add-to-cart', [CartController::class, 'addToCart'])->middleware(['auth:api', 'scope:user']);
Route::post('cart/update-cart', [CartController::class, 'updateCart'])->middleware(['auth:api', 'scope:user']);
Route::delete('cart/delete-cart-item/{id}', [CartController::class, 'destroy'])->middleware(['auth:api', 'scope:user']);
Route::delete('cart/delete-all-cart-items', [CartController::class, 'destroyAll'])->middleware(['auth:api', 'scope:user']);

Route::post('save-wishlist', [WishlistController::class, 'store'])->middleware(['auth:api', 'scope:user']);
Route::get('get-wishlist-products', [WishlistController::class, 'index'])->middleware(['auth:api', 'scope:user']);

// Route::post('user/checkout', [OrderController::class, 'customerMpesaSTKPush'])->middleware(['auth:api', 'scope:user']);
Route::post('user/checkout', [OrderController::class, 'store'])->middleware(['auth:api', 'scope:user']);

Route::post('order-delete', [CartController::class, 'orderDelete'])->middleware(['auth:api', 'scope:user']);

Route::get('user-order', [OrderController::class, 'showUserOrders'])->middleware(['auth:api', 'scope:user']);



// MPESA TEST ROUTES
Route::post('v1/access/token', [OrderController::class,'generateAccessToken']);
Route::post('v1/hlab/stk/push', [OrderController::class, 'customerMpesaSTKPush']);
Route::post('v1/hlab/validation', [OrderController::class, 'mpesaValidation']);
Route::post('v1/hlab/transaction/confirmation', [OrderController::class, 'mpesaConfirmation']);
Route::post('v1/hlab/register/url', [OrderController::class, 'mpesaRegisterUrls']);


Route::middleware(['auth:api', 'scope:user'])->group(function () {
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('get-user-order-detail/{order_id}', [OrderController::class, 'getUserOrder']);
    Route::get('download-pdf/{order_id}', [OrderController::class, 'downloadPdf']);

});

// END USER ROUTES

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
