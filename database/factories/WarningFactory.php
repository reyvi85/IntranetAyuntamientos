<?php

namespace Database\Factories;

use App\Models\Warning;
use App\Models\WarningCategory;
use App\Models\WarningSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warning::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $inst = WarningCategory::select('id','instance_id')->get()->random();
        return [
           'asunto'=>$this->faker->sentence,
           'description'=>$this->faker->text,
            'ubicacion'=>$this->faker->address,
            'image'=>$this->faker->imageUrl,
            'lat'=>$this->faker->latitude,
            'lng'=>$this->faker->longitude,
            'instance_id'=>$inst->instance_id,
            'warning_state_id'=>rand(1,4),
            'warning_sub_category_id'=>$inst->sub_categories->random()->id,
            'user_id'=>rand(1,100),
            'created_at'=>$this->faker->dateTimeBetween('2020/01/01', '2023/12/31')
        ];
    }
}
