<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::factory()
            ->count(50)
            ->create();

        $visitors = Visitor::factory()
            ->count(250)
            ->create();

        Ticket::factory()
            ->count(300)
            ->state(new Sequence(
                fn ($sequence) => [
                    'event_id' => $events->random()->id,
                    'visitor_id' => $visitors->random()->id
                ],
            ))
            ->create();

    }
}
