<?php

namespace Database\Factories;

use App\Models\Widget;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WidgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Widget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $titulo = $this->faker->sentence;
        return [
            'titulo'=>$titulo,
            'subtitulo'=>$this->faker->sentence,
            'image'=>$this->faker->imageUrl,
            'type'=>rand(0,1),
            'enlace'=>$this->faker->url,
            'active'=>rand(0,1),
            'slug'=>Str::slug($titulo),
            'instance_id'=>rand(1,25)
        ];
    }
}
