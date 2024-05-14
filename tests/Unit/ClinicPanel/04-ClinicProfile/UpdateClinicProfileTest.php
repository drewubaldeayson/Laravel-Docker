<?php

namespace Tests\Unit;

use Tests\TestCase;

class UpdateClinicProfileTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: Update Clinic Profile.
     *
     * @return void
     */

    public function testSuccessUpdateClinicProfile()
    {
        $prepData = [
        	"name"          => $this->faker->name(),
            "description"   => $this->faker->text(),
            "mobile_number" => $this->faker->numerify('09#########'),
            "email"         => $this->faker->email(),
            "region_code"   => "13",
            "province_code" => "1376",
            "city_code"     => "137607",
            "brgy_code"     => "137607020",
            "region"        => "NATIONAL CAPITAL REGION (NCR)",
            "province"      => "NCR, FOURTH DISTRICT",
            "city"          => "TAGUIG CITY",
            "brgy"          => "Fort Bonifacio",
            "address"       => "Serendra, BGC Taguiug City Philippines",
            "landmark"      => "Beside Hanamaruken Ramen",
            "zip_code"      => "1635",
            "longtitude"    => "121.054139",
            "latitude"      => "14.549566"
        ];

        $this->json('patch', 'api/v1/provider/clinic?token=' . $this->auth_token, $prepData , ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "success" => true,
            "message" => "Clinic updated successfully.",
            "data"    => []
        ]);
    }
}
