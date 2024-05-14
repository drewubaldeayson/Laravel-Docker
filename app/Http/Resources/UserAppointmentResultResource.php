<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAppointmentResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $patients = [];
        foreach ($this->booking_detail as $key => $value) {
            $value->booking_result['qr_image'] = env('APP_URL').'api/v1/user/appointment/result/'.$value->booking_result['qr_image'];
            $value->booking_result['result_pdf'] = $value->booking_result['resultpdf_path'];
            array_push($patients, $value);
        }

        return [
            'booking_order_id' => $this->booking_order_id,
            'booking_code' => $this->order_number,
            'booking_date' => $this->booking_date,
            'booking_time_slot' => $this->booking_time_slot,
            'no_of_patient' => count($this->booking_result),
            'patients' => $patients,
            'clinic' => $this->clinic == null ? null : [
                'id' => $this->clinic->clinic_id,
                'clinic_name' => $this->clinic->clinic_name,
                'clinic_location' => $this->clinic->location
            ],
            'service_event' => [
                'id' => $this->service_event->service_event_id,
                'service_event_name' => $this->service_event->service_event_name,
                'service_event_code' => $this->service_event->service_event_code,
                'service_event_type' => $this->service_event->service_event_type->type_name,
            ]
        ];
    }
}
