<?php

namespace Tests\Unit;

use Tests\TestCase;

class ShowAddressTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: Show All Profile Addresses.
     *
     * @return void
     */

    public function testSuccessShowAddress()
    {
        $this->json('GET', 'api/v1/providers/profile/address?token=' . $this->auth_token, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
