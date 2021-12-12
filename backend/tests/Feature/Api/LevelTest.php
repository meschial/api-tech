<?php

namespace Tests\Feature\Api;

use App\Models\Level;
use Tests\TestCase;

class LevelTest extends TestCase
{
    public function test_get_all_levels()
    {
        $response = $this->getJson('api/levels');

        $response->assertStatus(200);
    }

    public function test_get_count_levels()
    {
        Level::factory()->count(5)->create();

        $response = $this->getJson('api/levels');

        $response->assertJsonCount(5, 'data');

        $response->assertStatus(200);
    }

    public function test_notfound_levels()
    {
        $response = $this->getJson('api/levels/800');

        $response->assertStatus(404);
    }

    public function test_get_level()
    {
        $level = Level::factory()->create();

        $response = $this->getJson("api/levels/{$level->id}");

        $response->assertStatus(200);
    }

    public function test_get_valitade_create_level()
    {
        $response = $this->postJson('api/levels', []);

        $response->assertStatus(422);
    }

    public function test_create_level()
    {
        $response = $this->postJson('api/levels', [
            'level' => 'Pleno'
        ]);

        $response->assertStatus(201);
    }

    public function test_update_level()
    {
        $level = Level::factory()->create();

        $response = $this->putJson("api/levels/{$level->id}", [
            'level' => 'Pleno Update'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_level()
    {
        $level = Level::factory()->create();

        $response = $this->deleteJson("api/levels/{$level->id}");

        $response->assertStatus(204);
    }
}
