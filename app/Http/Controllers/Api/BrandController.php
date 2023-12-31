<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        (int) $per_page = $request->per_page ?? 24;

        $brands = Brand::query()->paginate($per_page);

        return $this->sendResponse(BrandResource::collection($brands)->response()->getData(), 'Brand retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $brand = Brand::query()->create($request->toArray());
        return $this->sendResponse($brand, 'Brand create successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand): JsonResponse
    {
        return $this->sendResponse(BrandResource::make($brand), 'Brand retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand): JsonResponse
    {
        $brand = Brand::query()->update($request->toArray());
        return $this->sendResponse($brand, 'Brand update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): JsonResponse
    {
        return $this->sendResponse($brand->query()->delete(), 'Brand update successfully.');
    }
}
