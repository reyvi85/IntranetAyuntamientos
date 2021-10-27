<?php

namespace Database\Factories;

use App\Models\InterestPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterestPhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterestPhone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(4),
            'description'=>$this->faker->sentence(),
            'phone'=>$this->faker->phoneNumber(),
            'instance_id'=>rand(1,25)
        ];
    }
}
