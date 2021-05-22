<?php

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
            // TietHocSeeder::class,
            // AccountSeeder::class
            // WeekdaySeeder::class
            // SubjectSeeder::class
        ]);
    }
}
