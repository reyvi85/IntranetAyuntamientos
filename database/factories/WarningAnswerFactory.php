<?php

namespace Database\Factories;

use App\Models\Warning;
use App\Models\WarningAnswer;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarningAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WarningAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $w = Warning::select(['id'])->get()->random();
        return [
            'answer'=>$this->faker->paragraph,
            'warning_id'=>$w->id
        ];
    }
}
