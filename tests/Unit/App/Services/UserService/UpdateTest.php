<?php

namespace Tests\Unit\App\Services\UserService;

use Tests\Unit\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function success_with_password()
    {
        /** @var UserService */
        $service = $this->partialMock(UserService::class);

        $user = User::factory()->create();
        $result = $service->update($user, [
            'name' => 'some name',
            'email' => 'some email',
            'password' => 'secret',
        ]);

        $this->assertInstanceOf(User::class, $result);
        $this->assertTrue(Hash::check('secret', $result->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'some name',
            'email' => 'some email',
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function success_withot_password()
    {
        /** @var UserService */
        $service = $this->partialMock(UserService::class);

        $user = User::factory(['password' => bcrypt('not-secret')])->create();
        $result = $service->update($user, [
            'name' => 'some name',
            'email' => 'some email',
        ]);

        $this->assertInstanceOf(User::class, $result);
        $this->assertTrue(Hash::check('not-secret', $result->password));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'some name',
            'email' => 'some email',
        ]);
    }
}
