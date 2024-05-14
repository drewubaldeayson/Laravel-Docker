<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIndividualResource extends JsonResource
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
            'id' => $this->user->user_id,
            'firstname' => $this->user->firstname,
            'middlename' => $this->user->middlename,
            'lastname' => $this->user->lastname,
            'contact_number' => $this->user->mobile_number,
            'email' => $this->user->email,
            'gender' => $this->user->gender,
            'birthday' => $this->user->date_of_birth,
            'age' => $this->user->age,
            'nationality' => $this->user->nationality,
            'customer_type' => $this->customer_type
        ];
    }
}
