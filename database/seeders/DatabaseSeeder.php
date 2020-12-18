<?php

namespace Database\Seeders;

use AdminUserSeeder;
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

        $this->call([
            AdminUserSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
