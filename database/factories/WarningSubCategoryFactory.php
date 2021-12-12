<?php

namespace Database\Factories;

use App\Models\WarningCategory;
use App\Models\WarningSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarningSubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WarningSubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $wc = WarningCategory::select(['id'])->get()->random();
        return [
            'name'=>$this->faker->word,
            'warning_category_id'=>$wc->id
        ];
    }
}
