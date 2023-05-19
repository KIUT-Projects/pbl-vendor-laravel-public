<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function products(){
        try {
            $products = Product::where('deleted', '0')->where('status', '1')->get();
        }catch (\Exception $exception){
            return response()->forbidden($exception->getMessage());
        }

        return response()->ok($products);
    }

    public function products_search(Request $request){
        $request->validate([
            'query' => 'required|max:255'
        ]);

        try {
            $products = Product::where('deleted', '0')->where('status', '1')->get();
        }catch (\Exception $exception){
            return response()->forbidden($exception->getMessage());
        }

        return response()->ok($products);
    }

    public function brands(){
        try {
            $products = Customer::where('deleted', '0')->get();
        }catch (\Exception $exception){
            return response()->forbidden($exception->getMessage());
        }

        return response()->ok($products);
    }

    public function customers(){
        try {
            $products = Brand::where('deleted', '0')->where('status', '1')->get();
        }catch (\Exception $exception){
            return response()->forbidden($exception->getMessage());
        }

        return response()->ok($products);
    }


    public function storeCartToOrder(Request $request){
        sendTelegram('group', json_encode($request->all())); //977350811
        app('App\Http\Controllers\OrderController')->store(json_decode(json_encode($request->all())));
    }
}
