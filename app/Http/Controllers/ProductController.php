<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->orderByDesc('id')->with(['user'])->paginate(20);
        return view('shop.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::query()->get();
        $suppliers = Supplier::query()->get();
        $categories = Category::query()->get();

        return view('shop.product.create', compact('brands', 'suppliers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->user_id = auth()->id();
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->brand_id = $request->brand_id;

        if($request->has('image')){
            $image = $request->file('image')->storeAs(
                'public/products/images', Str::random('32').'.'.$request->file('image')->extension()
            );

            $product->image = str_replace('public/', 'storage/', $image);
        }
        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('shop.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $brands = Brand::query()->get();
        $suppliers = Supplier::query()->get();
        $categories = Category::query()->get();

        return view('shop.product.edit', compact('product', 'brands', 'suppliers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->user_id = auth()->id();
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->brand_id = $request->brand_id;

        if($request->has('image')){
            $image = $request->file('image')->storeAs(
                'public/products/images', Str::random('32').'.'.$request->file('image')->extension()
            );

            $product->image = str_replace('public/', 'storage/', $image);
        }
        $product->save();
        return redirect()->route('product.index')->with('status', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @throws Throwable
     */
    public function destroy(Product $product)
    {
        $product->deleteOrFail();
        return redirect()->route('product.index')->with('status', 'Product deleted successfully');
    }
}

