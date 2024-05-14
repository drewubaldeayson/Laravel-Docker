<?php

namespace Tests\Unit;

use Tests\TestCase;

class ShowMyClinicProfileTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: My Clinic Profile.
     *
     * @return void
     */


    public function testSuccessShowMyClinicProfile()
    {
        $this->json('GET', 'api/v1/provider/clinic/show?token=' . $this->auth_token, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJsonStructure([
            "data" => [
                "id",
                "name",
                "description",
                "contact_number",
                "email_address",
                "location" => [
                    "clinic_address_id",
                    "clinic_region_code",
                    "clinic_province_code",
                    "clinic_city_code",
                    "clinic_brgy_code",
                    "clinic_region",
                    "clinic_province",
                    "clinic_city",
                    "clinic_brgy",
                    "clinic_address",
                    "clinic_landmark",
                    "clinic_zip_code",
                    "clinic_longtitude",
                    "clinic_latitude"
                ],
                "status",
                "hasUser"
            ]
        ]);
    }
}
