<!DOCTYPE html>
<html>
<head>
    <title>@yield('title-page')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar@2.0.3/umd/simplebar.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    <meta property="og:image" content="{{asset($settings->logo ?? 'assets/images/favicon.ico')}}" />
</head>
<body>
    <div class="checkout-page">
        <!-- <div class="content-mb">
            <div class="logo-mb">
                <a href="{{route('home')}}"><img src="{{asset('frontend/assets/images/checkout_logo.jfif')}}"></a>
            </div>
        </div> -->
        <div class="content">
            <form method="post" action="{{route('submit-order')}}">
                {{ csrf_field() }}
                <div class="wrap">
                    <div class="wrap-left">
                        <!-- <div class="logo">
                            <a href="{{route('home')}}"><img src="{{asset('frontend/assets/images/checkout_logo.jfif')}}"></a>
                        </div> -->
                        <div class="main-left">
                            <div class="content-mb">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-customer">
                                            <div class="title">
                                                <h3><span class="icon-title"><i class="fa fa-address-card"></i></span> {{ __('frontend.delivery_information') }}</h3>

                                                @if(empty(auth()->guard('customer')->user()))
                                                <a href="{{route('login.get')}}" style="display: flex;align-items: center;"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" class="svg-inline--fa fa-user-circle fa-w-16 svg20 mr-2"><path fill="currentColor" d="M248 104c-53 0-96 43-96 96s43 96 96 96 96-43 96-96-43-96-96-96zm0 144c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm0-240C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-49.7 0-95.1-18.3-130.1-48.4 14.9-23 40.4-38.6 69.6-39.5 20.8 6.4 40.6 9.6 60.5 9.6s39.7-3.1 60.5-9.6c29.2 1 54.7 16.5 69.6 39.5-35 30.1-80.4 48.4-130.1 48.4zm162.7-84.1c-24.4-31.4-62.1-51.9-105.1-51.9-10.2 0-26 9.6-57.6 9.6-31.5 0-47.4-9.6-57.6-9.6-42.9 0-80.6 20.5-105.1 51.9C61.9 339.2 48 299.2 48 256c0-110.3 89.7-200 200-200s200 89.7 200 200c0 43.2-13.9 83.2-37.3 115.9z" class=""></path></svg> {{__('frontend.signup')}}</a>
                                                @endif
                                            </div>
                                            <div class="mt-2">
                                                <div class="group-input label">
                                                    <input type="" name="buyer_name" placeholder=" " value="{{ isset(auth()->guard('customer')->user()->name) ? auth()->guard('customer')->user()->name : '' }}" required>
                                                    <label>{{ __('frontend.full_name') }}<sup>*</sup></label>
                                                </div>
                                                <div class="group-input label">
                                                    <input type="" name="buyer_phone" placeholder=" " value="{{ isset(auth()->guard('customer')->user()->phone) ? auth()->guard('customer')->user()->phone : '' }}" required pattern="[0-9]{10,11}" title="Number character, 10 to 11 character">
                                                    <label>{{ __('frontend.phone') }}<sup>*</sup></label>
                                                </div>
                                                <div class="group-input label">
                                                    <input type="" name="order_address" value="{{ isset(auth()->guard('customer')->user()->address) ? auth()->guard('customer')->user()->address : '' }}" placeholder=" " required>
                                                    <label>{{ __('frontend.address') }}<sup>*</sup></label>
                                                </div>
                                                <div class="group-input label">
                                                    <input type="" name="buyer_city" placeholder=" " value="{{ isset(auth()->guard('customer')->user()->city) ? auth()->guard('customer')->user()->city : '' }}">
                                                    <label>{{ __('frontend.province') }}</label>
                                                </div>
                                                <div class="group-input label">
                                                    <input type="" name="buyer_district" value="{{ isset(auth()->guard('customer')->user()->district) ? auth()->guard('customer')->user()->district : '' }}" placeholder=" " >
                                                    <label>{{ __('frontend.district') }}</label>
                                                </div>
                                                <div class="group-input label">
                                                    <input type="" name="buyer_ward" value="{{ isset(auth()->guard('customer')->user()->ward) ? auth()->guard('customer')->user()->ward : '' }}" placeholder=" " >
                                                    <label>{{ __('frontend.wards') }}</label>
                                                </div>
                                                <div class="group-input label">
                                                    <input type="email" name="order_email" value="{{ isset(auth()->guard('customer')->user()->email) ? auth()->guard('customer')->user()->email : '' }}" placeholder=" " required>
                                                    <label>Email<sup>*</sup></label>
                                                </div>
                                                <div class="group-input label">
                                                    <textarea placeholder="" name="buyer_note"></textarea>
                                                    <label>{{ __('frontend.note') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-customer" style="height: 0; overflow: hidden;">
                                            <div class="title">
                                                <h3><span class="icon-title"><i class="fa fa-truck"></i></span> {{ __('frontend.title_transport') }}</h3>
                                            </div>
                                            <div class="group-radio-trans mt-2">
                                                <div class="item no-comment">
                                                    <input type="radio" name="shipping_method" required checked="checked" value="1">
                                                    <div class="group-input-radio">
                                                        <label>{{ __('frontend.delivery') }}</label>
                                                    </div>
                                                    <div class="item-left">{{ __('frontend.free') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-customer">
                                            <div class="title">
                                                <h3><span class="icon-title"><i class="fa fa-credit-card"></i></span> {{ __('frontend.title_payment') }}</h3>
                                            </div>
                                            <div class="group-radio-trans mt-2">
                                                <div class="item mb-2">
                                                    <input type="radio" name="payment_method" value="1" required checked="checked">
                                                    <div class="group-input-radio">
                                                        <label>{{ __('frontend.payment_delivery') }}</label>
                                                    </div>
                                                    <div class="item-left"><a href="" style="font-size: 20px; padding-right: 10px;"><i class="fas fa-money-bill-alt"></i></a></div>
                                                    <div class="note-comment">{{ __('frontend.payment_note') }}</div>
                                                </div>
                                                <div class="item mb-2">
                                                    <input type="radio" name="payment_method" value="2" required>
                                                    <div class="group-input-radio">
                                                        <label>{{ __('frontend.payment_at_store') }}</label>
                                                    </div>
                                                    <div class="item-left"><a href="" style="font-size: 20px; padding-right: 10px;"><i class="fas fa-money-bill-alt"></i></a></div>
                                                    <div class="note-comment">{{ __('frontend.payment_at_store_note') }}</div>
                                                </div>
                                                <div class="item mb-2">
                                                    <input type="radio" name="payment_method" required value="3">
                                                    <div class="group-input-radio">
                                                        <label>{{ __('frontend.bank_transfer') }}</label>
                                                    </div>
                                                    <div class="item-left"><a href="" style="font-size: 20px; padding-right: 10px;"><i class="fas fa-money-bill-alt"></i></a></div>
                                                    <div class="note-comment">
                                                        <div style="color: red; margin-top: 15px;">
                                                            {!! nl2br($settings->translation->bank_information) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-action-mb">
                                        <div class="group-action">
                                            <a href="{{ route('category-all') }}">
                                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 svg10"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg>
                                                {{ __('frontend.comback_cart') }}
                                             </a>
                                            <button type="submit" class="order">{{ __('frontend.submit_order') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-right">
                        <div class="sidebar-head">
                            <div class="content-mb">
                                <h2 class="sidebar__title">
                                    <span class="arrow-mb">{{ __('frontend.title_order') }} ({{ Session::get('cart')['totalNumber'] ?? 0 }} {{ __('frontend.text_product') }}) <i class="fa fa-angle-down"></i></span>
                                    <span class="total-mb">
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        @foreach(Session::get('cart')['data'] as $key => $value)
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
                                        @endforeach
                                        {{number_format($totalPrice, 0, '', '.')}}₫
                                    </span>
                                </h2>
                            </div>
                        </div>
                        <div class="sidebar-body" data-scrollbar>
                            <div class="content-mb">
                                <div class="list-product">
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach(Session::get('cart')['data'] as $key => $value)
                                    <div class="item">
                                        <div class="img">
                                            <span class="number">{{$value['totalProduct']}}</span>
                                            <img src="{{!empty($value['info']->product_image) ? asset($value['info']->product_image) : asset('assets/images/no-image.jpg')}}">
                                        </div>
                                        <div class="name">
                                            {{$value['info']->translation->product_name}} (x{{ $value['totalProduct'] }})
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
                                            {{number_format($price * $value['totalProduct'], 0, '', '.')}}₫
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-foot">
                            <div class="content-mb">
                                <!-- <div class="group-code_promotion">
                                    <div class="group-input label">
                                        <input type="" name="" placeholder=" ">
                                        <label>Nhập mã giảm giá</label>
                                    </div>
                                    <button class="btn btn-apply">Áp dụng</button>
                                </div> -->
                                <div class="group-total-inline">
                                    <p>
                                        <span>{{ __('frontend.provisional') }}</span>
                                        <span>
                                            {{number_format($totalPrice, 0, '', '.')}}₫
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        <span>{{ __('frontend.transport_fee') }}</span>
                                        <span>{{number_format(30000, 0, '', '.')}}₫</span>
                                    </p>
                                </div>
                                <div class="group-total-all">
                                    <span>
                                        {{ __('frontend.total') }}
                                    </span>
                                    <span class="price">{{number_format($totalPrice + 30000, 0, '', '.')}}₫</span>
                                </div>
                                <div class="group-action">
                                    <a href="{{ route('category-all') }}">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8 svg10"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg>
                                        {{ __('frontend.comback_cart') }}
                                     </a>
                                    <button type="submit" class="order">{{ __('frontend.submit_order') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="popup-checkout" style="position: fixed; top: 0; left: 0; width: 100%;height: 100%; background: rgba(255,255,255,0.8); display: none; align-items: center; justify-content: center; z-index: 11;">
        <img src="{{asset('frontend/assets/images/ajax_loader_red_128.gif')}}">
    </div>
    <script type="text/javascript" src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://unpkg.com/simplebar@2.0.3/umd/simplebar.js"></script>
    <script type="text/javascript" src="{{asset('frontend/js/common.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/function.js')}}"></script>
    <script>
        $('.arrow-mb').click(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active');
                $('.sidebar-body').slideToggle('fast', function(){});
            }
            else
            {
                $(this).addClass('active');
                $('.sidebar-body').slideToggle('fast', function(){});
            }
        });
        window.SimpleBar = new SimpleBar(document.querySelector('[data-scrollbar]'),{ autoHide: true });
        window.onresize = function() {
            window.SimpleBar.recalculate();
        }
        $('form').submit(function(){
            $('#popup-checkout').css('display', 'flex');
        })
    </script>
</body>
</html>