<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Instance;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       // $ins = Instance::select(['id'])->get()->random();
        return [
            'titulo'=>$this->faker->sentence(),
            'imagen'=>$this->faker->image(),
            'description'=>$this->faker->paragraph(),
            'lat'=>$this->faker->latitude(),
            'lng'=>$this->faker->longitude(),
            'link'=>$this->faker->url(),
            'f_inicio'=>$this->faker->date(),
            'f_fin'=>$this->faker->date(),
            'instance_id'=>rand(1,25),
            'event_category_id'=>rand(1,25)
        ];
    }
}
