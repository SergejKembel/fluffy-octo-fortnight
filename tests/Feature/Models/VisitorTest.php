<?php

namespace Tests\Feature\Models;

use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class VisitorTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_empty_response()
    {
        $response = $this->get('/api/v1/visitors/');

        $response->assertStatus(200);
        $response->assertExactJson([]);
        $this->assertDatabaseCount(Visitor::class, 0);
    }

    /**
     * @test
     */

    public function test_visitor_creation()
    {
        $this->assertDatabaseCount(Visitor::class, 0);
        $response = $this->postJson('/api/v1/visitors/', [
            'firstname' => 'Vorname',
            'lastname' => 'Nachname'
        ]);

        $response->assertCreated();
        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->has('id')
                ->where('firstname', 'Vorname')
                ->where('lastname', 'Nachname')
                ->has('updated_at')
                ->has('created_at')
        );

        $this->assertDatabaseCount(Visitor::class, 1);
        $this->assertDatabaseHas(Visitor::class, [
            'firstname' => 'Vorname',
            'lastname' => 'Nachname',
        ]);
    }

    /**
     * @test
     */
    public function test_creation_with_wrong_body()
    {
        $this->assertDatabaseCount(Visitor::class, 0);
        $response = $this->postJson('/api/v1/visitors/', [
            'firstname' => 1,
            'lastname' => $this->faker->realTextBetween(256, 300)
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrorFor('firstname');
        $response->assertJsonValidationErrorFor('lastname');;
        $this->assertDatabaseCount(Visitor::class, 0);
    }

    /**
     * @test
     */
    public function test_creation_with_empty_body()
    {
        $response = $this->postJson('/api/v1/visitors/');

        $response->assertJsonValidationErrorFor('firstname');
        $response->assertJsonValidationErrorFor('lastname');;

        $response->assertUnprocessable();
        $this->assertDatabaseCount(Visitor::class, 0);
    }

    /**
     * @test
     */

    public function test_get_all_visitors()
    {

        Visitor::factory()
            ->count(50)
            ->create();

        $response = $this->getJson('/api/v1/visitors/');
        $response->assertJsonCount(50);
    }

    /**
     * @test
     */

    public function test_single_visitor()
    {
        $Visitor = Visitor::factory()
            ->count(1)
            ->create();

        $response = $this->getJson('/api/v1/visitors/' . $Visitor->first()->id);
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'id',
            'firstname',
            'lastname',
            'updated_at',
            'created_at'
        ]);
    }

    /**
     * @test
     */

    public function test_single_not_found()
    {
        Visitor::factory()
            ->count(1)
            ->create();

        $response = $this->getJson('/api/v1/visitors/2');
        $response->assertNotFound();
    }

}
