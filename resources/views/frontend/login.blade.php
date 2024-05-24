@section('title-page')
    {{ __('app.login.title') }}
@endsection

@section('seo')
    <meta name="description" content="{{$settings->translation->seo_description ?? ''}}">
    <meta name="keywords" content="{{$settings->translation->seo_keywords ?? ''}}">
    <meta property="og:title" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:description" content="{{$settings->translation->seo_description ?? ''}}" />
    <meta property="og:image" content="{{asset($settings->logo ?? 'assets/images/favicon.ico')}}" />
@endsection

@extends('frontend.layouts.master')

@section('content')
@include('frontend.layouts.banner', ['listBanner' => $banners])
<div class="login-page mb-4 pt-4">
    <div class="login-wrapper">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-lg-4 mx-auto p-30">
                    <h1 class="text-uppercase">{{ __('app.login.title-form') }}</h1>
                    <div class="mb-4">
                        {{ __('app.login.not-registered-quote') }},&nbsp;
                        <a href="{{ route('register.get') }}" class="text-danger btn-register">{{ __('app.login.register-link-title') }}</a>
                    </div>

                    <div class="login-form-content">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" id="inputEmail" class="form-control"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                    name="email" placeholder="{{ __('app.login.input-email') }}" value="" required>
                            </div>

                            <div class="form-group">
                                <input type="password" id="inputPassword" class="form-control"
                                    name="password" placeholder="{{ __('app.login.input-password') }}" value="" required>
                            </div>

                            <button type="submit" class="col-12 btn btn-danger btn-login">{{ __('app.login.btn-login') }}</button>
                        </form>

                        <p class="forget-password">{{ __('app.login.forget-password') }}</p>
                    </div>

                    <div class="forget-password-form-content">
                        <form action="{{ route('forget-password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" id="inputEmail" class="form-control"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                    name="email" placeholder="{{ __('app.login.input-email') }}" value="" required>
                            </div>
                            <button type="submit" class="col-12 btn btn-danger btn-login">{{ __('app.login.reset-password') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css-page')
<style>
.p-30 {
    padding: 30px;
}

.hidden {
    display: none !important;
}

.login-wrapper h1 {
    position: relative;
    display: block;
    font-family: "Roboto",sans-serif;
    font-size: 26px;
    font-weight: 400;
    text-transform: uppercase;
}

.login-wrapper .form-group input {
    height: 45px;
    padding: 0 20px;
    line-height: 45px;
    border-radius: 5px;
    border-color: #ebebeb;
    background: #ebebeb;
}

.login-wrapper .forget-password {
    margin: 15px 0;
    font-family: "Roboto",sans-serif;
    font-size: 14px;
    line-height: 24px;
}

.login-wrapper .forget-password:hover {
    cursor: pointer;
    color: #cc2121;
}

.login-wrapper .btn-register:hover {
    color: #000!important;
}

.forget-password-form-content {
    display:none;
}
</style>
@endsection

@section('script-page')
<script type="text/javascript">
$(document).ready(function () {
    "use strict";
    $('.forget-password').on('click', function() {
        $('.login-form-content').toggleClass('hidden');
        $('.forget-password-form-content').slideToggle();
    });

    // Toast
    $(".toast-close").click(function() {
        $(this).closest('.toast').remove();
    });

    setTimeout(() => {
        $('div.toast-list').remove();
    }, 3000);
    });
</script>
@endsection
