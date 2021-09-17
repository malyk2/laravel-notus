<?php

namespace Tests\Http\Admin\Users;

use Tests\Http\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/admin/users';

    protected $method = 'GET';

    /**
     * @test
     *
     * @return void
     */
    public function authentication()
    {
        $response = $this->send();
        $response->assertStatus(401);
    }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        User::factory()->count(2)->create();

        $response = $this->admin()->send();

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
}
