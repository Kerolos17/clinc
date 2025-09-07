<?php

namespace App\Http\Controllers;

use App\Jobs\SendBookingConfirmationEmail;
use App\Jobs\SendDoctorBookingConfirmationEmail;
use App\Mail\BookingConfirmationMail;
use App\Mail\DoctorBookingConfirmationMail;
use App\Models\Booking;
use App\Models\Availability;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'availability_id' => 'required|exists:availabilities,id',
            'services' => 'required|array|min:1',
        ]);

        return DB::transaction(function () use ($request) {
            $availability = Availability::findOrFail($request->availability_id);

            // ✅ نتأكد إن الـ Slot مش محجوز
            if ($availability->is_booked) {
                return response()->json([
                    'success' => false,
                    'message' => 'This time slot is already booked.',
                ], 400);
            }

            // ✅ حساب إجمالي السعر
            $total = 0;
            foreach ($request->services as $serviceId) {
                $service = Service::find($serviceId);
                if ($service) {
                    $total += $service->price;
                }
            }

            // ✅ إنشاء الحجز
            $booking = Booking::create([
                'doctor_id'       => $request->doctor_id,
                'user_id'         => Auth::id(), // null لو مش عامل Login
                'availability_id' => $availability->id,
                'total_price'     => $total,
                'status'          => 'pending',
                'payment_status'  => 'unpaid',
            ]);

            // ✅ ربط الخدمات مع الحجز
            foreach ($request->services as $serviceId) {
                $service = Service::find($serviceId);
                if ($service) {
                    $booking->services()->attach($service->id, [
                        'price' => $service->price,
                    ]);
                }
            }

            // ✅ تحديث حالة الـ Slot
            $availability->update(['is_booked' => true]);

            return redirect()->route('bookings.payment', $booking->id);
        });
    }
    public function payment(Booking $booking)
    {
        return view('bookings.payment', compact('booking'));
    }

    public function confirm(Request $request, Booking $booking)
    {
        $booking = Booking::findOrFail($booking->id);

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'phone'      => 'required|string|max:20',
            'terms'      => 'accepted',
        ]);

        // تحديث بيانات العميل في الحجز
        $booking->update([
            'patient_name'   => $request->first_name . ' ' . $request->last_name,
            'patient_email'  => $request->email,
            'patient_phone'  => $request->phone,
            'payment_status' => 'paid',       // بعد الدفع
            'status'         => 'confirmed',  // تأكيد الحجز
        ]);

        // ✅ استدعاء الـ Job لإرسال الإيميل في الخلفية
        SendBookingConfirmationEmail::dispatch($booking);
        SendDoctorBookingConfirmationEmail::dispatch($booking);
        // إرسال الميل للطبيب (لو عنده إيميل)
        // if ($booking->doctor && $booking->doctor->email) {
        //     Mail::to($booking->doctor->email)
        //         ->send(new DoctorBookingConfirmationMail($booking));
        // }

        // // إرسال الميل للمريض
        // if ($booking->patient_email) {
        //     Mail::to($booking->patient_email)
        //         ->send(new BookingConfirmationMail($booking));
        // }

        // ✅ بعدين نعمل redirect
        return redirect()->route('bookings.success', $booking->id)
            ->with('success', 'Your booking is confirmed!');
    }

    public function success($id)
    {
        $booking = Booking::with(['doctor', 'availability', 'services'])->findOrFail($id);
        return view('bookings.success', compact('booking'));
    }
}
