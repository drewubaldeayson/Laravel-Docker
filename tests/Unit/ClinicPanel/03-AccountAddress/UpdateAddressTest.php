<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\UserAddresses;

class UpdateAddressTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: Update Address.
     *
     * @return void
     */


    public function testSuccessUpdateAddress()
    {
        
        $user_address = UserAddresses::factory()->create([
            'user_id' => $this->clinic_user->user_id
        ]);

        $prepData = [
        	"region_code"    => "04",
            "province_code"  => "0434",
            "city_code"      => "043404",
            "brgy_code"      => "043404009",
            "region"         => "REGION IV-A (CALABARZON)",
            "province"       => "LAGUNA",
            "city"           => "CABUYAO CITY",
            "brgy"           => "MAMATID",
            "address"        => "BLK 215 L 44, PHASE 2 MABUHAY CITY",
            "landmark"       => "PUREGOLD MAMATIDs",
            "zip_code"       => "4025",
            "longtitude"     => "120.600654",
            "latitude"       => "16.389395",
            "contact_number" => "09234087764"
        ];
        

        $this->json('PATCH', 'api/v1/providers/profile/address/'.$user_address->address_id.'?token=' . $this->auth_token, $prepData , ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                "success" => true,
                "message" => "Your address successfully updated.",
                "data"    => []
            ]);

        $user_address->delete();
    }
}
