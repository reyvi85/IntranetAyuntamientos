<?php

namespace Database\Seeders;


use App\Models\Community;
use App\Models\Instance;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Community::factory(25)->create();
        Province::factory(50)->create();
        Instance::factory(25)->create();
        User::factory(100)->create();
    }
}
