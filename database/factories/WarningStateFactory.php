<?php

namespace Database\Factories;

use App\Models\WarningState;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarningStateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WarningState::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word()
        ];
    }
}
