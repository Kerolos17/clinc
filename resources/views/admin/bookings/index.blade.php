{{-- resources/views/admin/bookings/index.blade.php --}}
@extends('admin.layout')

@section('page-title', 'Bookings')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>All Bookings</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Service</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->patient_name ?? 'Guest' }}</td>
                    <td>{{ $booking->doctor->name }}</td>
                    <td>
                        @foreach($booking->services as $service)
                            <span class="badge bg-info">{{ $service->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $booking->availability->date }} - {{ $booking->availability->start_time }}</td>
                    <td><span class="badge bg-warning">{{ ucfirst($booking->status) }}</span></td>
                    <td><span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : 'danger' }}">
                        {{ ucfirst($booking->payment_status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">View</a>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $bookings->links() }}
    </div>
</div>
@endsection
