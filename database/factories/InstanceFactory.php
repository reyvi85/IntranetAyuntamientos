<?php

namespace Database\Factories;

use App\Models\Instance;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(),
            'province_id'=>rand(1,50),
            'municipio'=>$this->faker->word(),
            'barrio'=>$this->faker->word(),
            'postal_code'=>$this->faker->randomNumber(5),
            'key'=>Str::random(64)
        ];
    }
}
