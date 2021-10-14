<?php

namespace Database\Factories;

use App\Models\CategoryBusine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryBusineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryBusine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(4);
        return [
            'name'=>$name,
            'slug'=>Str::slug($name)
        ];
    }
}
