<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="main-url" content="{{ url('/') }}">
    <title>{{ config('app.name', 'Pluton') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="shortcut icon" href="{{asset('assets/images/logo-sm.png')}}">

    <!-- jsvectormap css -->
    <link href="{{asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{asset('assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/toastr.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/datatable.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/select.css')}}" rel="stylesheet"/>

</head>

