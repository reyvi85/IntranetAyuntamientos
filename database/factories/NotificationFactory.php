<?php

namespace Database\Factories;

use App\Models\CategoryNotification;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $c = CategoryNotification::select('id','instance_id')->get()->random();
        return [
            'fecha_publicacion'=>$this->faker->dateTime(),
            'titulo'=>$this->faker->sentence(),
            'description'=>$this->faker->text(),
            'category_notification_id'=>$c->id,
            'instance_id'=>$c->instance_id
        ];
    }
}
