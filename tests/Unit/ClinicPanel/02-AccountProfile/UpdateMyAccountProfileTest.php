<?php

namespace Tests\Unit;

use Tests\TestCase;

class UpdateMyAccountProfileTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: Update My Account Profile.
     *
     * @return void
     */


    public function testSuccessUpdateMyAccountProfile()
    {
        $gender = $this->faker->randomElement($array = array ('female','male'));

        $prepData = [
        	'firstname'   => $this->faker->firstName(),
        	'middlename'  => $this->faker->randomLetter(),
        	'lastname'    => $this->faker->lastName(),
            'gender'      => $gender,
            'nationality' => "Filipino",
            'birthday'    => $this->faker->date($format = 'Y-m-d', $max = 'now')
        ];

        $this->json('patch', 'api/v1/providers/profile?token=' . $this->auth_token, $prepData , ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "success" => true,
            "message" => "Profile updated successfully",
            "data"    => []
        ]);
    }
}
