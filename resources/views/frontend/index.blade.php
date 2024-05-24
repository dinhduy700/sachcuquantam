@section('title-page')
    {{$settings->translation->seo_title ?? ''}}
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
@include('frontend.layouts.banner', ['banners' => $banners])
<div class="promotions">
    <div class="container">
        <div class="list-promotion">
            <div class="row">
                @foreach($bannerAdvertisements as $key => $value)
                <div class="item col-xl-4 col-lg-4 col-md-4 col-12">
                    <a href="{{$value->translation->banner_link}}">
                        <img src="{{asset($value->translation->banner_image)}}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@php
    if(!empty($bannerTopCategory))
    {
        $css = "background-image: url('".$bannerTopCategory->translation->banner_image."')";
    }
    else
    {
        $css = "";
    }
@endphp
<div class="top-category" style="{{$css}}">
    <div class="container">
        <div class="content">
            <div class="content-l">
                <div class="title">
                    <h2>{{__('frontend.top_category_product')}}</h2>
                </div>
                <div class="des">
                    <p>
                        @if(!empty($bannerTopCategory))
                            {{ $bannerTopCategory->translation->banner_content }}
                        @else
                            {{__('frontend.top_des')}}
                        @endif
                    </p>
                </div>
            </div>
            <div class="content-r" style="overflow: hidden;">
                <div class="list">
                    <div id="slick-category">
                        @foreach($categoriesTop as $key => $category)
                        <div class="item">
                            <div class="img">
                                <a href="{{url('/collections/'.$category->translation->product_category_slug)}}">
                                    <img src="{{asset($category->image)}}">
                                </a>
                            </div>
                            <div class="name">
                                <h4>
                                    <a href="{{url('/collections/'.$category->translation->product_category_slug)}}">{{$category->translation->product_category_name}}</a>
                                </h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-special">
    <div class="container">
        <div class="content">
            <div class="title-tab">
                <h2>{{__('frontend.hot_product')}}</h2>
            </div>
            <p class="title_small hidden-xs">
                {{ __('frontend.hot_product_des') }}
            </p>
            <div class="navbar-tab">
                <div class="btn-nav">
                    <i class="fas fa-bars"></i>
                </div>
                <input type="checkbox" name="">
                <div class="list-tab">
                    <button type="button" class="active item" data-type="1" data-element-id="latest">{{__('frontend.new_product')}}</button>
                    <button type="button" class="item" data-type="2" data-element-id="promotion">{{__('frontend.promotion_product')}}</button>
                    <button type="button" class="item" data-type="3" data-element-id="featured">{{__('frontend.hot_product_s')}}</button>
                </div>
            </div>
            <div class="tab-show">
                <div class="list">
                    <div id="latest" class="hasactive">
                        <div class="slick-special" >
                            @foreach($productLatest as $index => $product)
                            @if($index < 4)
                            <div class="product-item">
                                <div class="img ">
                                    <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}">
                                        <img src="{{ !empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg') }}">
                                    </a>
                                    @php
                                        $time = date('Y-m-d');
                                        if($product->promotion_price != null)
                                            if( $time >= $product->promotion_start && $time <= $product->promotion_end)
                                            echo '<span class="sale"></span>';
                                    @endphp
                                    <button class="add-to-cart hover-imagecategory" type="button" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                        {{__('frontend.add_to_cart')}}
                                    </button>
                                    <div class="actions">
                                        <a href="" onclick="javascript:showPopupDetail(this, {{$product->id}})" class="detail-product-show hover-imagecategory"><i class="fa fa-search"></i></a>
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
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="promotion"></div>
                    <div id="featured"></div>
                    <div class="gif-ajax" style="display: none">
                        <img src="{{asset('frontend/assets/images/ajax_loader_red_128.gif')}}">
                    </div>
                </div>
                <div class="btn-viewmore-mb">
                    <a class="btn btn-primary-xt" href="{{route('new-products')}}" title="{{__('frontend.title_view_more')}}">{{__('frontend.view_more')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty($bannerEvents))
    @foreach($bannerEvents as $key => $value)
        @if($loop->last)
        <div class="banner-img">
            <a href="{{$value->translation->banner_link}}">
                <img src="{{asset($value->translation->banner_image)}}">
            </a>
        </div>
        @endif
    @endforeach
@endif

<div class="product-multi">
    <div class="container">
        <div class="row">
            <div class=" col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 xs-margin-bottom-20">
                <div class="item-box">
                    <div class="title_module_1">
                        <h2><a href="{{route('new-products')}}" title="{{__('frontend.new_products')}}">{{__('frontend.new_products')}}</a></h2>
                    </div>
                    <div class="slick-vertical">
                        @php
                            $totalbox = ceil(count($productLatest) / 3);
                        @endphp
                        @for($i = 1 ; $i <= $totalbox; $i++)
                        <div class="products-box">
                            @foreach($productLatest as $index => $product)
                            @if($index < $i * 3 && $index >= ($i - 1) * 3)
                            <div class="item">
                                <div class="img">
                                    <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}"><img src="{{ !empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg') }}"></a>
                                </div>
                                <div class="info">
                                    <h3 class="product-name"><a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}" title="" tabindex="0">{{$product->translation->product_name}}</a></h3>
                                    <div class="product-price">
                                       <!--  6.395.000₫
                                        <span class="compare-price">9.990.000₫</span> -->
                                        @php
                                           echo showPricePromotion($product->price, $product->promotion_price, $product->promotion_start, $product->promotion_end);
                                        @endphp
                                    </div>
                                    <div class="actions">
                                        <button class="hidden-xs" title="{{ __('app.add-to-cart') }}" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                            <i class="fas fa-shopping-basket iconcart"></i>
                                        </button>
                                        <a title="Xem nhanh" href="javascript:void(0)" class="btn hidden-xs hidden-sm hidden-md" onclick="javascript:showPopupDetail(this, {{$product->id}})">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 xs-margin-bottom-20">
                <div class="item-box">
                    <div class="title_module_1">
                        <h2><a href="{{route('best-seller')}}" title="{{__('frontend.best_seller')}}">{{__('frontend.best_seller')}}</a></h2>
                    </div>
                    <div class="slick-vertical">
                        @php
                            $totalbox = ceil(count($productSelling) / 3);
                        @endphp
                        @for($i = 1 ; $i <= $totalbox; $i++)
                        <div class="products-box">
                            @foreach($productSelling as $index => $product)
                            @if($index < $i * 3 && $index >= ($i - 1) * 3)
                            <div class="item">
                                <div class="img">
                                    <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}"><img src="{{!empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg')}}"></a>
                                </div>
                                <div class="info">
                                    <h3 class="product-name"><a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}" title="" tabindex="0">{{$product->translation->product_name}}</a></h3>
                                    <div class="product-price">
                                       <!--  6.395.000₫
                                        <span class="compare-price">9.990.000₫</span> -->
                                        @php
                                           echo showPricePromotion($product->price, $product->promotion_price, $product->promotion_start, $product->promotion_end);
                                        @endphp
                                    </div>
                                    <div class="actions">
                                        <button class="hidden-xs" title="{{ __('app.add-to-cart') }}" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                            <i class="fas fa-shopping-basket iconcart"></i>
                                        </button>
                                        <a title="Xem nhanh" href="javascript:void(0)" class="btn hidden-xs hidden-sm hidden-md" onclick="javascript:showPopupDetail(this, {{$product->id}})">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class=" col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 xs-margin-bottom-20">
                <div class="item-box">
                    <div class="title_module_1">
                        <h2><a href="{{route('sale-off')}}" title="{{__('frontend.sale_off')}}">{{__('frontend.sale_off')}}</a></h2>
                    </div>
                    <div class="slick-vertical">
                        @php
                            $totalbox = ceil(count($productPromotion) / 3);
                        @endphp
                        @for($i = 1 ; $i <= $totalbox; $i++)
                        <div class="products-box">
                            @foreach($productPromotion as $index => $product)
                            @if($index < $i * 3 && $index >= ($i - 1) * 3)
                            <div class="item">
                                <div class="img">
                                    <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}"><img src="{{!empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg')}}"></a>
                                </div>
                                <div class="info">
                                    <h3 class="product-name"><a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}" title="" tabindex="0">{{$product->translation->product_name}}</a></h3>
                                    <div class="product-price">
                                       <!--  6.395.000₫
                                        <span class="compare-price">9.990.000₫</span> -->
                                        @php
                                           echo showPricePromotion($product->price, $product->promotion_price, $product->promotion_start, $product->promotion_end);
                                        @endphp
                                    </div>
                                    <div class="actions">
                                        <button class="hidden-xs" title="{{__('frontend.add_to_cart')}}" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                            <i class="fas fa-shopping-basket iconcart"></i>
                                        </button>
                                        <a title="Xem nhanh" href="javascript:void(0)" class="btn hidden-xs hidden-sm hidden-md" onclick="javascript:showPopupDetail(this, {{$product->id}})">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="news-special">
    <div class="container">
        <div class="title-tab">
            <h2>{{__('frontend.featured_news')}}</h2>
        </div>
        <p class="title_small hidden-xs">
            {{__('frontend.featured_news_des')}}
        </p>
        <div class="list-news">
            <div class="row">
                @foreach($news as $item)
                <div class="col-xl-4 col-lg-4 col-md-4 col-9 item">
                    <div class="img">
                        <a href="{{route('news').'/'. $item->translation->news_slug}}">
                            <img src="{{asset($item->news_image)}}">
                        </a>
                    </div>
                    <div class="content">
                        <div class="title">
                            <h3>
                                <a href="{{route('news').'/'. $item->translation->news_slug}}" title="{{$item->translation->news_title}}">{{$item->translation->news_title}}</a>
                            </h3>
                        </div>
                        <div class="des">
                            <p>
                                {{$item->translation->news_description}}
                                <a href="{{route('news').'/'. $item->translation->news_slug}}" title="{{$item->translation->news_title}}" class="view-more" title="Đọc tiếp">[{{__('frontend.read_more')}}]</a>            
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="group-subcribe">
    <div class="container">
        <div class="main">
            <div class="hidden-xs first-img">
                <a href="" class="img-scale">
                    <img src="{{asset('frontend/assets/images/banner_mail.jpg')}}">
                </a>
            </div>
            <div class="first-email">
                <div class="mail_footer subscribe">
                    <div class="right_title heading a-center">
                        <h2>
                            {{__('frontend.subscribes')}}
                        </h2>
                        <p>
                            {{__('frontend.subscribes_des')}}
                        </p>
                    </div>
                    <form id="mc-form" method="post" action="{{route('send.email')}}" class="newsletter-form" data-toggle="validator" novalidate="true">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <div>
                            <div class="groupiput">
                                <input aria-label="Địa chỉ Email" type="email" placeholder="{{__('frontend.your_email')}}" name="email" required autocomplete="off">
                            </div>
                            <span class="input-group-append">
                                <button class="btn" type="submit" aria-label="Đăng ký nhận tin">{{__('frontend.send_email')}}</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section_brand">
    <div class="container">
        <div class="row">
            @foreach($partners as $key => $partner)
            <div class="col-xl-2 col-lg-2 col-md-4 col-6">
                <a class="scale_hover" @if(!empty($partner->link)) href="{{ $partner->link }}" @endif target="blank">
                    <img src="{{asset($partner->logo)}}" >
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection