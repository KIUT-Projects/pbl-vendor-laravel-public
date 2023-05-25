<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RegisterController;
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
    //Route::middleware('auth:sanctum')->group(function (){
        Route::prefix('product')->group(function (){
            Route::post('/all', [ProductController::class, 'index']);
            Route::post('/search', [ProductController::class, 'products_search']);
            Route::post('/by_category', [ProductController::class, 'product_by_category']);
            Route::post('/id/{id}', [ProductController::class, 'product_by_id']);
        });
        Route::prefix('brand')->group(function (){
            Route::post('/all', [ProductController::class, 'brands']);
        });
        Route::prefix('customer')->group(function (){
            Route::post('/all', [ProductController::class, 'customers']);
        });

        Route::post('/category', [ProductController::class, 'brand_all']);
        Route::any('/products/search', [ProductController::class, 'all']);
        Route::any('/brands', [ProductController::class, 'brand']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // Error Page
        /*Route::any('{segment}', function () {
            return response()->json(['success' => false, 'data' => [], 'message' => 'Bad request.'], 400);
        })->where('segment', '.*');*/
    //});

    // Old API
    Route::any('/products/all', [ProductController::class, 'index']);
    Route::any('/store/cart_to_order', [ProductController::class, 'storeCartToOrder']);

    // Errors API
    Route::get('unauthorized', function () {
        return response()->json(['success' => false, 'data' => [], 'message' => 'Unauthorized.'], 401);
    })->name('unauthorized');

});
