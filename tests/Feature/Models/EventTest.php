<?php

namespace Tests\Feature\Models;

use App\Models\City;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_empty_response()
    {
        $response = $this->get('/api/v1/events/');

        $response->assertStatus(200);
        $response->assertExactJson([]);
        $this->assertDatabaseCount(Event::class, 0);
    }

    /**
     * @test
     */

    public function test_event_creation()
    {
        $eventDate = Carbon::now()->addDay()->toDateTimeString();
        $city = City::factory()->count(1)->create()->first();

        $this->assertDatabaseCount(Event::class, 0);
        $response = $this->postJson('/api/v1/events/', [
            'title' => 'Test Event',
            'date' => $eventDate,
            'city_id' => $city->id
        ]);

        $response->assertCreated();
        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->where('id', 1)
                ->where('title', 'Test Event')
                ->where('date', $eventDate)
                ->has('updated_at')
                ->has('created_at')
                ->has('city', fn(AssertableJson $json) => $json
                    ->has('id')
                    ->has('city')
                    ->has('zip_code')
                    ->has('updated_at')
                    ->has('created_at')
                )
        );

        $this->assertDatabaseCount(Event::class, 1);
        $this->assertDatabaseHas(Event::class, [
            'id' => 1,
            'title' => 'Test Event',
            'date' => $eventDate
        ]);
    }

    /**
     * @test
     */
    public function test_creation_with_wrong_body()
    {
        ;
        $this->assertDatabaseCount(Event::class, 0);
        $response = $this->postJson('/api/v1/events/', [
            'title' => 1,
            'date' => '2022-04-12 12:22'
        ]);

        $response->assertJsonValidationErrorFor('title');
        $response->assertJsonValidationErrorFor('date');;
        $this->assertDatabaseCount(Event::class, 0);
    }

    /**
     * @test
     */
    public function test_creation_with_empty_body()
    {
        $response = $this->postJson('/api/v1/events/');

        $response->assertJsonValidationErrorFor('title');
        $response->assertJsonValidationErrorFor('date');

        $response->assertUnprocessable();
        $this->assertDatabaseCount(Event::class, 0);
    }

    /**
     * @test
     */

    public function test_get_all_events()
    {

        Event::factory()
            ->count(50)
            ->create();

        $response = $this->getJson('/api/v1/events');
        $response->assertJsonCount(50);
    }

    /**
     * @test
     */

    public function test_single_event()
    {
        $event = Event::factory()
            ->count(1)
            ->create();

        $response = $this->getJson('/api/v1/events/' . $event->first()->id);
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'id',
            'title',
            'date',
            'updated_at',
            'created_at'
        ]);
    }

    /**
     * @test
     */

    public function test_single_not_found()
    {
        Event::factory()
            ->count(1)
            ->create();

        $response = $this->getJson('/api/v1/events/2');
        $response->assertNotFound();
    }

}
