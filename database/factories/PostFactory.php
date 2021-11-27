<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'titulo'=>$title,
            'subtitulo'=>$this->faker->sentence,
            'contenido'=>$this->faker->paragraph(5),
            'image'=>$this->faker->imageUrl,
            'fecha_inicio'=>$this->faker->date,
            'fecha_fin'=>$this->faker->date,
            'visitantes'=>rand(0,1),
            'residentes'=>rand(0,1),
            'inicio'=>rand(0,1),
            'slug'=>Str::slug($title),
            'active'=>rand(0,1),
            'instance_id'=>rand(1,25)
        ];
    }
}
