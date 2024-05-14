<?php

namespace Tests;

use App\Models\User;
use App\Models\UserServiceProvider;
use App\Models\ClinicAddress;
use App\Models\Clinic;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;
    
    protected $auth_token;
    protected $auth_password = 'testpassword';

    protected $clinicAddress;
    protected $clinic_user;
    protected $clinic;
    protected $userserviceprovider;

    

    protected function setUp(): void
    {
        parent::setUp();
        $this->generateToken();
        $this->setUpFaker();
    }

    public function generateToken()
    {
        // create user using factory
        $clinic_user = User::factory()->create([
            'password' => \Hash::make($this->auth_password),
        ]);

        $clinicaddress = ClinicAddress::factory()->create();
        $clinic = Clinic::factory()->create([
            'clinic_address_id' => $clinicaddress->clinic_address_id
        ]);
        $userserviceprovider = UserServiceProvider::factory()->create([
            'user_id' => $clinic_user->user_id,
            'clinic_id' => $clinic->clinic_id
        ]);

        $this->clinic_email = $clinic_user->email;
        $this->clinicaddress = $clinicaddress;
        $this->clinic_user = $clinic_user;
        $this->clinic = $clinic;
        $this->userserviceprovider = $userserviceprovider;

        $this->auth_token = JWTAuth::fromUser($clinic_user);
    }

    public function tearDown(): void
    {
        $this->userserviceprovider->forceDelete();
        $this->clinic_user->forceDelete();
        $this->clinic->forceDelete();
        $this->clinicaddress->forceDelete();

        parent::tearDown();
    } 



}
