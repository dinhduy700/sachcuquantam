<div class="popup-product active">
    <div class="content">
        <button type="button" id="close" onclick="javascript:closePopupDetail(this)">
            <i class="fas fa-times"></i>
        </button>
        <div class="content-l">
            <div class="img-big">
                @php
                    $arrImage = json_decode($product->product_slides);
                @endphp
                @if(empty($arrImage))
                <img src="{{!empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg')}}">
                @else
                    @foreach($arrImage as $key => $image)
                        @if($key == 0)
                        <img src="{{asset($image)}}">
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="img-slick">
                <div id="img-slick">
                    @if(empty($arrImage))
                    <div class="item">
                        <a href="javascript:void(0);" onclick="imgslickdetail(this)">
                            <img src="{{!empty($product->product_image) ? asset($product->product_image) : asset('assets/images/no-image.jpg')}}">
                        </a>
                    </div>
                    @else
                    @foreach($arrImage as $image)
                    <div class="item">
                        <a href="javascript:void(0);" onclick="imgslickdetail(this)">
                            <img src="{{asset($image)}}">
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="content-r">
            <div class="product-name-view">
                <a href="{{ url('/'.( app()->getLocale() == config('constants.lang_default') ? '' : app()->getLocale(). '/' ) . $product->translation->product_slug)  }}">{{$product->translation->product_name}}</a>
            </div>
            <div class="quickview-info">
                <div class="prices price-box">
                    @php
                       echo showPricePromotionDetail($product->price, $product->promotion_price, $product->promotion_start, $product->promotion_end);
                    @endphp
                </div>
            </div>
            <div class="count_btn_style quantity_wanted_p">
                <div class="input_number_product">
                    <div>                                   
                        <a class="btn_num button_qty remove" onclick="javascript:eventNumberProduct(this, '#quantity-detail', '1')"><i class="fas fa-minus"></i></a>
                        <input type="text" id="quantity-detail" name="quantity" value="1" maxlength="2" class="prd_quantity">
                        <a class="btn_num button_qty add" onclick="javascript:eventNumberProduct(this, '#quantity-detail', '2')"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="btn-mua button_actions clearfix">
                    <button type="button" class="add_to_cart_detail" onclick="javascript:addProductToCart(this, {{$product->id}}, '#quantity-detail')">
                        {{ __('app.add-to-cart') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#img-slick').slick({
                dots: false,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
              ]
            });
    </script>
</div>
