@section('title-page')
    {{ __('app.search-page.title') }}
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

<div class="search-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title-search">{{ __('app.search-page.record-found', ['name' => $products->total()]) }}</h1>
            </div>

            <div class="category-products col-12">
                @if(count($products) > 0)
                <div class="row">
                    @foreach($products as $key => $product)
                        <div class="product-item col-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 product-col">
                            <div class="img">
                                <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}">
                                    <img src="{{!empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg')}}">
                                </a>
                                <span class="sale"></span>
                                <button type="button" class="add-to-cart hover-imagecategory" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                    {{ __('app.add-to-cart') }}
                                </button>
                                <div class="actions">
                                    <a href="" class="detail-product-show hover-imagecategory" onclick="javascript:showPopupDetail(this, {{$product->id}})"><i class="fa fa-search" ></i></a>
                                </div>
                            </div>

                            <div class="info">
                                <div class="product-name">
                                    <h4>
                                        <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}" title="{{$product->translation->product_name}}">{{$product->translation->product_name}}</a>
                                    </h4>
                                </div>
                                <div class="product-price">
                                    @php
                                        echo showPricePromotion($product->price, $product->promotion_price, $product->promotion_start, $product->promotion_end);
                                    @endphp
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="section pagenav clearfix a-center">
                    <nav class="clearfix relative nav-pagi">
                        {{ $products->links('vendor.pagination.bootstrap-4') }}
                    </nav>  
                </div>
                @endif
            </div>

            <div class="col-12">

            </div>
        </div>
    </div>
</div>

@include('frontend.component.input-contact', ['setting' => $setting])
@endsection

@section('css-page')
<style>
.title-search {
    font-family: "Roboto",sans-serif;
    text-transform: none;
    font-size: 24px;
    margin: 15px 0;
}
</style>
@endsection

