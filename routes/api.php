<?php

use App\Http\Controllers\Api\ApiController;
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
    Route::post('/all', [ApiController::class, 'products']);
    Route::post('/search', [ApiController::class, 'products_search']);
    Route::post('/by_category', [ApiController::class, 'product_by_category']);
    Route::post('/id/{id}', [ApiController::class, 'product_by_id']);
});
Route::prefix('brand')->group(function (){
    Route::post('/all', [ApiController::class, 'brands']);
});
Route::prefix('customer')->group(function (){
    Route::post('/all', [ApiController::class, 'customers']);
});

Route::post('/category', [ApiController::class, 'brand_all']);

Route::any('/products', [ApiController::class, 'products']);
Route::any('/products/search', [ApiController::class, 'all']);
Route::any('/brands', [ApiController::class, 'brand']);
Route::any('/store/cart_to_order', [ApiController::class, 'storeCartToOrder']);
