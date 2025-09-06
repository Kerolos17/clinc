<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wellclinc') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{asset('assets/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{asset('assets/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{asset('assets/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{asset('assets/img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/menu.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/vendors.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
    <link href="{{asset('assets/css/date_picker.css')}}" rel="stylesheet">
    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <!-- Scripts -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div id="page">
        @include('layouts.navigation')

        <main>
            <!-- Page Heading -->
            @isset($header)
            <div id="results">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {{ $header }}
                        </div>
                    </div>
                </div>
            </div>
            @endisset

            <!-- Page Content -->
            <div>
                {{ $slot }}
            </div>
        </main>
        <div id="toTop"></div>
        <!-- Back to top button -->


        <!-- COMMON SCRIPTS -->
        <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
        <script src="{{asset('assets/js/common_scripts.min.js')}}"></script>
        <script src="{{asset('assets/js/functions.js')}}"></script>
    </div>
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
    <script>
        $('#calendar').datepicker({
    			    todayHighlight: true,
    				daysOfWeekDisabled: [0],
    				weekStart: 1,
    			    format: "yyyy-mm-dd",
        			datesDisabled: ["2017/10/20", "2017/11/21","2017/12/21", "2018/01/21","2018/02/21","2018/03/21"],
    			});
    </script>
    @include('layouts.footer')
    @stack('scripts')
</body>

</html>