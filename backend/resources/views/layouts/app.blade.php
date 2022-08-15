<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

@include('includes.head')

<body>
    <div id="layout-wrapper">
        <x-header />
        <x-sidebar />

        <div class="vertical-overlay"></div>
        @yield('content')

        </div>
        @include('includes.footer')
        @stack('scripts')
        @if(session('success'))
        <script>
            toastr.options.timeOut = 1500; // 1.5s
            toastr.success("{{session('success')}}");
        </script>
        @endif
    


</html>