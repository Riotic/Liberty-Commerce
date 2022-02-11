<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> User::all()->random()->id,
            'title'=>$this->faker->title(),
            'product_description'=>$this->faker->paragraph(),
            'product_price'=>random_int(10,100),
            'product_type'=>"Manga",
            'created_at'=>$this->faker->dateTimeThisMonth(),
            'updated_at'=>$this->faker->dateTimeThisMonth(),
        ];
    }
}
