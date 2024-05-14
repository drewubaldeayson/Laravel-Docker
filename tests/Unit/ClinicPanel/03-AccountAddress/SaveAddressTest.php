<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\UserAddresses;

class SaveAddressTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: Save Address.
     *
     * @return void
     */

    public function testSuccessSaveAddress()
    {
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
            "landmark"       => "PUREGOLD MAMATID",
            "zip_code"       => "4025",
            "longtitude"     => "120.600654",
            "latitude"       => "16.389395",
            "contact_number" => "09234087764"
        ];

        $this->json('POST', 'api/v1/providers/profile/address?token=' . $this->auth_token, $prepData , ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    "region_code",
                    "province_code",
                    "city_code",
                    "brgy_code",
                    "region",
                    "province",
                    "city",
                    "brgy",
                    "address",
                    "landmark",
                    "zip_code",
                    "longtitude",
                    "latitude",
                    "contact_number",
                    "user_id",
                    "is_default",
                    "address_id"
                ]
            ]);
        
            UserAddresses::where('user_id', $this->clinic_user->user_id)->delete();
    }
}
