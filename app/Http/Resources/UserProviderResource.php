<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProviderResource extends JsonResource
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
            'user' => [
                'id' => $this->user->user_id,
                'firstname' => $this->user->firstname,
                'middlename' => $this->user->middlename,
                'lastname' => $this->user->lastname,
                'mobile_number' => $this->user->mobile_number,
                'email' => $this->user->email
            ],
            'clinic' => [
                'id' => $this->clinic->clinic_id,
                'name' => $this->clinic->clinic_name,
                'description' => $this->clinic->clinic_description,
                'mobile_number' => $this->clinic->clinic_mobile_number,
                'email' => $this->clinic->clinic_email
            ]
        ];
    }
}
