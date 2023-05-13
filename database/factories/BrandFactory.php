<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = "Brand ".$this->faker->sentence(3);
        $folder = storage_path('app' . DIRECTORY_SEPARATOR . 'public/images/brand');
        return [
            'user_id' => User::all()->random()->id,
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'image' => $this->faker->imageUrl(500, 500, null, true, 'Brand', false, 'jpg'),
        ];
    }
}
