<?php

namespace Database\Factories;

use App\Models\Warning;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warning::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'asunto'=>$this->faker->sentence,
           'description'=>$this->faker->text,
            'image'=>$this->faker->imageUrl,
            'lat'=>$this->faker->latitude,
            'lng'=>$this->faker->longitude,
            'instance_id'=>rand(1,25),
            'warning_state_id'=>rand(1,4),
            'warning_sub_category_id'=>rand(1,1800),
            'user_id'=>rand(1,100),
        ];
    }
}
