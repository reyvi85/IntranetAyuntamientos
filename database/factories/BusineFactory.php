<?php

namespace Database\Factories;

use App\Models\Busine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Busine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();
        return [
            'name'=> $name,
            'direccion'=>$this->faker->address(),
            'telefono'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->safeEmail(),
            'logo'=>$this->faker->imageUrl(),
            'description'=>$this->faker->paragraph(),
            'url_web'=>$this->faker->url(),
            'slug'=>Str::slug($name),
            'category_busine_id'=>rand(1,25),
            'instance_id'=>rand(1,25)
        ];
    }
}
