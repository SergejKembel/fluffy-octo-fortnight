<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $visitor = Visitor::factory()->count(1)->create()->first()->id;
        $event = Event::factory()->count(1)->create()->first();

        return [
            'barcode' => $this->faker->bothify('?###??##'),
            'visitor_id' => $visitor,
            'event_id' => $event->id
        ];
    }
}
