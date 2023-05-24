<?php

namespace Database\Factories;

use App\Enums\ActionMethodEnum;
use App\Enums\ActionTypeEnum;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*$action_type = ActionTypeEnum::cases();
        $action_method = $this->faker->randomKey([ActionMethodEnum::create, ActionMethodEnum::edit, ActionMethodEnum::delete, ActionMethodEnum::show, ActionMethodEnum::duplicate]);
        $action_id = 1;

        switch ($action_type){
            case ActionTypeEnum::account:   $action_method = $this->faker->randomElement([ActionMethodEnum::login, ActionMethodEnum::logout]); break;
            case ActionTypeEnum::brand:     $action_id = Brand::all()->random()->id; break;
            case ActionTypeEnum::product:   $action_id = Product::all()->random()->id; break;
            case ActionTypeEnum::order:     $action_id = Order::all()->random()->id; break;
            case ActionTypeEnum::supplier:  $action_id = Supplier::all()->random()->id; break;
        }*/
        return [
            'user_id' => User::all()->random()->id,
            //'user_ip' => $this->faker->ipv4(),
            //'action_type' => $action_type,
            //'action_method' => $action_method,
            //'action_id' => $action_id
        ];
    }
}
