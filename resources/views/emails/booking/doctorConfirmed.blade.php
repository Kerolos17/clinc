<x-mail::message>
# New Booking Confirmed

Hello {{ $booking->doctor->name }},

A new appointment has been confirmed with the following details:

- **Patient:** {{ $booking->patient_name }}
- **Date:** {{ $booking->availability->date }}
- **Time:** {{ $booking->availability->start_time->format('H:i') }} - {{ $booking->availability->end_time->format('H:i') }}

@component('mail::table')
| Service       | Price |
| ------------- |:-----:|
@foreach($booking->services as $service)
| {{ $service->name }} | ${{ number_format($service->pivot->price, 2) }} |
@endforeach
@endcomponent

**Total: ${{ number_format($booking->total_price, 2) }}**

Please prepare accordingly.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
