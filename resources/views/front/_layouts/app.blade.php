<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#7fad39">
    <title>{{ $__title }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('front-assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}" type="text/css">
</head>

<body>
@include('front._partials.preloader')

@include('front._partials.mobile-menu')

@include('front._partials.header')

@include('front._partials.breadcrumbs')

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        @yield('content')
    </div>
</section>
<!-- Product Section End -->

@include('front._partials.footer')

<!-- Js Plugins -->
<script src="{{ asset('front-assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('front-assets/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('front-assets/js/mixitup.min.js') }}"></script>
<script src="{{ asset('front-assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front-assets/js/main.js') }}"></script>

@stack('scripts')
<script src="{{ asset('front-assets/js/app.js') }}"></script>
</body>
</html>
