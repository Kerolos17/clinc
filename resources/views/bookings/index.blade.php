<x-app-layout>
    <div class="container margin_60">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box_general_2">
                    <h3>Complete Your Booking</h3>
                    <p><strong>Doctor:</strong> {{ $booking->doctor->name }}</p>
                    <p><strong>Date:</strong> {{ $booking->availability->date }}</p>
                    <p><strong>Time:</strong> {{ $booking->availability->start_time }} - {{ $booking->availability->end_time }}</p>
                    <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>

                    <form method="POST" action="{{ route('bookings.processPayment', $booking->id) }}">
                        @csrf

                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" required>
                        </div>

                        <div class="form-group">
                            <label for="card_expiry">Expiry Date</label>
                            <input type="text" class="form-control" id="card_expiry" name="card_expiry" required>
                        </div>

                        <div class="form-group">
                            <label for="card_cvc">CVC</label>
                            <input type="text" class="form-control" id="card_cvc" name="card_cvc" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Pay Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
