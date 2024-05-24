    <div class="name cart text-center">
        <a href="{{route('cart')}}">
            <span class="text">{{__('frontend.cart')}}</span>
            <i class="icon-cart">
                <img src="{{asset('frontend/assets/images/icon_cart.png')}}">
                <span class="number-cart">{{Session::get('cart') ? Session::get('cart')['totalNumber'] : 0}}</span>
            </i>
        </a>
    </div>
    <div class="top-cart-content">
        <div class="list-item-cart">
            @php
                $totalPrice = 0;
            @endphp
            @if(!Session::has('cart'))
            <div class="no-item">Không có sản phẩm nào.</div>
            @else
            <ul class="list style-4">
                
                @foreach(Session::get('cart')['data'] as $key => $value)
                <li class="data-product-item-{{$value['info']->id}}" data-item = "{{ $value['info']->id }}">
                    <div class="product">
                        <div class="img">
                            <a href=""><img src="{{!empty($value['info']->product_image) ? asset($value['info']->product_image) : asset('assets/images/no-image.jpg')}}">
                            </a>
                        </div>
                        <div class="content">
                            <div class="title">
                                <a href="">{{ $value['info']->translation->product_name }}
                                </a>
                            </div>
                            <div class="price">
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
                                <input type="hidden" name="total-price-product" value= "{{number_format($price * $value['totalProduct'], 0, '', '.')}}₫">
                            </div>
                            <div class="number">
                                <input type="number" class="quantity-detail-cart-{{$value['info']->id}}" readonly name="" min="1" value="{{ $value['totalProduct']}}" id="quantity-detail-page-{{$value['info']->id}}">
                                <button class="add" type="button" onclick="javascript:eventNumberProductActive(this, '.quantity-detail-cart-{{$value["info"]->id}}', '2', {{$value['info']->id}})">+</button>
                                <button class="remove" type="button" onclick="javascript:eventNumberProductActive(this, '.quantity-detail-cart-{{$value["info"]->id}}', '1', {{$value['info']->id}})">-</button>
                            </div>
                        </div>
                        <span data-id="57988879" title="Xóa" class="remove-item-cart fa fa-times" onclick="javascript:removeProductToCart(this, {{$value["info"]->id}})"></span>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="detail-cart">
                <div class="total">
                    <span>{{__('frontend.total')}}: </span>
                    <span class="number"> {{number_format($totalPrice, 0, '', '.')}}₫

                    </span>
                </div>
                <a href="{{route('cart')}}"><i class="fas fa-shopping-basket iconcart"></i> {{ __('frontend.go_to_cart_and_pay') }}</a>
            </div>
            @endif
            <input type="hidden" name="totalPrice" value="{{number_format($totalPrice, 0, '', '.')}}₫">
        </div>
    </div>
    <div class="message-cart" style="display: none">
        {{__('frontend.success_cart')}}
    </div>