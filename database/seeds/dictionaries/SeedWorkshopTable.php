<?php

namespace Seeds\Dictionaries;

use App\Models\Workshop;
use Illuminate\Database\Seeder;

class SeedWorkshopTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(config('dictionaries.workshop'))->each(function ($data) {
            Workshop::firstOrCreate($data);
        });

    }
}
