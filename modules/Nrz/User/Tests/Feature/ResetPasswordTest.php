<?php

namespace Nrz\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nrz\User\Model\User;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUserCanSeeResetPasswordRequestForm()
    {
        $response = $this->get(route('password.request'));
        $response->assertOk();
    }




    public function testUserCanTryLess6()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'abol@gmail.com'])->assertStatus(302);
        }
        $this->post(route('password.checkVerifyCode'), ['verify_code', 'email' => 'abol@gmail.com'])->assertStatus(429);
    }

}
