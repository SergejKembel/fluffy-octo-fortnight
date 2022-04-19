<?php

namespace Tests\Feature\Models;

use App\Models\City;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CityTest extends TestCase
{
    /**
     * @test
     */
    public function test_get_no_cities()
    {
        $response = $this->getJson('/api/v1/cities');

        $response->assertStatus(200);
        $response->assertExactJson([]);
        $this->assertDatabaseCount(City::class, 0);
    }

    /**
     * @test
     */

    public function test_city_creation()
    {
        $response = $this->postJson('/api/v1/cities', [
            'zip_code' => 52477,
            'city' => 'Alsdorf'
        ]);

        $response->assertCreated();
        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->where('id', 1)
                ->where('zip_code', 52477)
                ->where('city', 'Alsdorf')
                ->has('updated_at')
                ->has('created_at')
        );

        $this->assertDatabaseCount(City::class, 1);
        $this->assertDatabaseHas(City::class, [
            'id' => 1,
            'city' => 'Alsdorf',
            'zip_code' => 52477
        ]);
    }

    /**
     * @test
     */

    public function test_wrong_city_creation()
    {
        $this->assertDatabaseCount(City::class, 0);
        $response = $this->postJson('/api/v1/cities/', [
            'zip_code' => "random zipcode",
            'city' => 1337
        ]);

        $response->assertJsonValidationErrorFor('zip_code');
        $response->assertJsonValidationErrorFor('city');
        $this->assertDatabaseCount(City::class, 0);
    }

    /**
     * @test
     */
    public function test_creation_with_empty_body()
    {
        $this->assertDatabaseCount(City::class, 0);
        $response = $this->postJson('/api/v1/cities/');

        $response->assertJsonValidationErrorFor('zip_code');
        $response->assertJsonValidationErrorFor('city');

        $response->assertUnprocessable();
        $this->assertDatabaseCount(City::class, 0);
    }

    /**
     * @test
     */

    public function test_get_all_cities()
    {
        City::factory()
            ->count(50)
            ->create();

        $response = $this->getJson('/api/v1/cities');
        $response->assertJsonCount(50);

    }

    /**
     * @test
     */
    public function test_single_city()
    {
        $this->assertDatabaseCount(City::class, 0);
        $city = City::factory()
            ->count(1)
            ->create()
            ->first();
        $this->assertDatabaseCount(City::class, 1);

        $response = $this->getJson('/api/v1/cities/' . $city->id);
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'id',
            'zip_code',
            'city',
            'updated_at',
            'created_at'
        ]);
    }

    /**
     * @test
     */

    public function test_single_not_found()
    {
        City::factory()
            ->count(1)
            ->create();

        $response = $this->getJson('/api/v1/cities/2');
        $response->assertNotFound();
    }


}
