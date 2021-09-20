<?php

namespace Tests\Unit\App\Services\UserService;

use Tests\Unit\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;

class CreateTest extends TestCase
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

        $result = $service->create([
            'name' => 'some name',
            'email' => 'some email',
            'password' => 'secret',
        ]);

        $this->assertInstanceOf(User::class, $result);
        $this->assertTrue(Hash::check('secret', $result->password));
    }
}
