
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') </title>
    {{-- lay ra ten mien va bo sung duong dan css --}}
    <base href="{{ asset('') }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/logo.png">
    <!-- Thư viện vedor -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/homePage.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Theme khởi tạo -->
    <script>
        var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem(
            'themeSettings')) : {};
        var themeName = themeSettings.themeName || '';
        if (themeName) {
            document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
        } else {
            document.write('<link rel="stylesheet" id="theme-style" href="css/app.css">');
        }
    </script>
    @stack('styles')
</head>

<body>
    <div class="main-wrapper">
        <div class="app" id="app">
            <!-- header -->
            @include('master.partials.header-admins')
            <!-- end header -->

            <!-- sidebar -->
            @include('master.partials.sidebar-admins')
            <!-- end sidebar -->

            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>

            <!-- content -->
            @yield('content')
            <!-- end content -->

            <!-- footer -->
            @include('master.partials.footer')
            <!-- end footer -->
        </div>
    </div>

    <script src="js/vendor.js"></script>
    <script src="js/app.js"></script>
    
    @stack('scripts')
</body>

</html>