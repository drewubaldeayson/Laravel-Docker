<?php

namespace Tests\Unit;

use App\Models\User;

use Tests\TestCase;
use JWTAuth;

class MyAccountProfileTest extends TestCase
{
    /**
     * Unit test for Clinic Panel: My Account Profile.
     *
     * @return void
     */


    public function testSuccessMyAccountProfile()
    {
        $this->json('GET', 'api/v1/providers/profile?token=' . $this->auth_token, ['Accept' => 'application/json'])
        ->assertStatus(200);
    }
}