@section('title-page')
    {{ __('app.contact.title') }}
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
{{-- @include('frontend.layouts.banner', ['listBanner' => $banners]) --}}
<div class="contact-page">
    <div class="support-info mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-lg-3 mb-3">
                    <div class="icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>

                    <div class="content">
                        <h4 class="text-uppercase">{{ __('app.contact.address') }}</h4>
                        <span>{{isset($setting->translation->address) ? $setting->translation->address : '' }}</span>
                    </div>
                </div>

                <div class="col-12 col-lg-3 mb-3">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>

                    <div class="content">
                        <h4 class="text-uppercase">{{ __('app.contact.email') }}</h4>
                        <span>
                            @if(!empty($setting->email) )
                                <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                            @endif
                        </span>
                    </div>
                </div>

                <div class="col-12 col-lg-3 mb-3">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>

                    <div class="content">
                        <h4 class="text-uppercase">{{ __('app.contact.hotline') }}</h4>
                        <span>
                            @if(!empty($setting->hotline))
                                <a class="phone" href="tel:{{ $setting->hotline }}">{{ $setting->hotline }}</a>
                            @endif
                        </span>
                    </div>
                </div>

                <div class="col-12 col-lg-3 mb-3">
                    <div class="icon">
                        <i class="far fa-clock"></i>
                    </div>

                    <div class="content">
                        <h4 class="text-uppercase">{{ __('app.contact.time-work') }}</h4>
                        <span>
                            @if(!empty($setting->translation->working_time))
                                {{ $setting->translation->working_time }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="location-address">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="location-map">
                        @if(!empty($setting->map))
                            <iframe class="gmap-iframe"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="{{ $setting->map }}"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="box-contact">
                        @lang('app.contact.title-div')

                        <form class="contact-form-inner" method="post" action="{{ route('contact.index') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="inputName" class="form-control" name="name" placeholder="{{ __('app.contact.input-name') }}*" value="" required>
                            </div>
                            <div class="form-group">
                            <input type="tel" id="inputPhone" class="form-control" name="phone" placeholder="{{ __('app.contact.input-phone') }}*" value="" required>
                            </div>
                            <div class="form-group">
                                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="{{ __('app.contact.input-email') }}*" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                            </div>
                            <div class="form-group">
                                <textarea id="inputContent" class="form-control"  name="content" placeholder="{{ __('app.contact.input-content') }}*" required="" rows="5"></textarea>
                            </div>

                            <button type="submit" class="col-12 btn btn-primary btn-lienhe">{{ __('app.contact.btn-send-now') }}</button>
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
.contact-page {
  padding-top: 50px;
}

.contact-page .support-info .icon {
    width: 68px;
    height: 68px;
    margin: 0 auto 15px;

    border-radius: 50%;
    font-size: 24px;
    line-height: 68px;

    background: #000;
    color: #fff;
    }

.contact-page .support-info .content h4 {
    margin-bottom: 15px;
}

.contact-page .support-info .content span {
    font-family: "Roboto",sans-serif;
    font-size: 18px;
    line-height: normal;
    word-break: break-word;
}

.localtion-map {
    position:relative;
    text-align:right;
    min-height: 500px;
    height: 100%;
    overflow: hidden
}

.gmap-iframe {
    height: 500px;
    width: 100%;
}

.contact-form {
    position: relative;
}

.contact-form .row {
    margin: 0 auto;
    /* margin-top: -100px; */
    padding: 40px 70px;
    overflow: hidden;
}

.box-contact {
    padding: 40px 70px;
    background: #fff;
}

.contact-form h1 {
    margin: 0;
    padding: 0 0 15px;
    font-family: "Roboto",sans-serif;
    font-weight: 700;
    font-size: 24px;
    text-transform: uppercase;
    color: #232323;
}

.contact-form p {
    padding: 0 200px;
    margin-bottom: 60px;
    font-size: 15px;
    color: #666;
}

.contact-form .form-group input {
    height: 40px;
    margin-bottom: 30px;
    padding: 0px 15px;
    font-size: 14px;
    color: #232323;
    background: #fff;
    border: 1px solid #e1e1e1;
    border-radius: 3px;
}

.contact-form .form-group textarea {
    min-height: 100px;
    padding: 10px 15px;
    border-radius: 0 !important;
    resize: none;
    margin-bottom: 30px;
}

.contact-form button[type=submit] {
    font-family: "Roboto",sans-serif;
    border: 1px #cc2121 solid;
    background: #cc2121;
    color: #fff;
    font-size: 15px;
}

.contact-form .spinner-border {
    width: 1rem;
    height: 1rem;
}

@media (max-width: 991px) {
    .contact-form .row {
        padding: 0;
    }

    .box-contact {
        padding: 40px 10px;
    }

    .contact-form p {
        padding: 0px;
    }
}

.toast-wrapper {
    position: fixed;
    width: 50%;
    top: 60px;
    right: 0;
    z-index: 999;
    display: block;
}

.toast-wrapper .toast-list {
    position: absolute;
    top: 25px;
    right: 25px;
}

.toast-wrapper .toast {
    position: relative;
    max-width: 350px;
    top: 0px;
    padding: 5px 0;
    margin-bottom: 0.75em;
    text-align: left;
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 1px 7px 14px -5px rgb(0 0 0 / 20%);
    opacity: 1;
    display: block!important;
}

.toast-wrapper .toast:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.toast-wrapper .toast-success:before {
    background-color: #28a745;
}

.toast-wrapper .toast-warning:before {
    background-color: #ffc107;
}

.toast-wrapper .toast-icon .fa-check-circle {
    color: #28a745;
}

.toast-wrapper .toast-icon .fa-exclamation-circle {
    color: #ffc107;
}

.toast-wrapper .toast-icon {
    position: absolute;
    top: 50%;
    left: 20px;
    padding: 7px;
    font-size: 20px;
    transform: translateY(-50%);
}

.toast-wrapper .toast-content {
    padding-left: 70px;
    padding-right: 60px;
}

.toast-wrapper .toast-content .toast-type {
    margin-top: 0;
    margin-bottom: 8px;
    color: #3e3e3e;
    font-weight: 700;
}

.toast-wrapper .toast-content .toast-message {
    margin-top: 0;
    margin-bottom: 0;
    color: #878787;
}

.toast-wrapper .toast-close {
    position: absolute;
    right: 22px;
    top: 50%;
    width: 14px;
    cursor: pointer;
    fill: #878787;
    transform: translateY(-50%);
}
</style>
@endsection

@section('script-page')
<script type="text/javascript">
    // Hiden Submit button
    $( ".contact-form-inner" ).submit(function( event ) {
        $(':button[type="submit"]').prop('disabled', true);
        $('.btn-lienhe').html("<div class='spinner-border' role='status'></div>" + 
            "<span>{!! __('app.contact.sending') !!}</span>");
    });
</script>
@endsection
