<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserUpdateProfileTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailedUpdateProfile()
    {
    	$user = User::factory()->create([
            'password' => \Hash::make('testpassword'),
         ]);

        $loginData = [
            "email" => $user->email,
            "password" => "testpassword"
        ];

        $response = $this->json('POST', 'api/v1/user/signin', $loginData, ['Accept' => 'application/json'])->assertStatus(202);

        $prepData = [
        	'firstname' => "",
        	'middlename' => "",
        	'lastname' => "",
        	'default_address_id' => ""
        ];

        $response2 = $this->withHeaders(['Authorization' => 'Bearer '.$response['data']['original']['access_token']])->json('patch', 'api/v1/user/profile', $prepData , ['Accept' => 'application/json'])
        ->assertStatus(400)
        ->assertJson([
        	"success" => false,
		    "message" => "Form Validation Error",
		    "data" => [
		        "firstname" => [
		            "The firstname field is required."
		        ],
		        "lastname" => [
		            "The lastname field is required."
		        ],
		        "middlename" => [
		            "The middlename field is required."
		        ],
		        "default_address_id" => [
		            "The default address id field is required."
		        ]
		    ]
        ]);



        User::find($user->user_id)->delete();
    }

    public function testSuccessfulUpdateProfile()
    {
        $user = User::factory()->create([
            'password' => \Hash::make('testpassword'),
         ]);

        $loginData = [
            "email" => $user->email,
            "password" => "testpassword"
        ];

        $response = $this->json('POST', 'api/v1/user/signin', $loginData, ['Accept' => 'application/json'])->assertStatus(202);

        $prepData = [
        	'firstname' => "test",
        	'middlename' => "test",
        	'lastname' => "test",
        	'default_address_id' => 1
        ];

        $response2 = $this->withHeaders(['Authorization' => 'Bearer '.$response['data']['original']['access_token']])->json('patch', 'api/v1/user/profile', $prepData , ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonStructure([
        	"success",
		    "message",
		    "data"
        ]);



        User::find($user->user_id)->delete();
    }
}




	
