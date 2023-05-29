<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        (int) $per_page = $request->per_page ?? 24;

        if ($request->has('search')){
            $products = Product::query()->where('name', 'LIKE', "%$request->search%")
                ->orWhere('barcode', 'LIKE', "%$request->search%")
                ->with(['brand', 'category', 'supplier', 'user'])->paginate($per_page);
        }else{
            $products = Product::query()->with(['brand', 'category', 'supplier', 'user'])->paginate($per_page);
        }

        return $this->sendResponse(ProductResource::collection($products)->response()->getData(), 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return $this->sendResponse(ProductResource::make($product), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
