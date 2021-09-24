<?php

namespace Tests\Unit\App\Services\UserService;

use Tests\Unit\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        /** @var UserService */
        $service = $this->partialMock(UserService::class);

        $user = User::factory()->create();
        $result = $service->delete($user);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
