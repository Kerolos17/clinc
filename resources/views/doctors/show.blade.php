<x-app-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        <style>
            .fc-event { cursor: pointer; }
            .fc-daygrid-day.fc-day-today { background-color: #e6f7ff; }
            .selected-slot { background-color: #007bff !important; color: white !important; }
            .loading-spinner { display: none; text-align: center; padding: 20px; }
            .error-message { color: #dc3545; margin-top: 10px; display: none; }
        </style>
    @endpush

    <div class="container margin_60">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-xl-3 col-lg-4" id="sidebar">
                <div class="box_profile">
                    <figure>
                        <img src="{{ $doctor->photo ?? asset('images/default-doctor.jpg') }}"
                            alt="Dr. {{ $doctor->name }}" class="img-fluid">
                    </figure>
                    <small>{{ $doctor->specialty->name ?? 'General Practitioner' }}</small>
                    <h1>Dr. {{ $doctor->name }}</h1>
                    <ul class="contacts">
                        <li><h6>Address</h6>{{ $doctor->location ?? 'Not specified' }}</li>
                        <li><h6>Phone</h6><a href="tel:{{ $doctor->phone }}">{{ $doctor->phone ?? 'Not available' }}</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="col-xl-9 col-lg-8">
                <div class="box_general_2 add_bottom_45">
                    <div class="main_title_4">
                        <h3><i class="icon_circle-slelected"></i>Select your date and time</h3>
                    </div>

                    <!-- Booking Form -->
                    <form id="booking-form" method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        <input type="hidden" id="selected_date" name="date">
                        <input type="hidden" id="selected_slot_id" name="availability_id">

                        <div class="row add_bottom_45">
                            <!-- Calendar -->
                            <div class="col-lg-7">
                                <div id="calendar"></div>
                                <ul class="legend mt-3">
                                    <li><strong style="background-color: #cce5ff;"></strong> Available</li>
                                    <li><strong style="background-color: #ffcccc;"></strong> Not available</li>
                                </ul>
                            </div>

                            <!-- Slots -->
                            <div id="slots-container" class="col-lg-5">
                                <div class="loading-spinner">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="error-message">No available slots for this date</div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div class="main_title_4">
                            <h3><i class="icon_circle-slelected"></i>Select Service</h3>
                        </div>
                        <ul class="treatments clearfix">
                            @foreach($doctor->services ?? [] as $service)
                                <li>
                                    <div class="checkbox">
                                        <input type="checkbox" class="css-checkbox service-checkbox"
                                            id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}">
                                        <label for="service_{{ $service->id }}" class="css-label">
                                            {{ $service->name }} <strong>${{ number_format($service->price, 2) }}</strong>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="error-message" id="service-error">Please select at least one service</div>

                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn_1 medium mt-2" id="book-now-btn">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let calendarEl = document.getElementById('calendar');
                let selectedSlotId = null;

                // Init Calendar
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    height: 'auto',
                    validRange: { start: new Date() },
                    dateClick: function (info) {
                        document.getElementById('selected_date').value = info.dateStr;
                        loadSlots(info.dateStr);
                    },
                    events: {!! json_encode(
                        $doctor->availabilities->map(fn($slot) => [
                            'title' => 'Available',
                            'start' => $slot->date,
                            'display' => 'background',
                            'backgroundColor' => '#cce5ff',
                            'borderColor' => '#007bff',
                        ])->toArray()
                    ) !!}
                });
                calendar.render();

                // Load slots
                function loadSlots(date) {
                    const container = document.getElementById('slots-container');
                    const loadingSpinner = container.querySelector('.loading-spinner');
                    const errorMessage = container.querySelector('.error-message');

                    container.innerHTML = '';
                    container.appendChild(loadingSpinner);
                    container.appendChild(errorMessage);

                    errorMessage.style.display = 'none';
                    loadingSpinner.style.display = 'block';

                    fetch(`/doctors/{{ $doctor->id }}/availabilities?date=${date}`)
                        .then(res => res.json())
                        .then(data => {
                            loadingSpinner.style.display = 'none';
                            container.innerHTML = '';

                            if (data.length === 0) {
                                errorMessage.style.display = 'block';
                            } else {
                                data.forEach(slot => {
                                    let btn = document.createElement('button');
                                    btn.className = 'btn btn-outline-primary m-1';
                                    btn.textContent = `${slot.start_time} - ${slot.end_time}`;
                                    btn.type = 'button';

                                    btn.addEventListener('click', function () {
                                        document.querySelectorAll('.btn-outline-primary').forEach(b => b.classList.remove('selected-slot'));
                                        this.classList.add('selected-slot');
                                        selectedSlotId = slot.id;
                                        document.getElementById('selected_slot_id').value = slot.id;
                                    });

                                    container.appendChild(btn);
                                });
                            }
                        })
                        .catch(err => {
                            loadingSpinner.style.display = 'none';
                            errorMessage.textContent = 'Error loading slots';
                            errorMessage.style.display = 'block';
                        });
                }

                // Form validation
                document.getElementById('booking-form').addEventListener('submit', function (e) {
                    if (!document.getElementById('selected_date').value) {
                        e.preventDefault();
                        alert('Please select a date');
                        return;
                    }
                    if (!selectedSlotId) {
                        e.preventDefault();
                        alert('Please select a time slot');
                        return;
                    }
                    if (document.querySelectorAll('.service-checkbox:checked').length === 0) {
                        e.preventDefault();
                        document.getElementById('service-error').style.display = 'block';
                        return;
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
