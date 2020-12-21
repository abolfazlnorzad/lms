<?php

namespace Nrz\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nrz\User\Model\User;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserSeeLoginForm()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function testUserLoginByEmail()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone'=>'9011216133',
            'password' => bcrypt('@b01faZ1')
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '@b01faZ1'
        ]);

        $this->assertAuthenticated();

    }
    public function testUserLoginByPhone()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone'=>'9011216133',
            'password' => bcrypt('@b01faZ1')
        ]);

        $this->post(route('login'), [
            'email' => $user->phone,
            'password' => '@b01faZ1'
        ]);

        $this->assertAuthenticated();

    }


}
