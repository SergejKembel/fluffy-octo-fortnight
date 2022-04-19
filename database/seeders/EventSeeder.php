<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = City::factory()->create();

        Event::factory()
            ->count(50)
            ->create([
                'city' => $city
            ]);
    }
}
