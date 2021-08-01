<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> 'Product Number - ' . rand(1,100000),
            'category_id'=>\App\Models\Category::all()->random(1)->first()->id,
            'image'=>rand(1,20).'.jpg',
            'price'=>rand(100,250),
            'qty'=>rand(100,1000),
        ];
    }
}
