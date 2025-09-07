<?php

namespace App\Jobs;

use App\Mail\DoctorBookingConfirmed;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendDoctorBookingConfirmationEmail implements ShouldQueue
{
    use Queueable;
    protected $booking;

    /**
     * Create a new job instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;  
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->booking->doctor->email)
            ->send(new DoctorBookingConfirmed($this->booking));
    }
}
