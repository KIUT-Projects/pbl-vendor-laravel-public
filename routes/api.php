<?php

use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::any('/products', [ProductController::class, 'products']);
Route::any('/products/search', [ProductController::class, 'all']);
Route::any('/brands', [ProductController::class, 'brand']);
Route::any('/store/cart_to_order', [ProductController::class, 'storeCartToOrder']);
