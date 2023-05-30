<?php

namespace Database\Seeders;


use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\CategoryNotification;
use App\Models\Community;
use App\Models\Event;
use App\Models\Instance;
use App\Models\InterestPhone;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Province;
use App\Models\User;
use App\Models\Warning;
use App\Models\WarningAnswer;
use App\Models\WarningCategory;
use App\Models\WarningState;
use App\Models\WarningSubCategory;
use App\Models\Widget;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //  Storage::deleteDirectory('business');
       // Storage::makeDirectory('business');

        Community::factory(25)->create();
        Province::factory(50)->create();
        Instance::factory(25)->create();
        User::factory(650)->create();
        CategoryBusine::factory(25)->create();
        Busine::factory(150)->create();
        InterestPhone::factory(500)->create();
        CategoryNotification::factory(150)->create();
        Notification::factory(1500)->create();
        LocationCategory::factory(150)->create();
        Location::factory(1500)->create();

        WarningCategory::factory(250)->create();
        WarningSubCategory::factory(1800)->create();
        WarningState::factory(4)->create();
        Warning::factory(500)->create();
        WarningAnswer::factory(1500)->create();
        Post::factory(1500)->create();
        Widget::factory(1500)->create();

        Event::factory(2000)->create();
    }
}
