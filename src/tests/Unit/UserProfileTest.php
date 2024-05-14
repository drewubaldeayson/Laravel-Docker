<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailedShowProfile()
    {
        $dummyToken = 'thisiswrongtoken';

        $response2 = $this->withHeaders(['Authorization' => 'Bearer '.$dummyToken])->json('GET', 'api/v1/user/profile', ['Accept' => 'application/json'])
        ->assertStatus(403)
        ->assertJson([
                "success" => false,
                "message" => "Token is invalid.",
                "data" => []
            ]);;
    }

    public function testSuccessfulShowProfile()
    {
        $user = User::factory()->create([
            'password' => \Hash::make('testpassword'),
         ]);

        $loginData = [
            "email" => $user->email,
            "password" => "testpassword"
        ];

        $response = $this->json('POST', 'api/v1/user/signin', $loginData, ['Accept' => 'application/json'])->assertStatus(202);

        $response2 = $this->withHeaders(['Authorization' => 'Bearer '.$response['data']['original']['access_token']])->json('GET', 'api/v1/user/profile', ['Accept' => 'application/json'])
        ->assertStatus(200);
     //    ->assertJsonStructure([

	    //     		[
	    //     			"success",
	    //     			"message",
		   //              "data" => [
					//         "profile" => [
					//             'user_id',
					//             'username',
					//             'firstname',
					//             'middlename',
					//             'lastname',
					//             'mobile_number',
					//             'gender',
					//             'email',
					//             'email_verified_at',
					//             'created_at',
					//             'updated_at'
					//         ],
					//         "addresses" => [
					//             [
					//                 'address_id',
					//                 'user_id',
					//                 'region_code',
					//                 'province_code',
					//                 'city_code',
					//                 'brgy_code',
					//                 'region',
					//                 'province',
					//                 'city',
					//                 'brgy',
					//                 'address',
					//                 'landmark',
					//                 'zip_code',
					//                 'longtitude',
					//                 'latitude',
					//                 'contact_number',
					//                 'is_default'
					//             ]
					//         ]
					//     ]
					// ]
     //        ]);

        User::find($user->user_id)->delete();
    }
}




	
