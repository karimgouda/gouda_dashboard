<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTests extends TestCase
{
    use RefreshDatabase , WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $superAdmin;
    protected function setUp(): void
    {
        parent::setUp();
        $this->superAdmin = User::factory()->create();
    }

    public function test_login_index()
    {
        $response = $this->actingAs($this->superAdmin)->get('admin/blogs');
        $this->assertAuthenticated();
        $response->assertStatus(302);
    }

}
