<?php

namespace Database\Factories;

use App\Models\WarningCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarningCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WarningCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'name'=>$this->faker->word,
           'instance_id'=>rand(1,25)
        ];
    }
}
