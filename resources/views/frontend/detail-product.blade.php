@section('title-page')
    {{$productDetail->translation->seo_title ?? ($productDetail->translation->product_name ?? ($settings->translation->seo_title ?? 'SachCuQuanTam'))}}
@endsection

@section('seo')
    <meta name="description" content="{{ $productDetail->translation->seo_description ?? ($settings->translation->seo_description ?? '') }}">
    <meta name="keywords" content="{{$productDetail->translation->seo_keywords ?? ($settings->translation->seo_keywords ?? '') }}">
    <meta property="og:image" content="{{asset($productDetail->product_image ?? ($settings->logo ?? 'assets/images/favicon.ico'))}}" />
    <meta property="og:title" content="{{$productDetail->translation->seo_title ?? ($productDetail->translation->product_name ?? ($settings->translation->seo_title ?? 'SachCuQuanTam'))}}" />
    <meta property="og:site_name" content="{{$settings->translation->seo_title ?? 'SachCuQuanTam'}}" />
    <meta property="og:description" content="{{$productDetail->translation->seo_description ?? ($settings->translation->seo_description ?? '')}}" />
@endsection

@extends('frontend.layouts.master')
@section('content')
{{-- @include('frontend.layouts.banner', ['listBanner', array()]) --}}
<div class="detail-page">
    <div class="container">
        <div class="row detail-main">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                <div class="aside-policy">
                    <div class="item_poli clearfix">
                        <div class="icon_left">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="content_poli">
                            <p>{{ __('frontend.product_page_one') }}</p>
                        </div>
                    </div>
                    <div class="item_poli clearfix">
                        <div class="icon_left">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="content_poli">
                            <p>{{ __('frontend.product_page_two') }}</p>
                        </div>
                    </div>
                    <div class="item_poli clearfix">
                        <div class="icon_left">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="content_poli">
                            <p>{{ __('frontend.product_page_three') }}</p>
                        </div>
                    </div>
                    <div class="item_poli clearfix">
                        <div class="icon_left">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="content_poli">
                            <p>{{ __('frontend.product_page_four') }}</p>
                        </div>
                    </div>
                </div>
                <div class="product-favorite">
                    <div class="page-title">
                        <h2 class="title-head margin-top-0 cate"><span>{{__('frontend.related_products')}}</span></h2>
                    </div>
                    <div class="slick-vertical">
                        @php
                        $totalbox = ceil(count($productNear) / 3);
                        @endphp
                        @for($i = 1 ; $i <= $totalbox; $i++)
                        <div class="products-box">
                            @foreach($productNear as $index => $product)
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
                                        <button class="hidden-xs" title="{{ __('app.add-to-cart') }}" onclick="javascript:addProductToCart(this, {{$product->id}}, null),">
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
                <div class="banner-page">
                    <a href="javascript:void(0)" class="scale-img">
                        <img src="{{asset('frontend/assets/images/banner_product.jpg')}}">
                    </a>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                        <div class="wrapbb">
                            <div class="slider-big">
                                @php
                                    $arrImage = json_decode($productDetail->product_slides);
                                @endphp
                                @if(empty($arrImage))
                                <a href="javascript:void(0)" onclick="showDetailImage(this, 1, 1), onclickShowPopupDetail(this)" data-key-image="1">
                                    <img src="{{!empty($productDetail->product_image) ? asset($productDetail->product_image) : asset('assets/images/no-image.jpg')}}"  >
                                </a>
                                @else
                                    @foreach($arrImage as $key => $image)
                                    <a href="javascript:void(0)" onclick="showDetailImage(this, {{$key+1}}, {{count($arrImage) }}), onclickShowPopupDetail(this)" data-key-image="{{$key + 1}}">
                                        <img src="{{asset($image)}}" >
                                    </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="slider-small">
                                @php
                                    $arrImage = json_decode($productDetail->product_slides);
                                @endphp
                                @if(empty($arrImage))
                                <a href="javascript:void(0)">
                                    <img src="{{!empty($productDetail->product_image) ? asset($productDetail->product_image) : asset('assets/images/no-image.jpg')}}">
                                </a>
                                @else
                                    @foreach($arrImage as $image)
                                    <a href="javascript:void(0)">
                                        <img src="{{asset($image)}}">
                                    </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <div class="detail-info">
                            <div class="name">
                                <h1>{{$productDetail->translation->product_name}}</h1>
                            </div>
                            <div class="rate-star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="prices price-box">
                                @php
                                   echo showPricePromotionDetail($productDetail->price, $productDetail->promotion_price, $productDetail->promotion_start, $productDetail->promotion_end);
                                @endphp
                            </div>
                            <div class="input_number_product">
                                <span class="text-label">
                                    {{ __('frontend.number') }}
                                </span>
                                <div>                                   
                                    <a class="btn_num button_qty remove" onclick="javascript:eventNumberProduct(this, '#quantity-detail-{{$productDetail->id}}', '1')"><i class="fas fa-minus"></i></a>
                                    <input type="text" id="quantity-detail-{{$productDetail->id}}" name="quantity" value="1" maxlength="2" class="prd_quantity">
                                    <a class="btn_num button_qty add" onclick="javascript:eventNumberProduct(this, '#quantity-detail-{{$productDetail->id}}', '2')"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="btn-mua button_actions clearfix">
                                <button type="button" class="add_to_cart_detail" onclick="javascript:addProductToCart(this, {{$productDetail->id}}, '#quantity-detail-{{$productDetail->id}}')">
                                    {{__('frontend.add_to_cart')}}
                                </button>
                                <button type="button" class="buy_now" data-href="{{route('cart')}}" onclick="javascript:buyNowProduct(this, {{$productDetail->id}}, '#quantity-detail-{{$productDetail->id}}')">
                                    {{__('frontend.buy_now')}}
                                </button>
                            </div>
                            <div class="contact">Gọi đặt mua: <i class="fab fa-whatsapp"></i> <a href="tel:0829883388">0829883388</a> (8:00 - 22:00)</div>
                        </div>
                    </div>
                </div>
                <div class="detail-tab">
                    <div class="tab-h">
                        <h3 class="active">{{__('frontend.product_description')}}</h3>
                    </div>
                    <div class="tab-b">
                        <div class="tab-item">
                            <div class="tab-content" style="min-height: 500px;">
                                {!!$productDetail->translation->product_content!!}
                            </div>
                            <div id="top-tabs-info" class="">
                                <div class="product-anchor">
                                    <div class="img">
                                        <img src="{{asset($productDetail->product_image)}}">
                                    </div>
                                    <div class="info">
                                        <p class="name">{{$productDetail->translation->product_name}}</p>
                                        <div class="price">
                                            {{ __('frontend.price_sale') }}: @php
                                               echo showPricePromotion($productDetail->price, $productDetail->promotion_price, $productDetail->promotion_start, $productDetail->promotion_end);
                                            @endphp
                                        </div>
                                    </div>
                                    <div class="button-buy">
                                        <button type="button" data-href="{{route('cart')}}" onclick="javascript:buyNowProduct(this, {{$productDetail->id}}, '#quantity-detail-{{$productDetail->id}}')">
                                            <span class="text-main">{{ __('frontend.buy_now') }}</span>
                                            <br>
                                            <span>{{ __('frontend.detail_text') }}</span>
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-rate">
                    <div class="title">{{__('frontend.product_review')}}</div>
                    @if(count($productReview) < 1)
                    
                    <div class="content-noitem">
                        <p>{{__('frontend.product_reivew_des')}}</p>
                        <button type="button" id="button-rate" class="button-rate">
                            {{__('frontend.submit_your_review')}}
                        </button>
                    </div>
                    @else
                    @php
                        $starOne = 0;
                        $starTwo = 0;
                        $starThree = 0;
                        $starFour = 0;
                        $starFive = 0;
                        $totalRating = 0;
                        $totalPoint = 0;
                        foreach($productReview as $key => $value)
                        {
                            if($value->reply_id == 0)
                            {
                                $totalRating++;
                                $totalPoint = $totalPoint + $value->score;
                                if($value->score == 1)
                                {
                                    $starOne++;
                                }
                                if($value->score == 2)
                                {
                                    $starTwo++;
                                }
                                if($value->score == 3)
                                {
                                    $starThree++;
                                }
                                if($value->score == 4)
                                {
                                    $starFour++;
                                }
                                if($value->score == 5)
                                {
                                    $starFive++;
                                }
                            }
                        }
                    @endphp
                    <div class="content-rate">
                        <div class="content-left">
                            <div class="rating">{{ number_format($totalPoint/$totalRating, 1, '.', '.') }}/5</div>
                            <div class="group-star-in">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star {{$i <=  ceil($totalPoint/$totalRating)? 'active' : ''}}"></i>
                                @endfor
                            </div>
                            <div class="total-rating">
                                ({{$totalRating}})
                            </div>
                            <div id="button-rate" style="margin-top: 10px;">
                                <button type="button" id="button-rate" class="button-rate">
                                    {{__('frontend.submit_your_review')}}
                                </button>
                            </div>
                        </div>
                        <div class="content-right">
                            <div>
                                <button type="button" class="active">Tất cả</button>
                                <button type="button">5 Điểm({{ $starFive }})</button>
                                <button type="button">4 Điểm({{ $starFour }})</button>
                                <button type="button">3 Điểm({{ $starThree }})</button>
                                <button type="button">2 Điểm({{ $starTwo }})</button>
                                <button type="button">1 Điểm({{ $starOne }})</button>
                                <button type="button">Có Hình Ảnh</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-rating">
                        @foreach($productReview as $key => $value)
                        @if($value->reply_id == 0)
                        <div class="item">
                            <div class="customer-name">
                                <b>{{$value->name}}</b>
                                <span class="group-star-in">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{$i <= $value->score ? 'active' : ''}}"></i>
                                    @endfor
                                </span>
                            </div>
                            <div class="content-des">
                                {!! nl2br($value->review_content) !!}
                            </div>
                            <div class="actions-comment">
                                <i>{{ date('H:i m/d/Y', strtotime($value->created_at)) }}</i>
                            </div>
                            <div class="images-comment">
                                @php
                                    $arrImage = json_decode($value->file);
                                @endphp
                                @foreach($arrImage as $keyImage => $valueImage)
                                <img src="{{asset('storage/'.$valueImage)}}">
                                @endforeach
                            </div>
                            <div class="group-item-re">
                                @if(count($value->child) > 0)
                                    @foreach($value->child as $reply)
                                    <div class="item">
                                        <div class="customer-name">
                                            {{ $reply->name }}
                                            <span class="qt">@lang('frontend.layouts.admin')</span>
                                        </div>
                                        <div class="content-des">
                                            {!! nl2br($reply->review_content) !!}
                                        </div>
                                        <div class="actions-comment">
                                            <i>{{ date('H:i m/d/Y', strtotime($reply->created_at)) }}</i>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="product-like">
                    <div class="page-title">
                        <h2 class="title-head">{{__('frontend.favorite_product_u')}}</h2>
                    </div>
                    <div class="list-like">
                        <div id="slick-like">
                            @foreach($productsFavorite as $key => $product)
                            <div class="product-item">
                                <div class="img ">
                                    <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}">
                                        <img src="{{!empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg')}}">
                                    </a>
                                    @php
                                        $time = date('Y-m-d');
                                        if($product->promotion_price != null)
                                            if( $time >= $product->promotion_start && $time <= $product->promotion_end)
                                            echo '<span class="sale"></span>';
                                    @endphp
                                    <button class="add-to-cart hover-imagecategory" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                        {{ __('app.add-to-cart') }}
                                    </button>
                                    <div class="actions">
                                        <a href="" class="detail-product-show hover-imagecategory"><i class="fa fa-search" onclick="javascript:showPopupDetail(this, {{$product->id}})"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup-rate">
    <form method="post" action="{{route('rate')}}" id="formrate">
        {{ csrf_field() }}
        <input type="hidden" name="product_id" value="{{$productDetail->id}}">
        <div class="popup-content">
            <button class="close-popup-rate" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                    <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"></path>
                </svg>
            </button>
            <div class="title">
                {{__('frontend.rate_product')}}
            </div>
            <div class="review-product-name">
                {{$product->translation->product_name}}
            </div>
            <div class="content-star mt-3">
                <span>
                    {{ __('frontend.text_review_one') }}:
                </span>
                <span class="group-star">
                    <i class="fa fa-star active" data-i = "1"></i>
                    <i class="fa fa-star active" data-i = "2"></i>
                    <i class="fa fa-star active" data-i = "3"></i>
                    <i class="fa fa-star active" data-i = "4"></i>
                    <i class="fa fa-star active" data-i = "5"></i>
                    <input type="hidden" value="5" name="valuestart">
                </span>
            </div>
            <div class="mt-4">
                <input type="text" class="form-control" name="fullname" placeholder="{{__('frontend.your_full_name')}}">
                <div id="error-fullname" style="color: red; display: none; text-align: left">{{__('frontend.your_full_name')}}</div>
            </div>
            <div class="group-content-text">
                <textarea placeholder="Nhập nội dung đánh giá của bạn về sản phẩm" name="content"></textarea>
                <div id="error-content" style="color: red; display: none; text-align: left;">{{__('frontend.your_review')}}</div>
                <div class="group-file">
                    <input type="file" name="" onchange="addImageToRate(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path d="M 4 5 C 2.895 5 2 5.895 2 7 L 2 23 C 2 24.105 2.895 25 4 25 L 14.230469 25 C 14.083469 24.356 14 23.688 14 23 C 14 22.662 14.021594 22.329 14.058594 22 L 5 22 L 5 15 L 7.2890625 12.710938 C 8.2340625 11.765937 9.7659375 11.765937 10.710938 12.710938 L 15.720703 17.720703 C 17.356703 15.469703 20.004 14 23 14 C 24.851 14 26.57 14.559578 28 15.517578 L 28 7 C 28 5.895 27.105 5 26 5 L 4 5 z M 23 8 C 24.105 8 25 8.895 25 10 C 25 11.105 24.105 12 23 12 C 21.895 12 21 11.105 21 10 C 21 8.895 21.895 8 23 8 z M 23 16 C 19.134 16 16 19.134 16 23 C 16 26.866 19.134 30 23 30 C 26.866 30 30 26.866 30 23 C 30 19.134 26.866 16 23 16 z M 23 19 C 23.552 19 24 19.447 24 20 L 24 22 L 26 22 C 26.552 22 27 22.447 27 23 C 27 23.553 26.552 24 26 24 L 24 24 L 24 26 C 24 26.553 23.552 27 23 27 C 22.448 27 22 26.553 22 26 L 22 24 L 20 24 C 19.448 24 19 23.553 19 23 C 19 22.447 19.448 22 20 22 L 22 22 L 22 20 C 22 19.447 22.448 19 23 19 z"></path></svg>
                    <span>  {{ __('frontend.text_review_2') }}</span>
                </div>
            </div>
            <div class="multi-image">
            </div>
            <div class="error" style="color: red; text-align: left;"></div>
            <div class="popup-rate-submit" style="margin-top: 15px;">
                <button type="submit" id="submit-rate">{{ __('frontend.text_review_3') }}</button>
            </div>
        </div>
    </form>
