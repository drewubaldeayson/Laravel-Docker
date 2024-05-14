<?php

namespace Tests\Unit;

use Tests\TestCase;
use JWTAuth;

class SigninTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: Signin.
     *
     * @return void
     */

    public function testFailedSignin()
    {
        $loginData = [
            "email"    => 'random@test.com',
            "password" => 'wrongpass'
        ];

        $this->json('POST', 'api/v1/providers/account/signin', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "success" => false,
                "message" => "Unauthorized",
                "data" => []
            ]);
    }
    
    public function testSuccessSignin()
    {
        $loginData = [
            "email"    => $this->clinic_user->email,
            "password" => $this->auth_password
        ];

        $this->json('POST', 'api/v1/providers/account/signin', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(202);
    }

}
