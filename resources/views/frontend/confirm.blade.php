@section('title-page')
	Thanh toán đơn hàng thành công
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
@include('frontend.layouts.banner', ['listBanner', array()])
<div class="container">
<div class="detail-page">
	<div style="margin-top: 30px;">
		<div style="font-size: 15px; margin-top: 10px;">
			<span style="font-weight: bold;">{{ __('frontend.code_orders') }}: </span> {{$data['order_code']}}
		</div>
		<div style="font-size: 15px; margin-top: 10px;">
			<span style="font-weight: bold;">{{ __('frontend.created') }}: </span> {{date('d-m-Y H:i:s')}}
		</div>
		<div style="font-size: 15px; margin-top: 10px;">
			<span style="font-weight: bold;">{{ __('frontend.customer_fullname') }}: </span> {{$data['buyer_name']}}
		</div>
		<div style=" margin-top: 10px; font-size: 15px;">
			<span style="font-weight: bold;">{{ __('frontend.customer_phone') }}: </span>
			{{$data['buyer_phone']}}
		</div>
		
		<div style="margin-top: 10px; font-size: 15px;">
			<span style="font-weight: bold;">{{ __('frontend.customer_address') }}</span>: {{$data['order_address']}} ( {{$data['buyer_ward']}} - {{$data['buyer_district']}} - {{$data['buyer_city']}} )
		</div>
		<div style="margin-top:10px; font-weight: bold;">
			<span style="font-size: 15px; font-weight: bold;">{{ __('frontend.payment_method') }}: </span>
			@php
				if($data['payment_method'] == 1)
				{
					echo __('frontend.payment_delivery');
				}
				else if($data['payment_method'] == 2)
				{
					echo __('frontend.payment_at_store');
				}
				else if($data['payment_method'] == 3)
				{
					echo __('frontend.bank_transfer');
				}
			@endphp
		</div>
		@if($data['payment_method'] == 3)
		<div style="color: red; margin-top: 15px;">
			{!! nl2br($settings->translation->bank_information) !!}
		</div>
		@endif
	</div>
	<div>
		<div style="font-size: 36px; font-weight: bold; text-align: center;">{{  __('frontend.info_orders') }}</div>
		<div>
			<table style="width: 100%; border: 1px solid #d3d3d3; border-collapse: collapse; margin-top: 15px;">
				<thead>
					<tr>
						<th style="width: 50px; padding: 5px 10px; font-size: 18px;">
							STT
						</th>
						<th style="text-align: left; padding: 5px 10px; font-size: 18px;">
							{{ __('frontend.product_name') }}
						</th>
						<th style="width: 150px; text-align: center; padding: 5px 10px; font-size: 18px;">
							{{ __('frontend.product_price') }}
						</th>
						<th style="width: 100px; text-align: center; padding: 5px 10px; font-size: 18px;">
							{{ __('frontend.product_number') }}
						</th>
						<th style="width: 200px; text-align: center; padding: 5px 10px; font-size: 18px;">{{__('frontend.into_money')}}</th>
					</tr>
				</thead>
				<tbody>
					@php
						$stt = 1;
						$totalPrice = 0;
					@endphp
					@foreach($dataCart['data'] as $key => $value)
					<tr>
						<td style="text-align: center; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ $stt++ }}</td>
						<td style="text-align: left; border: 1px solid #d3d3d3; padding: 5px 10px;">
							<a href="{{url($value['info']->translation->product_slug)}}" style="font-weight: bold; color: #000; text-decoration: none">{{ $value['info']->translation->product_name }}</a>
						</td>
						<td style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">
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
				                echo number_format($price, 0, '', '.').'₫';
				                $totalPrice = $totalPrice + $price * $value['totalProduct'];
							@endphp
						</td>
						<td style="text-align: center; border: 1px solid #d3d3d3; padding: 5px 10px;">
							{{$value['totalProduct']}}
						</td>
						<td style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">
							{{ number_format($price * $value['totalProduct'], 0, '', '.') }}₫
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ __('frontend.provisional') }}: </td>
						<td style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ number_format($totalPrice, 0, '', '.') }}₫</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ __('frontend.transport_fee') }}</td>
						<td style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ number_format(30000, 0, '', '.') }}₫</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ __('frontend.into_money') }}: </td>
						<td style="text-align: right; border: 1px solid #d3d3d3; color: red; padding: 5px 10px; font-size: 18px;">{{ number_format($totalPrice+ 30000, 0, '', '.') }}₫ </td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div style="margin-top: 30px;">
		<div style="font-size: 24px;
		text-align: center; font-style: italic;">
			{{ __('frontend.thank_you') }}
		</div>
	</div>
</div>
</div>
@endsection
	