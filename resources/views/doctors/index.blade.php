<x-app-layout>
    <div class="container-fluid margin_60_35">
      <div class="row">
        @forelse($doctors as $doctor)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100 doctor-card">
                    <figure class="mb-0">
                        <a href="{{ route('doctors.show', $doctor->id) }}">
                            <img src="{{ $doctor->photo ?? 'http://via.placeholder.com/565x565.jpg' }}" 
                                 alt="{{ $doctor->name }}" 
                                 class="card-img-top rounded-top">
                        </a>
                    </figure>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">{{ $doctor->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($doctor->bio, 100, '...') }}
                        </p>
                        <a href="{{ route('doctors.show', $doctor->id) }}" 
                           class="btn btn-primary w-100 mt-2">
                           View Profile
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No doctors available for this specialty at the moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $doctors->links() }}
    </div>
        @push('styles')
<style>
    .doctor-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        background: #ffffff;
        position: relative;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .doctor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.15);
    }

    .doctor-card img {
        height: 260px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        transition: transform 0.3s ease;
    }

    .doctor-card:hover img {
        transform: scale(1.05);
    }

    .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-size: 1.2rem;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .card-text {
        font-size: 0.95rem;
        color: #555555;
        margin-bottom: 12px;
        flex-grow: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #eb29bbff 0%, #ab1c55ff 100%);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #eb29bbff 0%, #861743ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .text-center h2 {
        font-size: 2rem;
        margin-bottom: 5px;
        color: #0B0440;
    }

    .text-center p {
        color: #6c757d;
        font-size: 1rem;
    }

    @media (max-width: 767px) {
        .doctor-card img {
            height: 220px;
        }
        .card-title {
            font-size: 1.1rem;
        }
        .card-text {
            font-size: 0.9rem;
        }
    }
</style>
@endpush
    
</x-app-layout>