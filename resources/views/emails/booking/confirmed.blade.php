<x-mail::message>
    # Booking Confirmation

Hi {{ $booking->patient_name }},

Your appointment has been confirmed.

- **Doctor:** {{ $booking->doctor->name }}
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

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
