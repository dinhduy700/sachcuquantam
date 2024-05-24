@section('title-page')
    {{$settings->translation->seo_title ?? ''}}
@endsection
@section('seo')
    <meta name="description" content="{{$settings->translation->seo_description ?? ''}}">
    <meta name="keywords" content="{{$settings->translation->seo_keywords ?? ''}}">
    <meta property="og:image" content="{{asset($settings->logo ?? 'assets/images/favicon.ico')}}" />
    <meta property="og:title" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? ''}}" />
    <meta property="og:description" content="{{$settings->translation->seo_description ?? ''}}" />
@endsection
@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.banner', ['listBanner', array()])
<div class="cart-page">
    <div class="container">
        <div class="content-cart">
            @if(Session::has('cart'))
            <h1 class="title_cart">
                <span>{{ __('frontend.my_cart') }}</span>
            </h1>
            
            <div class="list-cart">
                <div class="cart-head"></div>
                <div class="cart-body">
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach(Session::get('cart')['data'] as $key => $value)
                    <div class="item data-product-item-{{$value['info']->id}}">
                        <div class="img">
                            <a href="" class="scale-img">
                                <img src="{{!empty($value['info']->product_image) ? asset($value['info']->product_image) : asset('assets/images/no-image.jpg')}}">
                            </a>
                        </div>
                        <div class="info">
                            <p class="name"><a href="">{{ $value['info']->translation->product_name }}</a></p>
                            <p class="price">
                                @php
                                    $price = 0;
                                    $time = date('Y-m-d');
                                    if($value['info']->promotion_price != null)
                                        if( $time >= $value['info']->promotion_start && $time <= $value['info']->promotion_end)
                                            $price = $value['info']->promotion_price;
                                        else
                                        $price = $value['info']->price;
                                    else
                                    {
                                        $price = $value['info']->price;
                                    }
                                    $totalPrice = $totalPrice + $price * $value['totalProduct'];
                                @endphp
                                {{number_format($price, 0, '', '.')}}₫
                            </p>
                        </div>
                        <div class="number">
                            <div class="input_qty_pr">
                                <input class="variantID" type="hidden" name="variantId" value="57988879">
                                <input type="text" class="quantity-detail-cart-{{$value['info']->id}}" maxlength="3" readonly="" min="0" class="" id="qtyItem57988879" name="Lines" size="4" value="{{ $value['totalProduct'] }}">
                                <button  class="increase_pop items-count btn-plus" type="button" onclick="javascript:eventNumberProductActive(this, '.quantity-detail-cart-{{$value["info"]->id}}', '2', {{$value['info']->id}})"><i class="fas fa-plus-circle"></i></button>
                                <button  class="reduced_pop items-count btn-minus" type="button" onclick="javascript:eventNumberProductActive(this, '.quantity-detail-cart-{{$value["info"]->id}}', '1', {{$value['info']->id}})"><i class="fas fa-minus-circle"></i></button>
                            </div>
                        </div>
                        <div class="total total-price-product-{{$value['info']->id}}" >
                            {{ number_format($price * $value['totalProduct'], 0, '', '.') }}₫
                        </div>
                        <div class="btns">
                            <a href="javascript:void(0)" onclick="javascript:removeProductToCart(this, {{$value["info"]->id}})"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="cart-foot">
                    <div class="content">
                        <div class="top">
                            <div>{{ __('frontend.order_total') }}</div>
                            <div class="price total-price" >{{number_format($totalPrice, 0, '', '.')}}₫</div>
                        </div>
                        <div class="bot">
                            <a href="{{route('category-all')}}"><i class="fas fa-reply"></i> {{ __('frontend.continue_shopping') }}</a>
                            <a href="{{route('checkout')}}"><i class="fas fa-share"></i> {{ __('frontend.checkout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="content-cart-no-item" style="display: {{!Session::has('cart') ? 'block' :'none'}}">
            <div class="alert alert-warning">{{ __('frontend.cart_empty') }}</div>
        </div>
    </div>
</div>
@endsection