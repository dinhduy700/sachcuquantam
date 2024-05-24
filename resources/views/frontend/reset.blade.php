@section('title-page')
    {{ __('app.reset-password.title') }}
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
<div class="reset-password-page mb-4 pt-4">
    <div class="reset--wrapper">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-lg-4 mx-auto p-30">
                    <h1 class="text-uppercase">{{ __('app.reset-password.title-form') }}</h1>

                    <div class="reset-password-form-content">
                        <form action="{{ route('reset.post') }}" method="POST">
                            <input type="hidden" name="token" value="{{ old('token') ?? $token }}">
                            @csrf
                            <!-- @csrf -->
                            <div class="form-group">
                                <input type="email" id="inputEmail" class="form-control"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                    name="email" placeholder="{{ __('app.reset-password.input-email') }}" value="{{ old('email') ?? $email }}" required>
                            </div>
    
                            <div class="form-group">
                                <input type="password" class="form-control"
                                    name="password" placeholder="{{ __('app.reset-password.input-new-password') }}" value="" required>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control"
                                    name="password_confirmation" placeholder="{{ __('app.reset-password.input-confirm-new-password') }}" value="" required>
                            </div>
    
                            <button type="submit" class="col-12 btn btn-danger">{{ __('app.reset-password.btn-reset-password') }}</button>
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

.reset-password-wrapper h1 {
    position: relative;
    display: block;
    font-family: "Roboto",sans-serif;
    font-size: 26px;
    font-weight: 400;
    text-transform: uppercase;
}

.reset-password-wrapper .form-group input {
    height: 45px;
    padding: 0 20px;
    line-height: 45px;
    border-radius: 5px;
    border-color: #ebebeb;
    background: #ebebeb;
}
</style>
@endsection
