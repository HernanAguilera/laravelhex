<?php

namespace Tests\Feature\Auth;

use H34\Auth\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListPermissionsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $url = '/api/auth/permissions';

    public function test_with_list_empty()
    {
        $number_of_element = 0;
        $response = $this->get($this->url);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $content);
        $this->assertEquals(count($content['items']), $number_of_element);
        $response->assertStatus(200);
    }

    public function test_with_items_saved()
    {
        $number_of_element = rand(0, 100);
        Permission::factory()->count($number_of_element)->create();

        $response = $this->get($this->url);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('items', $content);
        $this->assertEquals(count($content['items']), $number_of_element);
        $response->assertStatus(200);
    }
}
