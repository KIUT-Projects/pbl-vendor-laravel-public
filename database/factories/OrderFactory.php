<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Customer;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //$limit = $faker->optional()->passthrough(mt_rand(1, 5));
        //$products = Product::limit($limit)->get();
        //$total_price = 

        //foreach($products as $product){

        //}

        $price = mt_rand(150000, 5000000);
        
        return [
            'user_id' => User::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'price' => $price,
            'total_price' => $price,
        ];
    }
}
