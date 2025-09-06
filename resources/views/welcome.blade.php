<x-app-layout>
    <!-- Hero Section -->
    <div class="hero_home version_3">
        <div class="content">
            <h3>Find a Doctor!</h3>
            <p>
                Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula. Mea maiorum menandri vituperata ea,
                quodsi conceptam in vis.
            </p>
            <a href="{{ route('doctors.index') }}" class="btn_1 medium">View all Doctors</a>
        </div>
    </div>
    <!-- /Hero -->
    
    <div class="container margin_120_95">
        <div class="main_title">
            <h2>Discover the <strong>online</strong> appointment!</h2>
            <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad
                debet scaevola, ne mel.</p>
        </div>
        <div class="row add_bottom_30">
            <div class="col-lg-4">
                <div class="box_feat" id="icon_1">
                    <i class="fas fa-user-md"></i>
                    <h3>Find a Doctor</h3>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_2">
                    <i class="fas fa-user-circle"></i>
                    <h3>View profile</h3>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_3">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Book a visit</h3>
                    <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie.</p>
                </div>
            </div>
        </div>
        <!-- /row -->
        <p class="text-center"><a href="{{ route('doctors.index') }}" class="btn_1 medium">Find Doctor</a></p>
    </div>
    <!-- /container -->
    
    <div class="bg_color_1">
        <div class="container margin_120_95">
            <div class="main_title">
                <h2>Most Viewed doctors</h2>
                <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri.</p>
            </div>
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

            <!-- /row -->
            <p class="text-center add_top_30 "><a href="{{ route('doctors.index') }}" class=" w-40  btn btn-primary">View all Doctors</a></p>
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_color_1 -->
    
    <div class="container margin_120_95">
        <div class="main_title">
            <h2>Find your doctor</h2>
            <p>Nec graeci sadipscing disputationi ne, mea ea nonumes percipitur. Nonumy ponderum oporteat cu mel, pro movet
                cetero at.</p>
        </div>
        <div class=" col-xl-4 col-lg-5 col-md-6 mx-auto">
    <div class="list_home ">
        <div class="list_title">
            <h3>  Search by Specialty</h3>
            
        </div>
        <ul>
            @foreach($specialties as $specialty)
                <li>
                    <a href="{{ route('specialties.show', $specialty->id) }}">
                        <strong>{{ $specialty->doctors_count }}</strong> {{ $specialty->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    @if (Route::has('login'))
    <div class="h-14 hidden lg:block"></div>
    @endif
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