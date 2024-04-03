<?php

namespace Tests\Feature;

use App\Enums\RaceDistanceEnum;
use App\Enums\UserRoleEnum;
use App\Models\Race;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RaceApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_race()
    {
        $this->actingAsAdmin();

        $response = $this->postJson('/api/v1/race', [
            'name' => 'Example Race',
            'distance' => RaceDistanceEnum::MARATHON,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('races', [
            'name' => 'Example Race',
            'distance' => RaceDistanceEnum::MARATHON,
        ]);
    }

    /** @test */
    public function can_list_races()
    {
        $this->actingAsAdmin();

        $race = Race::factory()->create();

        $response = $this->getJson('/api/v1/race');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $race->name,
                'distance' => $race->distance,
            ]);
    }

    /** @test */
    public function can_update_race()
    {
        $this->actingAsAdmin();
        $race = Race::factory()->create();

        $response = $this->putJson("/api/v1/race/{$race->id}", [
            'name' => 'Updated Race Name',
            'distance' => RaceDistanceEnum::HALF_MARATHON,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('races', [
            'id' => $race->id,
            'name' => 'Updated Race Name',
            'distance' => RaceDistanceEnum::HALF_MARATHON,
        ]);
    }

    /** @test */
    public function can_delete_race()
    {
        $this->actingAsAdmin();

        $race = Race::factory()->create();

        $response = $this->deleteJson("/api/v1/race/{$race->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('races', ['id' => $race->id]);
    }

    protected function actingAsAdmin()
    {
        $admin =  User::factory()->create(['role' => UserRoleEnum::ADMIN]);

        $this->actingAs($admin, 'api');
    }
}
