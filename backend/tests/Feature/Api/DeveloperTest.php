<?php

namespace Tests\Feature\Api;

use App\Models\Developer;
use App\Models\Level;
use Tests\TestCase;

class DeveloperTest extends TestCase
{
    public function test_get_all_developers()
    {
        $response = $this->getJson('api/developers');

        $response->assertStatus(200);
    }

    public function test_get_count_developers()
    {
        Developer::factory()->count(5)->create();

        $response = $this->getJson('api/developers');

        $response->assertJsonCount(5, 'data');

        $response->assertStatus(200);
    }

    public function test_notfound_developers()
    {
        $response = $this->getJson('api/developers/800');

        $response->assertStatus(404);
    }

    public function test_get_developer()
    {
        $developer = Developer::factory()->create();

        $response = $this->getJson("api/developers/{$developer->id}");

        $response->assertStatus(200);
    }

    public function test_get_valitade_create_developer()
    {
        $response = $this->postJson('api/developers', []);

        $response->assertStatus(422);
    }

    public function test_create_developer()
    {
        $level = Level::factory()->create();

        $response = $this->postJson('api/developers', [
            'name' => 'Marcos Murilo',
            'gender' => 'M',
            'birth' => '1997-04-18',
            'age' => 24,
            'hobby' => 'Codar',
            'level_id' => $level->id
        ]);

        $response->assertStatus(201);
    }

    public function test_update_developer()
    {
        $developer = Developer::factory()->create();
        $level = Level::factory()->create();

        $response = $this->putJson("api/developers/{$developer->id}", [
            'name' => 'Marcos Murilo',
            'gender' => 'M',
            'birth' => '1997-04-18',
            'age' => 24,
            'hobby' => 'Codar',
            'level_id' => $level->id
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_developer()
    {
        $developer = Developer::factory()->create();

        $response = $this->deleteJson("api/developers/{$developer->id}");

        $response->assertStatus(204);
    }
}
