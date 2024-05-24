<!DOCTYPE html>
<html>
<head>
    <title>@yield('title-page')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}">
    @yield('seo')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}">
    @yield('css-page')
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">

</head>
<body>
    @include('frontend.layouts.header')
    @include('frontend.component.message')
    @yield('content')
    @include('frontend.layouts.footer')
    <input type="hidden" name="url" value="{{url('/'. ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ))}}">
    <script type="text/javascript" src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    @yield('script-page')
    <script type="text/javascript" src="{{asset('frontend/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/function.js')}}"></script>
</body>
</html>