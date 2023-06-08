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
     *
     * @OA\Get(
     *    path="/product",
     *    operationId="index",
     *    tags={"Products"},
     *    summary="Get list of products",
     *    description="Get list of products",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="per_page", in="query", description="24", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="page", in="query", description="1", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="order", in="query", description="order  accepts 'asc' or 'desc'", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *
     *    @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="message",type="string", example="Success."),
     *             @OA\Property(property="data",type="object")
     *          )
     *       ),
     *     @OA\Response(
     *          response=401, description="Error",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message",type="string", example="Route not found.")
     *          )
     *       )
     *  )
     */
    public function index(Request $request): JsonResponse
    {
        (int) $per_page = $request->per_page ?? 24;
        (string) $order = $request->order ?? 'desc';

        if ($request->has('search')){
            $products = Product::query()->where('name', 'LIKE', "%$request->search%")
                ->orWhere('barcode', 'LIKE', "%$request->search%")
                ->with(['brand', 'category', 'supplier', 'user']);
        }else{
            $products = Product::query()->with(['brand', 'category', 'supplier', 'user']);
        }

        $products = $products->paginate($per_page);

        if ($order == 'asc'){
            $products = $products->sortBy('id');
        }else{
            $products = $products->sortByDesc('id');
        }


        return $this->sendResponse(ProductResource::collection($products)->response()->getData(), 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *      path="/product",
     *      operationId="store",
     *      tags={"Products"},
     *      summary="Store article in DB",
     *      description="Store article in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "content", "status"},
     *            @OA\Property(property="title", type="string", format="string", example="Test Article Title"),
     *            @OA\Property(property="content", type="string", format="string", example="This is a description for kodementor"),
     *            @OA\Property(property="status", type="string", format="string", example="Published"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="message",type="string", example="Route not found."),
     *             @OA\Property(property="data",type="object")
     *          )
     *       ),
     *     @OA\Response(
     *          response=401, description="Error",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message",type="string", example="Route not found.")
     *          )
     *       )
     *  )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/product/{id}",
     *     operationId="show",
     *     tags={"Products"},
     *     summary="Get Product Detail",
     *     description="Get Product Detail",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", description="1", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="message",type="string", example="Route not found."),
     *             @OA\Property(property="data",type="object")
     *          )
     *       ),
     *     @OA\Response(
     *          response=401, description="Error",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message",type="string", example="Route not found.")
     *          )
     *       )
     *  )
     */
    public function show(Product $product): JsonResponse
    {
        return $this->sendResponse(ProductResource::make($product), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *      path="/product/{id}",
     *      operationId="update",
     *      tags={"Products"},
     *      summary="Delete Product",
     *      description="Delete Product",
     *      @OA\Parameter(name="id", in="path", description="Id of Product", required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "content", "status"},
     *            @OA\Property(property="title", type="string", format="string", example="Test Article Title"),
     *            @OA\Property(property="content", type="string", format="string", example="This is a description for kodementor"),
     *            @OA\Property(property="status", type="string", format="string", example="Published"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="message",type="string", example="Route not found."),
     *             @OA\Property(property="data",type="object")
     *          )
     *       ),
     *     @OA\Response(
     *          response=401, description="Error",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message",type="string", example="Route not found.")
     *          )
     *       )
     *  )
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *      path="/product/{id}",
     *      operationId="destroy",
     *      tags={"Products"},
     *      summary="Destroy Product",
     *      description="Destroy Product",
     *      @OA\Parameter(name="id", in="path", description="Id of Article", required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "content", "status"},
     *            @OA\Property(property="title", type="string", format="string", example="Test Article Title"),
     *            @OA\Property(property="content", type="string", format="string", example="This is a description for kodementor"),
     *            @OA\Property(property="status", type="string", format="string", example="Published"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="message",type="string", example="Route not found."),
     *             @OA\Property(property="data",type="object")
     *          )
     *       ),
     *     @OA\Response(
     *          response=401, description="Error",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message",type="string", example="Route not found.")
     *          )
     *       )
     *  )
     */
    public function destroy(Product $product)
    {
        //
    }
}
