<?php

namespace Database\Seeders;


use App\Models\Community;
use App\Models\Province;
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
        // \App\Models\User::factory(10)->create();
        Community::factory(25)->create();
        Province::factory(50)->create();
    }
}
