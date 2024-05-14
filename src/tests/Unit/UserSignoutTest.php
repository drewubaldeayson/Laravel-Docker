<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserSignoutTest extends TestCase
{

    public function testFailedSignout()
    {
        $dummyToken = 'thisiswrongtoken';

        $response2 = $this->withHeaders(['Authorization' => 'Bearer '.$dummyToken])->json('POST', 'api/v1/user/signout', ['Accept' => 'application/json'])
        ->assertStatus(403)
        ->assertJson([
                "success" => false,
                "message" => "Token is invalid.",
                "data" => []
            ]);;
    }

    public function testSuccessfulSignout()
    {

        $user = User::factory()->create([
            'password' => \Hash::make('testpassword'),
         ]);

        $loginData = [
            "email" => $user->email,
            "password" => "testpassword"
        ];

        $response = $this->json('POST', 'api/v1/user/signin', $loginData, ['Accept' => 'application/json'])->assertStatus(202);

        $response2 = $this->withHeaders(['Authorization' => 'Bearer '.$response['data']['original']['access_token']])->json('POST', 'api/v1/user/signout', ['Accept' => 'application/json'])->assertStatus(200);

        User::find($user->user_id)->delete();
    }
}
