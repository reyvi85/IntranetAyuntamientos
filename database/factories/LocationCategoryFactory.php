<?php

namespace Database\Factories;

use App\Models\LocationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LocationCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(4),
            'image'=>$this->faker->imageUrl(),
        ];
    }
}
