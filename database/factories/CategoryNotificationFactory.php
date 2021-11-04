<?php

namespace Database\Factories;

use App\Models\CategoryNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(4),
            'instance_id'=>rand(1,3)
        ];
    }
}
