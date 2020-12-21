<?php

namespace Nrz\User\Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nrz\User\Model\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function CreateUser()
    {
        return $this->post(route('register'), [
            'name' => 'testUser',
            'email' => 'testuser@gmail.com',
            'phone' => '9011216133',
            'password' => '@b01faZ1',
            'password_confirmation' => '@b01faZ1'
        ]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeeRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testUserCanRegister()
    {
        $response = $this->CreateUser();

        $response->assertRedirect(route('home'));

        $this->assertCount(1, User::all());

    }

    public function testUserHaveVerifyAccount()
    {
        $this->CreateUser();
        $response = $this->get(route('home'));

        $response->assertRedirect(route('verification.notice'));
    }

    public function testUserSeeHomePageAfterVerifyAccount()
    {
        $this->CreateUser();
        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('home'));
        $response->assertOk();
    }
}
