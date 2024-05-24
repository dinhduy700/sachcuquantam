@section('title-page')
    {{ __('app.register.title') }}
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
    <div class="register-page mb-4 pt-4">
        <div class="register-wrapper">
            <div class="container text-center">
                <div class="row">
                    <div class="col-12 col-lg-4 mx-auto p-30">
                        <h1 class="text-uppercase">{{ __('app.register.title-form') }}</h1>
                        <div class="mb-4">
                            {{ __('app.register.quote') }},
                            <a href="{{ route('login.get')  }}" class="text-danger btn-register">{{ __('app.register.login-here') }}</a>
                        </div>

                        <div class="register-form-content">
                            <form action="" method="POST">
                                <input type="hidden" name="type" value="{{ old('type') ?? 1 }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="inputName" class="form-control"
                                           name="name" placeholder="{{ __('app.register.input-name') }}" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" id="inputEmail" class="form-control"
                                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                           name="email" placeholder="{{ __('app.register.input-email') }}" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="number" id="inputPhone" class="form-control"
                                           name="phone" placeholder="{{ __('app.register.input-phone') }}" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" id="inputPassword" class="form-control"
                                           name="password" placeholder="{{ __('app.register.input-password') }}" value="" required>
                                </div>

                                <button type="submit" class="col-12 btn btn-danger btn-login">{{ __('app.register.btn-register') }}</button>
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
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .p-30 {
            padding: 30px;
        }

        .hidden {
            display: none !important;
        }

        .register-wrapper h1 {
            position: relative;
            display: block;
            font-family: "Roboto",sans-serif;
            font-size: 26px;
            font-weight: 400;
            text-transform: uppercase;
        }

        .register-wrapper .form-group input {
            height: 45px;
            padding: 0 20px;
            line-height: 45px;
            border-radius: 5px;
            border-color: #ebebeb;
            background: #ebebeb;
        }

        .register-wrapper .forget-password {
            margin: 15px 0;
            font-family: "Roboto",sans-serif;
            font-size: 14px;
            line-height: 24px;
        }

        .register-wrapper .forget-password:hover {
            cursor: pointer;
            color: #cc2121;
        }

        .register-wrapper .btn-register:hover {
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
