<?php

namespace Tests\Feature\Models;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_get_no_tickets()
    {
        $this->assertDatabaseCount(Ticket::class, 0);
        $response = $this->getJson('/api/v1/tickets/');
        $response->assertSuccessful();
        $response->assertExactJson([]);
    }

    /**
     * @test
     */

    public function test_ticket_creation()
    {
        $event = Event::factory()->count(1)->create()->first();
        $visitor = Visitor::factory()->count(1)->create()->first();

        $this->assertDatabaseCount(Ticket::class, 0);

        $response = $this->postJson('/api/v1/tickets/', [
            'barcode' => '1a2b3c4d',
            'event_id' => $event->id,
            'visitor_id' => $visitor->id
        ]);

        $response->assertCreated();
        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->has('id')
                ->where('barcode', '1a2b3c4d')
                ->where('barcode_link', 'https://barcode.tec-it.com/barcode.ashx?data=1a2b3c4d&code=&translate-esc=true')
                ->has('event', fn(AssertableJson $json) => $json
                    ->where('id', $event->id)
                    ->where('title', $event->title)
                    ->has('date')
                    ->has('city', fn(AssertableJson $json) => $json
                        ->where('id', $event->city->id)
                        ->where('zip_code', $event->city->zip_code)
                        ->where('city', $event->city->city)
                        ->has('created_at')
                        ->has('updated_at')
                    )
                    ->has('created_at')
                    ->has('updated_at')
                )
                ->has('visitor', fn(AssertableJson $json) => $json
                    ->where('id', $visitor->id)
                    ->where('firstname', $visitor->firstname)
                    ->where('lastname', $visitor->lastname)
                    ->has('created_at')
                    ->has('updated_at')
                )
                ->has('created_at')
                ->has('updated_at')
        );

        $this->assertDatabaseCount(Ticket::class, 1);
    }


    /**
     * @test
     */

    public function test_creation_with_wrong_body()
    {
        $this->assertDatabaseCount(Ticket::class, 0);
        $response = $this->postJson('/api/v1/tickets/', [
            'barcode' => '11111111111111111111',
            'event_id' => 1337,
            'visitor_id' => 'blablabla'
        ]);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrorFor('barcode');
        $response->assertJsonValidationErrorFor('event_id');
        $response->assertJsonValidationErrorFor('visitor_id');
        $this->assertDatabaseCount(Ticket::class, 0);
    }

    /**
     * @test
     */

    public function test_creation_with_empty_body()
    {
        $this->assertDatabaseCount(Ticket::class, 0);
        $response = $this->postJson('/api/v1/tickets/');

        $response->assertJsonValidationErrorFor('barcode');
        $response->assertJsonValidationErrorFor('event_id');
        $response->assertJsonValidationErrorFor('visitor_id');
        $this->assertDatabaseCount(Ticket::class, 0);
    }

    /**
     * @test
     */
    public function get_all_tickets()
    {
        Ticket::factory()
            ->count(50)
            ->create();

        $response = $this->getJson('/api/v1/tickets');
        $response->assertSuccessful();
        $response->assertJsonCount(50);
    }

    /**
     * @test
     */
    public function test_single_ticket()
    {
        $ticket = Ticket::factory()
            ->count(1)
            ->create()->first();

        $response = $this->getJson('/api/v1/tickets/' . $ticket->id);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'id',
            'barcode',
            'barcode_link',
            'visitor' => [
                'id',
                'firstname',
                'lastname',
                'created_at',
                'updated_at'
            ],
            'event' => [
                'id',
                'city' => [
                    'id',
                    'zip_code',
                    'city',
                    'created_at',
                    'updated_at',
                ],
                'title',
                'date',
                'created_at',
                'updated_at'
            ],
            'created_at',
            'updated_at'
        ]);


    }

    /**
     * @test
     */
    public function test_single_ticket_not_found()
    {
        Ticket::factory()->count(1)->create();

        $response = $this->getJson('/api/v1/tickets/1337');
        $response->assertNotFound();
    }
}
