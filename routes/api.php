<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function () {

    // Login Register API
    Route::controller(RegisterController::class)->group(function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

    // Routes for auth users
    Route::middleware('auth:sanctum')->group(function (){
        Route::apiResource('product', ProductController::class);
        Route::apiResource('brand', BrandController::class);
        Route::get('category/show_with_products', [CategoryController::class, 'show_with_products']);
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('order', OrderController::class);
        Route::apiResource('currency', CurrencyController::class);
        Route::apiResource('language', LanguageController::class);
        Route::apiResource('customer', CustomerController::class);
        Route::apiResource('role', RoleController::class);
        Route::apiResource('staff', StaffController::class);
        Route::apiResource('supplier', SupplierController::class);
        Route::apiResource('user', UserController::class);

        // Error Page
        Route::any('{segment}', function () {
            return response()->json(['success' => false, 'data' => [], 'message' => 'Bad request.'], 400);
        })->where('segment', '.*');
    });

    // Old API
    Route::any('/products/all', [ProductController::class, 'index']);
    Route::any('/store/cart_to_order', [ProductController::class, 'storeCartToOrder']);

    // Errors API
    Route::get('unauthorized', function () {
        return response()->json(['success' => false, 'data' => [], 'message' => 'Unauthorized.'], 401);
    })->name('unauthorized');

});
