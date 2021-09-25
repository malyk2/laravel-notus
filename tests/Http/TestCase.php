<?php

namespace Tests\Http;

use Tests\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    protected $method = 'GET';

    protected $uri = 'api';

    /**
     * Send request
     *
     * @param array $data
     * @return \Illuminate\Testing\TestResponse
     */
    protected function send(array $data = [])
    {
        return $this->json($this->method, $this->uri, $data);
    }

    /**
     * Acting admin
     *
     * @param User $user
     * @return self
     */
    protected function admin(User $user = null)
    {
        /** @var User */
        $user = $user ?? User::factory()->create();
        $this->actingAs($user, 'sanctum');
        // Sanctum::actingAs($user);
        return $this;
    }
}
