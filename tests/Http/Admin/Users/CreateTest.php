<?php

namespace Tests\Http\Admin\Users;

use Tests\Http\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/admin/users';

    protected $method = 'POST';

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
     * @dataProvider getNotValidData
     *
     * @return void
     */
    public function validate($data)
    {
        $response = $this->admin()->send($data);
        $response->assertStatus(422);
    }

    public function getNotValidData()
    {
        return [
            ['name required' => ['name' => '', 'email' => 'some@email.com', 'password' => 'some password']],
            ['name max' => ['name' => Str::random(256), 'email' => 'some@email.com', 'password' => 'some password']],
            ['email required' => ['name' => 'name', 'email' => '', 'password' => 'some password']],
            ['email email' => ['name' => 'name', 'email' => 'not email', 'password' => 'some password']],
            ['password required' => ['name' => 'name', 'email' => 'some@email.com', 'password' => '']],
        ];
    }

    /**
     * @test
     *
        * @return void
        */
        public function validateUniqueEmail()
        {
            $exists = User::factory()->create();
            $response = $this->admin()->send(['name' => 'some name', 'email' => $exists->email, 'password' => 'secret']);

            $response->assertStatus(422);
        }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        $data = [
            'name' => 'name',
            'email' => 'some@email.com',
            'password' => 'secret',
        ];

        $response = $this->admin()->send($data);

        $response->assertSuccessful();
        $this->assertDatabaseHas('users', Arr::only($data, ['name', 'email']));
    }
}
