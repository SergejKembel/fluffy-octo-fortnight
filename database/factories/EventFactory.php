<?php

namespace Database\Factories;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'date' => Carbon::now()->addDays(7),
            'city_id' => City::factory()->count(1)->create()->first()->id
        ];
    }
}
