<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{

    /**
     * Failed Login Testing
     *
     */
    public function testFailedLogin()
    {
        $loginData = [
            "email" => "monsarvasmo@gmail.com",
            "password" => "thisiswrong"
        ];

        $this->json('POST', 'api/v1/user/signin', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                "success" => false,
                "message" => "Unauthorized",
                "data" => []
            ]);
    }

    /**
     * Successful Login Testing
     *
     */
    public function testSuccessfulLogin()
    {
    
        $user = User::factory()->create([
            'password' => \Hash::make('testpassword'),
         ]);

        $loginData = [
            "email" => $user->email,
            "password" => "testpassword"
        ];

        $this->json('POST', 'api/v1/user/signin', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(202)
            ->assertJsonStructure([
                "data" => [
                    "headers",
                    "original" => [
                        'access_token',
                        'token_type',
                        'expires_in',
                        "user" => [
                            'user_id',
                            'username',
                            'firstname',
                            'middlename',
                            'lastname',
                            'mobile_number',
                            'gender',
                            'email',
                            'email_verified_at',
                            'created_at',
                            'updated_at'
                        ],
                        'usertype',
                        'addresses'
                    ],
                    "exception"
                ]
            ]);

        $this->assertAuthenticated();

        User::find($user->user_id)->delete();
    }
}
