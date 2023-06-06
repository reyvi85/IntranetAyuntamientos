<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\LocationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(),
            'description'=>$this->faker->text(),
            'ubicacion'=>$this->faker->address(),
            'telefono'=>$this->faker->phoneNumber(),
            'web'=>$this->faker->url(),
            'image'=>$this->faker->imageUrl(),
            'visitantes'=>$this->faker->boolean(),
            'residentes'=>$this->faker->boolean(),
            'inicio'=>$this->faker->boolean(),
            'instance_id'=>rand(1,25),
            'location_category_id'=>rand(1,150),
            'lat'=>$this->faker->latitude,
            'lng'=>$this->faker->longitude,
            'hit'=>rand(1,1000),
        ];
    }
}
