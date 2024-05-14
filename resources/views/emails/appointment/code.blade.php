@component('mail::message')
# Introduction

You have successfully booked an appointment on {{ $order['booking_date']}} at {{ $order['booking_time']}}. <br><br>
Your Booking Code is <strong>{{ $order['booking_code'] }} </strong>

<!-- @component('mail::button', ['url' => 'https://tpsnpublictest.qoneqtor.com/result/'.$order['booking_code'] ])
Visit Details
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
