<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Visitor;
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
            ->create()
            ->each(function (Ticket $ticket) use ($events, $visitors) {
                $ticket->visitor_id = $visitors->random(1)->first()->id;
                $ticket->event_id = $events->random(1)->first()->id;
            });

    }
}
