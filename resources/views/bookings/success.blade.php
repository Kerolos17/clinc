<x-app-layout>
    <div class="container margin_60">
        <div class="row justify-content-center">
            <div class="col-lg-8 p-4">
                <div class="confirmation-card p-4">
                    <div class="card-body text-center">
                        <div class="confirmation-icon mb-4">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2 class="mb-3">Booking Confirmed!</h2>
                        <p class="lead">Thank you, <strong>{{ $booking->patient_name }}</strong>. Your appointment has been successfully booked.</p>
                        
                        <div class="booking-details mt-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="detail-box">
                                        <div class="detail-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h5>Doctor</h5>
                                            <p>{{ $booking->doctor->name }}</p>
                                            <p class="text-muted">{{ $booking->doctor->specialty->name ?? 'General Practitioner' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="detail-box">
                                        <div class="detail-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h5>Date & Time</h5>
                                            <p>{{ \Carbon\Carbon::parse($booking->availability->date)->format('l, F j, Y') }}</p>
                                            <p class="text-muted">{{ \Carbon\Carbon::parse($booking->availability->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->availability->end_time)->format('g:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="detail-box">
                                        <div class="detail-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h5>Location</h5>
                                            <p>{{ $booking->doctor->location ?? 'Main Clinic' }}</p>
                                            <a href="https://maps.google.com/?q={{ urlencode($booking->doctor->location ?? '') }}" target="_blank" class="text-primary">View on map</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="detail-box">
                                        <div class="detail-icon">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h5>Total Amount</h5>
                                            <p class="price">${{ number_format($booking->total_price, 2) }}</p>
                                            <p class="text-muted small">Payment at clinic</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($booking->services && $booking->services->count() > 0)
                        <div class="services-section mt-4">
                            <h5 class="mb-3">Services Booked</h5>
                            <div class="list-group">
                                @foreach($booking->services as $service)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>{{ $service->name }}</div>
                                    <span class="badge bg-primary rounded-pill">${{ number_format($service->price, 2) }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Important:</strong> Please arrive 15 minutes before your appointment. 
                            If you need to cancel or reschedule, please contact us at least 24 hours in advance.
                        </div>
                        
                        <div class="action-buttons mt-4">
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                <i class="fas fa-home me-1"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted">A confirmation email has been sent to your registered email address.</p>
                    <p class="text-muted small">Booking ID: #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>
    </div>
    
    @push('styles')
    <!-- عبر CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .confirmation-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            position: relative;
        }
        
        .confirmation-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #28a745, #20c997);
        }
        
        .confirmation-icon {
            font-size: 5rem;
            color: #28a745;
            animation: scaleIn 0.5s ease-out;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 4px 6px rgba(40, 167, 69, 0.2));
        }
        
        @keyframes scaleIn {
            from { 
                transform: scale(0); 
                opacity: 0;
            }
            to { 
                transform: scale(1); 
                opacity: 1;
            }
        }
        
        .detail-box {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .detail-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .detail-icon {
            font-size: 2rem;
            color: #007bff;
            margin-right: 15px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 50%;
        }
        
        .detail-content h5 {
            margin-bottom: 8px;
            font-weight: 600;
            color: #343a40;
            font-size: 1.1rem;
        }
        
        .detail-content p {
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #28a745;
            margin-bottom: 5px;
        }
        
        .services-section {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .services-section h5 {
            font-weight: 600;
            color: #343a40;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        
        .list-group-item {
            border: none;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            background-color: #f8f9fa;
            font-size: 0.95rem;
        }
        
        .badge {
            font-weight: 500;
            padding: 5px 10px;
        }
        
        .alert-info {
            background-color: rgba(23, 162, 184, 0.1);
            border-color: rgba(23, 162, 184, 0.2);
            color: #0c5460;
            border-radius: 10px;
            padding: 15px;
            font-size: 0.95rem;
        }
        
        .action-buttons .btn {
            min-width: 160px;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .action-buttons .btn-primary {
            background: linear-gradient(90deg, #007bff, #0056b3);
            border: none;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }
        
        .action-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4);
        }
        
        .action-buttons .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }
        
        .action-buttons .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
    </style>
    @endpush
    
</x-app-layout>