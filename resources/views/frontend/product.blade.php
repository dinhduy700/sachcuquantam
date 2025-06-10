@section('title-page')
Tất cả sản phẩm
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
{{-- @include('frontend.layouts.banner', ['listBanner', array()]) --}}
<div class="product-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                <input type="checkbox" id="checkbox-cl-mb">
                <div class="content-left">
                    <div class="sidebar-category">
                        <div class="page-title">
                            <h2 class="title-head margin-top-0 cate"><span>{{ __('frontend.product_category') }}</span></h2>
                        </div>
                        <nav class="nav-category navbar-toggleable-md">
                            <ul class="nav navbar-pills">
                                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">{{__('frontend.home')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="/gioi-thieu">{{__('frontend.introduce')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('category-all')}}">{{__('frontend.product')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('video')}}">{{__('frontend.video')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('news')}}">{{__('frontend.news')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('contact.index')}}">{{__('frontend.contact')}}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <form method="get" id="formcategory">
                        <div class="filter">
                            <div class="page-title">
                                <h2 class="title-head margin-top-0 cate"><span>{{__('frontend.price_product')}}</span></h2>
                            </div>
                            <div class="filter-content">
                                <div id="slider-range"></div>
                                <div class="show-range">
                                    <div>
                                        <span id="start">
                                            <input type="text" name="min" value="0">
                                        </span>
                                        <span id="end">
                                            <input type="text" name="max" value="100.000.000₫">
                                        </span>
                                    </div>
                                    <a href="javascript:void(0)" id="button-filter">{{__('frontend.filter')}}</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $isBrands = Request::get('brand');
                            if(empty($isBrands))
                            {
                                $isBrands = array();
                            }
                        @endphp
                        @if(!empty($brands))
                        <div class="filter-brand">
                            <div class="page-title">
                                <h2 class="title-head margin-top-0 cate"><span>{{__('frontend.trademark')}}</span></h2>
                            </div>
                            <div class="content-brand">
                                <ul>
                                    @foreach($brands as $key => $brand)
                                    <li class="filter-item filter-item--check-box filter-item--green ">
                                        <span>
                                            <label for="filter-olivo">
                                                <input type="checkbox" name="brand[]" id="filter-olivo" value="{{$brand->id}}" {{ in_array($brand->id, $isBrands) ? 'checked' : '' }}>
                                                <i class="fa"></i>
                                                {{$brand->brand_name}}
                                            </label>
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </form>
                    <div class="product-favorite">
                        <div class="page-title">
                            <h2 class="title-head margin-top-0 cate"><span>{{__('frontend.favorite_product')}}</span></h2>
                        </div>
                        <div class="slick-vertical">
                            @php
                            $totalbox = ceil(count($productsFavorite) / 3);
                            @endphp
                            @for($i = 1 ; $i <= $totalbox; $i++)
                            <div class="products-box">
                                @foreach($productsFavorite as $index => $product)
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
                <span class="icon-up">
                    <i class="fa"></i>
                </span>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                @if(count($products) > 0)
                <div class="product-content">
                    <div class="row">
                        @foreach($products as $key => $product)
                        <div class="product-item col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 product-col">
                            <div class="img">
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
                                <button type="button" class="add-to-cart hover-imagecategory" onclick="javascript:addProductToCart(this, {{$product->id}}, null)">
                                    {{ __('frontend.add_to_cart') }}
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
                </div>
                @else
                <div class="alert alert-warning">Không tìm thấy sản phẩm nào</div>
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
    $('#button-filter').click(function(){
        $('#formcategory').submit();
    });
    $('.filter-item--check-box').click(function(){
        $('#formcategory').submit();
    })
</script>
@endsection