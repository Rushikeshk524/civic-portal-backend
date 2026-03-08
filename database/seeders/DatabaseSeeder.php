<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
            ComplaintSeeder::class,
        ]);
    }
}
