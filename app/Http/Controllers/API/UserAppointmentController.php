<?php

namespace App\Http\Controllers\API;

use App\Contracts\AppointmentInterface;

use App\Http\Resources\AppointmentResource;
use App\Http\Resources\AppointmentViewResource;
use App\Http\Resources\AppointmentViewCompletedResource;
use App\Http\Resources\UserAppointmentResultResource;

use App\Http\Controllers\API\ApiController;

class UserAppointmentController extends ApiController
{

    private $appointment;
    
    public function __construct(
        AppointmentInterface $appointment
    ){
        $this->appointment = $appointment;
    }

    public function fetchByStatus($status)
    {
        $result = $this->appointment->fetchUserAppointmentBystatus($status);
        if($result['status'] === true){
            $paginated = $result['data'];
            if($status == "completed"){
                $resources = AppointmentViewCompletedResource::collection($paginated);
            }else{
                $resources = AppointmentViewResource::collection($paginated);
            }
            return $this->successResponse($paginated, $result['message'], 200);
        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function show($id){
        $result = $this->appointment->showUserAppointment($id);
        if($result['status'] === true){
            $paginated = $result['data'];
            $resources = AppointmentViewResource::make($paginated);
            return $this->successResponse($paginated, $result['message'], 200);
        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function fetchWithBookingResults($booking_for)
    {
        $result = UserAppointmentResultResource::collection($this->appointment->getUserBookingResult($booking_for));
        return $this->successResponse($result, '', 200);
    }

    public function showWithBookingResult($id)
    {
        $result = $this->appointment->showUserBookingResult($id);
        if($result['status'] === true){
            return $this->successResponse(UserAppointmentResultResource::make($result['data']), $result['message'], 200);
        }
        return $this->errorResponse([], $result['message'], 400);
    }

    public function fetchPatientResult($id)
    {
        $result = $this->appointment->fetchPatientResult($id);
        if($result['status'] === true){
            return $this->successResponse(PatientResultResource::make($result['data']), $result['message'], 200);
        }
        return $this->errorResponse([], $result['message'], 400);
    }

    
}
