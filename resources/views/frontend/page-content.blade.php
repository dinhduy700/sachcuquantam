@section('title-page')
	{{$page->translation->page_title}}
@endsection
@section('seo')
    <meta name="description" content="{{$page->translation->seo_description}}">
    <meta name="keywords" content="{{$settings->translation->seo_keywords}}">
    <meta property="og:title" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:description" content="{{$settings->translation->seo_description ?? ''}}" />
    <meta property="og:image" content="{{asset($settings->logo ?? 'assets/images/favicon.ico')}}" />
@endsection
@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.banner', ['listBanner', array()])
<div class="detail-page">
    <div class="container">
        {!!$page->translation->page_content!!}
    </div>
</div>
@endsection
