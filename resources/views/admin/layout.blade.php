{{-- resources/views/admin/layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- CSS -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app" class="admin-dashboard">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <header class="admin-header">
                <h2>@yield('page-title', 'Dashboard')</h2>
            </header>

            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