</div>
<div class="popup-zoom" style="display: none !important;">
    <button class="close-zoom">
        <img src="{{asset('frontend/assets/images/closebtn.png')}}">
    </button>
    <div class="show-img" style="">
        <img src="" style="pointer-events: none; min-width: 500px;">
    </div>
    <div class="list-actions">
        <button class="btn-prev"></button>
        <button class="btn-zoom"></button>
        <button class="btn-next"></button>
    </div>
</div>
<div class="popup-detail">
    <button class="close-popup" onclick="onclickClosePopupDetail(this)">
        
    </button>
    <div class="content">
        <div class="content-left">
            <button class="arrow-prev arrow" type="button" onclick="onclickNextPrevDetailProduct(this, 1)">
                <svg enable-background="new 0 0 13 20" viewBox="0 0 13 20" x="0" y="0" class="shopee-svg-icon icon-arrow-left-bold"><polygon points="4.2 10 12.1 2.1 10 -.1 1 8.9 -.1 10 1 11 10 20 12.1 17.9"></polygon></svg>
            </button>
            <button class="arrow-next arrow" type="button" onclick="onclickNextPrevDetailProduct(this, 2)">
                <svg enable-background="new 0 0 13 21" viewBox="0 0 13 21" x="0" y="0" class="shopee-svg-icon icon-arrow-right-bold"><polygon points="11.1 9.9 2.1 .9 -.1 3.1 7.9 11 -.1 18.9 2.1 21 11.1 12 12.1 11"></polygon></svg>
            </button>
            @php
                $arrImage = json_decode($productDetail->product_slides);
            @endphp
            @if(empty($arrImage))
            <div class="img-big" style="background-image: url('{{asset($productDetail->product_image)}}')">
            </div>
            @else
                @foreach($arrImage as $key => $image)
                    @if($key == 0)
                    <div class="img-big" style="background-image: url('{{asset($image)}}')">
                    </div>
                    @endif
                @endforeach
            @endif
            
        </div>
        <div class="content-right">
            <div class="product-name">
                {{$productDetail->translation->product_name}}
            </div>
            <div class="list-image">
                @php
                $arrImage = json_decode($productDetail->product_slides);
                @endphp
                @if(empty($arrImage))
                <button class="item active" data-item="1" onclick="onclickDetailProduct(this)">
                    <img src="{{!empty($productDetail->product_image) ? asset($productDetail->product_image) : asset('assets/images/no-image.jpg')}}">
                </button>
                @else
                    @foreach($arrImage as $key => $image)
                        <button class="item {{$key == 0 ? 'active' : ''}}" data-item="{{$key+1}}" onclick="onclickDetailProduct(this)">
                            <img src="{{asset($image)}}">
                        </button>
                    @endforeach
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('css-page')
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
@section('script-page')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 100000000,
            values: [ 0, 100000000 ],
            slide: function( event, ui ) {
                $('#start input').val(ui.values[ 0 ].toLocaleString('vi', {style : 'currency', currency : 'VND'}));
                $('#end input').val(ui.values[ 1 ].toLocaleString('vi', {style : 'currency', currency : 'VND'}));
            }
        });
      } );
    $('#button-rate').click(function(){
        $('.popup-rate').addClass('active');
    });
    $('.close-popup-rate').click(function(){
        $('.popup-rate').removeClass('active');
    });
    $('.group-star i').mousemove(function(){
        var value = $(this).attr('data-i');
        $('input[name="valuestart"]').val(value);
        $('.group-star i').removeClass('active');
        for( var i = 1; i <= value; i++)
        {
            $('.group-star i:nth-child('+i+')').addClass('active');
        }
    });
    function addImageToRate(input)
    {
        var img =  '';
        for(var i = 0; i< input.files.length; i++){
            if (input.files[i]) {
                if(input.files[i].size > 1024 * 1024)
                {
                    $('.popup-rate .error').html('Kích thước tối đa 1MB');
                }
                else
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        if($('.multi-image .item').length < 3)
                        {
                            $('.multi-image').append(''+
                                '<div class="item">'+
                                '<span class="remove" onclick="javascript:removeItemImage(this)">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30px" height="30px"><path d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M16.414,15 c0,0,3.139,3.139,3.293,3.293c0.391,0.391,0.391,1.024,0,1.414c-0.391,0.391-1.024,0.391-1.414,0C18.139,19.554,15,16.414,15,16.414 s-3.139,3.139-3.293,3.293c-0.391,0.391-1.024,0.391-1.414,0c-0.391-0.391-0.391-1.024,0-1.414C10.446,18.139,13.586,15,13.586,15 s-3.139-3.139-3.293-3.293c-0.391-0.391-0.391-1.024,0-1.414c0.391-0.391,1.024-0.391,1.414,0C11.861,10.446,15,13.586,15,13.586 s3.139-3.139,3.293-3.293c0.391-0.391,1.024-0.391,1.414,0c0.391,0.391,0.391,1.024,0,1.414C19.554,11.861,16.414,15,16.414,15z"></path></svg>'+
                                '</span>'+
                                '<img src="'+e.target.result+'">'+
                                '<input type="hidden" name="image[]" value="'+e.target.result+'">'+
                            '</div>'+
                                '');
                        }
                        else
                        {
                            console.log('Đã quá 3 hình');
                        }
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
        $(input).val('');
    }
    function removeItemImage(e)
    {
        $(e).parent().remove();
    }
    $('#submit-rate').click(function(e){
        e.preventDefault();
        var flag = true;
        if($('input[name="fullname"]').val() =="" || $('textarea[name="content"]').val() == "")
        {
            flag = false;
        }
        if($('input[name="fullname"]').val() =="")
        {
            $('#error-fullname').css('display', 'block');
        }
        if($('textarea[name="content"]').val() =="")
        {
            $('#error-content').css('display', 'block');
        }
        if(flag == true)
            $('#formrate').submit();

    });
    $('.close-zoom').click(function(){
        $('.popup-zoom').removeClass('active');
    })
    $('.btn-zoom').click(function(){
        if($(this).hasClass('active'))
        {
            $(this).removeClass('active');
            $('.show-img').removeClass('zoomx2');
        }
        else
        {
            $('.show-img').addClass('zoomx2');
            $(this).addClass('active');
        }
    });
    var flag = false;
    $('.show-img').on('mousedown', function(evtS){
        flag = true;
        
        var positionY = $('.show-img').position().top;
        var positionX = $('.show-img').position().left;
        var end = evtS.clientX;
        var star = evtS.clientY;
        $('.popup-zoom').on('mousemove', function(evt){
            var clientY = evt.clientY;
            var clientX = evt.clientX;
            if(flag == true)
            {
                $('.show-img').css('transform', 'translate3d('+ -(end - positionX) +'px, '+ -(star - positionY) +'px, 0)');
                $('.show-img').css('top', clientY);
                $('.show-img').css('left', clientX);
            }
        })
    }).on('mouseup', function(){
        flag = false;
    });
    var activeImage = 1;
    var totalImage = 0;
    function showDetailImage(e, key, total)
    {
        $('.popup-zoom').addClass('active');
       
        activeImage = key;
        totalImage = total;
        var img = $('a[data-key-image="'+activeImage+'"]').find('img').clone();
        $('.popup-zoom .show-img').attr('style', "");
        $('.popup-zoom .show-img').html(img);
        var width = $('.popup-zoom .show-img img').width();
        $('.popup-zoom .show-img').css('width', width);
    }
    $('.btn-prev').click(function(){
        if(activeImage <= 1)
        {
            activeImage = 1;
        }
        else
        {
            activeImage = activeImage - 1;
            var img = $('a[data-key-image="'+activeImage+'"]').find('img').clone();
            $('.popup-zoom .show-img').attr('style', "");
            $('.popup-zoom .show-img').html(img);
            var width = $('.popup-zoom .show-img img').width();
            $('.popup-zoom .show-img').css('width', width);
        }
    });
    $('.btn-next').click(function(){
        if(activeImage  >= totalImage)
        {
            activeImage = totalImage;
        }
        else
        {
            activeImage = activeImage + 1;
            var img = $('a[data-key-image="'+activeImage+'"]').find('img').clone();
            $('.popup-zoom .show-img').attr('style', "");
            $('.popup-zoom .show-img').html(img);
            var width = $('.popup-zoom .show-img img').width();
            $('.popup-zoom .show-img').css('width', width);
        }
    });


    function onclickShowPopupDetail(e)
    {
        $('.popup-detail').addClass('active');
    }

    function onclickClosePopupDetail(e)
    {
        $('.popup-detail').removeClass('active');
    }
    function onclickDetailProduct(e)
    {
        var img = "url('" + $(e).find('img').attr('src') + "')";
        $('.popup-detail .list-image .item').removeClass('active');
        $(e).addClass('active');
        $('.popup-detail .img-big').css('background-image', img);
    }
    function onclickNextPrevDetailProduct(e, type)
    {
        var total = $('.popup-detail .list-image .item').length;
        var active = parseInt($('.popup-detail .list-image .item.active').attr('data-item'));
        $('.popup-detail .list-image .item').removeClass('active');
        if(type == 1)
        {
            
            if(  active == 1 )
            {
                $('.popup-detail .list-image .item:last-of-type').addClass('active');
            }
            else
            {
                $('.popup-detail .list-image .item[data-item="'+(active - 1)+'"]').addClass('active');
            }
        }

        if(type == 2)
        {
            if(  active == total )
            {
                $('.popup-detail .list-image .item:first-child').addClass('active');
            }
            else
            {
                $('.popup-detail .list-image .item[data-item="'+(active + 1)+'"]').addClass('active');
            }
        }
        $('.popup-detail .img-big').css('background-image', "url('" + $('.popup-detail .list-image .item.active img').attr('src') +"')" );
    }
</script>
@endsection