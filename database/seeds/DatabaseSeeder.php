<?php

use Seeds\Dictionaries as Dictionary;
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
        $this->call(Dictionary\SeedWorkshopTable::class);
    }
}
