<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticationResources extends JsonResource
{

        /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

     public function toArray($request)
     {
         // return parent::toArray($request);
         return [
            'user_id' => $this->id,
            'username' => $this->firstname, // Assuming firstname is the username
            'balance' => $this->balance, // Assuming balance is a property of the model
            'currency' => $this->currency, // Assuming currency is a property of the model
         ];
     }

}