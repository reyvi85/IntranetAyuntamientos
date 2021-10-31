<?php

namespace Database\Seeders;


use App\Models\Busine;
use App\Models\CategoryBusine;
use App\Models\CategoryNotification;
use App\Models\Community;
use App\Models\Instance;
use App\Models\InterestPhone;
use App\Models\Notification;
use App\Models\Province;
use App\Models\User;
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

      /*  Community::factory(25)->create();
        Province::factory(50)->create();
        Instance::factory(25)->create();
        User::factory(100)->create();
        CategoryBusine::factory(25)->create();
        Busine::factory(150)->create();
        InterestPhone::factory(500)->create();*/
        CategoryNotification::factory(150)->create();
        Notification::factory(1500)->create();
    }
}
