<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryWithProductsResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductSoloResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *    path="/category",
     *    operationId="category_index",
     *    tags={"Categories"},
     *    summary="Get list of categories",
     *    description="Get list of categories",
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
     *  )
     */
    public function index(Request $request)
    {
        (int) $per_page = $request->per_page ?? 24;
        (string) $order = $request->order ?? 'desc';

        if ($request->has('search')){
            $products = Category::query()->where('name', 'LIKE', "%$request->search%");
        }else{
            $products = Category::query();
        }

        $products = $products->paginate($per_page);

        if ($order == 'asc'){
            $products = $products->sortBy('id');
        }else{
            $products = $products->sortByDesc('id');
        }


        return $this->sendResponse(CategoryResource::collection($products)->response()->getData(), 'Categories retrieved successfully.');
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
     *
     * @OA\Get(
     *     path="/category/{id}",
     *     operationId="category_show",
     *     tags={"Categories"},
     *     summary="Get Category Detail",
     *     description="Get Category Detail",
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
     *  )
     */
    public function show(Category $category)
    {
        return $this->sendResponse(CategoryResource::make($category), 'Category retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *    path="/category/show_with_products",
     *    operationId="category_show_with_products",
     *    tags={"Categories"},
     *    summary="Get list of products",
     *    description="Get list of products",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="category_id", in="query", description="1", required=true,
     *        @OA\Schema(type="integer")
     *    ),
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
     *  )
     */
    public function show_with_products(Request $request): JsonResponse
    {
        (int)$per_page = $request->per_page ?? 24;
        (string)$order = $request->order ?? 'desc';

        $category = Category::find($request->get('category_id'));



        if ($request->has('search')) {
            $products = Product::query()->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%")
                    ->orWhere('barcode', 'LIKE', "%$request->search%");
            });
        } else {
            $products = Product::query();
        }

        if ($request->has('category_id')) {
            $products = $products->where('category_id', $request->get('category_id'));
        }

        $products = $products->paginate($per_page);

        if ($order == 'asc') {
            $products = $products->sortBy('id');
        } else {
            $products = $products->sortByDesc('id');
        }

        $products = ProductSoloResource::collection($products)->response()->getData();

        $category['products'] = $products;

        return $this->sendResponse(CategoryWithProductsResource::make($category), 'Products retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
