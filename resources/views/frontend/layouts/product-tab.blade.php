@php
if(in_array(Request::segment(1), config('constants.multilang')))
{
    $locale = Request::segment(1);
    app()->setLocale(Request::segment(1));
}
else
{
    app()->setLocale(config('app.locale'));
    $locale = "";
}
@endphp
<div class="slick-special">
    @foreach($products as $index => $product)
    <div class="product-item">
        <div class="img ">
            <a href="{{ url('/'.
                                                ( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug
                                                )  }}">
                <img src="{{ !empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg') }}">
            </a>
            <span class="sale"></span>
            <button class="add-to-cart hover-imagecategory" type="button" onclick="javascript:addProductToCart(this, 1, null)">
                {{__('frontend.add_to_cart')}}
            </button>
            <div class="actions">
                <a href="" class="detail-product-show hover-imagecategory"><i class="fa fa-search"></i></a>
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