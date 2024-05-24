@section('title-page')
    {{ 'video' }}
@endsection
@section('seo')
    <meta name="description" content="{{$settings->translation->seo_description}}">
    <meta name="keywords" content="{{$settings->translation->seo_keywords}}">
    <meta property="og:title" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:description" content="{{$settings->translation->seo_description ?? ''}}" />
    <meta property="og:image" content="{{asset($settings->logo ?? 'assets/images/favicon.ico')}}" />
@endsection
@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.banner', ['listBanner' => $banners])
<div class="video-page">
    <div class="container">
        <div class="row">
            @foreach($videos as $video)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="item">
                    <div class="img">
                        <a href="{{$video->translation->video_link}}" data-fancybox data-href="{{$video->translation->video_link}}">
                            <img src="{{asset($video->video_image)}}">
                            <img src="{{asset('frontend/assets/images/youtube1.png')}}" class="icon">
                        </a>
                    </div>
                    <div class="title">
                        <h3>
                            {{ $video->translation->video_title }}
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
            @if(count($videos) < 1)
            <div class="alert alert-danger">
                Không tìm thấy video nào cho bạn
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('css-page')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" type="text/css" media="screen" />
@endsection
@section('script-page')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
@endsection