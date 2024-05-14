<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthenticationModel extends Model

{
    public function getDetails()
    {
        $user_id = "123XXX";
        $username = "arjay_notorio";
        $balance = 123;
        $currency = "MYR";
        $firstName = "Noli Arjay";
        $lastName = "Notorio";
        $address = "Acacia";

        $data = [
            'user_id' => $user_id,
            'username' => $username,
            'balance' => $balance,
            'currency' => $currency,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'address' => $address
        ];
        
        print_r($data);
    }
}