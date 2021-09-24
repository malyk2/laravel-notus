<?php

namespace Tests\Http\Admin\Users;

use Tests\Http\TestCase;
use Mockery\MockInterface;
use Mockery;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    protected $method = 'DELETE';

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->uri = 'api/admin/users/' . $this->user->id;
    }

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
        $tu = User::factory()->create();
        $this->uri = 'api/admin/users/' . $tu->id;
        // $this->mock(UserService::class, fn (MockInterface $mock) =>
        // $mock->shouldReceive('delete')->with($this->user)->once()->andReturn(true));

        $service = $this->mock(UserService::class);
        $service->shouldReceive('delete')->with($tu)->once()->andReturn(true);
        $response = $this->admin()->send();

        $response->assertSuccessful();
        $response->dump();
    }

    // /**
    //  * @inheritdoc
    //  * */
    // public function tearDown(): void
    // {
    //     Mockery::close();
    //     parent::tearDown();
    // }
}
