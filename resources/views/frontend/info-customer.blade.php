@section('title-page')
    
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
<div class="info-page">
    <form method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="container">
            <div class="info-main">
                <div class="info-l">
                    <div class="avatar">
                        <img src="storage/{{Auth::guard('customer')->user()->image}}" style="width: 100%; height: 100%; object-fit: cover">
                        <div class="input-file">
                            <i class="fa fa-camera"></i>
                            <input type="file" name="avatar" onchange="addImageToInfo(this)">
                        </div>
                    </div>

                    <div class="list-tab-info">
                        <div class="item " data-tab="tab1">
                            Thông tin khách hàng
                        </div>
                        <div class="item active" data-tab="tab2">
                            Lịch sử đơn hàng
                        </div>
                    </div>
                </div>
                <div class="info-r" style="overflow: hidden;">
                    @if(Session::has('success'))
                    <div class="alert alert-success">Bạn vừa mới đăng ký đơn hàn thành công</div>
                    @endif
                    <div class="tab " id="tab1" data-tab="tab1">
                        <div class="title-info">Thông tin khách hàng</div>
                        <div class="group-form item-input">
                            <label>Họ tên: </label>
                            <input type="text" class="form-control" name="full_name" value="{{Auth::guard('customer')->user()->name}}" placeholder="Họ tên của bạn">
                        </div>
                        <div class="group-form item-input">
                            <label>Email: </label>
                            <div class="form-control">{{Auth::guard('customer')->user()->email}}</div>
                        </div>
                        <div class="group-form item-input">
                            <label>Phone: </label>
                            <input type="text" class="form-control" name="phone" value="{{Auth::guard('customer')->user()->phone}}" placeholder="Nhập số điện thoại (tối đa 10 số)">
                        </div>

                        <div class="group-form item-input">
                            <label>Địa chỉ:</label>
                            <input type="text" class="form-control" name="address" value="{{Auth::guard('customer')->user()->address}}" placeholder="Nhập địa chỉ của bạn">
                        </div>
                        <div class="group-form item-input">
                            <label>Tỉnh thành:</label>
                            <input type="text" class="form-control" name="city" value="{{Auth::guard('customer')->user()->city}}" placeholder="Nhập địa chỉ của bạn">
                        </div>
                        <div class="group-form item-input">
                            <label>Quận huyện:</label>
                            <input type="text" class="form-control" name="district" value="{{Auth::guard('customer')->user()->district}}" placeholder="Nhập địa chỉ của bạn">
                        </div>
                        <div class="group-form item-input">
                            <label>Phường xã:</label>
                            <input type="text" class="form-control" name="ward" value="{{Auth::guard('customer')->user()->ward}}" placeholder="Nhập địa chỉ của bạn">
                        </div>
                        <div class="group-form item-input">
                            <label>Tài khoản: </label>
                            <div class="form-control">
                                {{Auth::guard('customer')->user()->email}} &nbsp;
                            </div>
                        </div>
                        <div class="group-form item-input">
                            <button class="btn btn-success" type="submit">Chỉnh sữa thông tin </button>
                        </div>
                    </div>
                    <div class="tab active" id="tab2" > 
                        <div class="title-info">Lịch sử đơn hàng</div>
                        @foreach($orderService as $key => $order)
                        <div class="alert" style="width: 100%; overflow: auto;">
                            <div class="">
                                Thông tin đơn hàng ngày {{ date('d/m/Y', strtotime($order->created_at)) }}
                                <button type="button" class=" btn btn-{{$order->order_status == 0 ? 'warning' : ( $order->order_status == 1 ? 'info' : ( $order->order_status == 2 ? 'success' : 'danger' ) )  }} " style="margin-left: 15px;">
                                    {{$order->order_status == 0 ? 'Chưa xử lý' : ( $order->order_status == 1 ? 'Đã xử lý' : ( $order->order_status == 2 ? 'Đã Giao Hàng' : 'Đã Hủy' ) )  }}
                                </button>
                            </div>
                            <table class="table" style="min-width: 700px;">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th style="text-align: center;">Số lượng</th>
                                        <th style="text-align: right;">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->detaiOrder as $keyDetail => $detail)
                                    <tr>
                                        <th>{{ $keyDetail + 1 }}</th>
                                        <th>{{ $detail->product->translation->product_name }}</th>
                                        <th>{{ number_format($detail->price, 0, '', '.') }}₫</th>
                                        <th style="text-align: center;">{{ $detail->quantity }}</th>
                                        <th style="text-align: right;">{{ number_format($detail->amount, 0, '', '.') }}₫</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Tạm tính</td>
                                        <td style="text-align: right;">
                                            {{ number_format($order->order_amount, 0, '', '.') }} ₫
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right" style="text-align: right;">Phí vận chuyển</td>
                                        <td style="text-align: right;">{{ number_format($order->order_shipping_fee, 0, '', '.') }} ₫</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Thành tiền</td>
                                        <td style="color: red; font-weight: bold; text-align: right">
                                            {{ number_format($order->total_amount, 0, '', '.') }} ₫
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('css-page')
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
@section('script-page')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $('.list-tab-info .item').click(function(){
        $('.list-tab-info .item').removeClass('active');
        $(this).addClass('active');
        var tab = $(this).attr('data-tab');
        $('.tab').removeClass('active');
        $('#'+ tab).addClass('active');
    })
    function addImageToInfo(input)
    {
        if (input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).parent().parent().find('img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection