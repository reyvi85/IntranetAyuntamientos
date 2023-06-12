<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Route::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(rand(3,6)),
            'description'=>$this->faker->realText(),
            'imagen'=>$this->faker->imageUrl(),
            'state'=>rand(0,1),
            'price'=>rand(5,25),
            'inicio_ruta_name'=>$this->faker->sentence(),
            'inicio_ruta_direccion'=>$this->faker->sentence(),
            'inicio_ruta_description'=>$this->faker->sentence(),
            'inicio_ruta_imagen'=>$this->faker->imageUrl(),
            'fin_ruta_name'=>$this->faker->sentence(),
            'fin_ruta_direccion'=>$this->faker->sentence(),
            'fin_ruta_description'=>$this->faker->sentence(),
            'fin_ruta_imagen'=>$this->faker->imageUrl(),
            'instance_id'=>rand(1,25),
            'route_category_id'=>rand(1,25),
            'hit'=>rand(1,1000)
        ];
    }
}
