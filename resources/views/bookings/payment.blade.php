<x-app-layout>
    <div class="container margin_60">
        <div class="row">
            <!-- Main Payment Form -->
            <div class="col-xl-8 col-lg-8">
                <div class="box_general_3 cart">
                    <form method="POST" action="{{ route('bookings.confirm', $booking->id) }}">
                        @csrf
                        <div class="form_title">
                            <h3><strong>1</strong> Your Details</h3>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First name</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Last name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form_title">
                            <h3><strong>2</strong> Payment Information</h3>
                        </div>
                        <div class="step">
                            <div class="form-group">
                                <label>Name on card</label>
                                <input type="text" name="card_name" class="form-control" placeholder="John Doe">
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label>Card number</label>
                                    <input type="text" name="card_number" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx">
                                </div>
                                <div class="col-md-6">
                                    <label>Expiration</label>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" name="exp_month" class="form-control" placeholder="MM"></div>
                                        <div class="col-md-6"><input type="text" name="exp_year" class="form-control" placeholder="YY"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label>CCV</label>
                                    <input type="text" name="ccv" class="form-control" placeholder="123">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div id="policy">
                            <h4>Cancellation policy</h4>
                            <label class="container_check">
                                I accept <a href="#">terms and conditions</a>
                                <input type="checkbox" name="terms" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <button type="submit" class="btn_1 full-width">Confirm and Pay</button>
                    </form>
                </div>
            </div>

            <!-- Booking Summary -->
            <aside class="col-xl-4 col-lg-4" id="sidebar">
                <div class="box_general_3 booking">
                    <div class="title">
                        <h3>Your booking</h3>
                    </div>
                    <div class="summary">
                        <ul>
                            <li>Date: <strong class="float-right">{{ $booking->availability->date }}</strong></li>
                            <li>Time: <strong class="float-right">{{ $booking->availability->start_time }} - {{ $booking->availability->end_time }}</strong></li>
                            <li>Doctor: <strong class="float-right">{{ $booking->doctor->name }}</strong></li>
                        </ul>
                    </div>
                    <ul class="treatments checkout clearfix">
                        @foreach($booking->services as $service)
                            <li>{{ $service->name }} <strong class="float-right">${{ number_format($service->pivot->price, 2) }}</strong></li>
                        @endforeach
                        <li class="total">Total <strong class="float-right">${{ number_format($booking->total_price, 2) }}</strong></li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
