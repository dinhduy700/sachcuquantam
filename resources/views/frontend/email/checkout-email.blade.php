<div style="display: flex">
	<div class="logo">
		<a href="{{url('/')}}">
			<img src="{{asset($settings->logo)}}" style="width: 300px">
		</a>
	</div>
</div>
<div style="margin-top: 30px;">
	<div style="font-size: 15px; margin-top: 10px;">
		<span style="font-weight: bold;">Mã đơn hàng: </span> {{$data['order_code']}}
	</div>
	<div style="font-size: 15px; margin-top: 10px;">
		<span style="font-weight: bold;">Ngày tạo: </span> {{date('d-m-Y H:i:s')}}
	</div>
	<div style="font-size: 15px; margin-top: 10px;">
		<span style="font-weight: bold;">Họ và tên khách hàng: </span> {{$data['buyer_name']}}
	</div>
	<div style=" margin-top: 10px; font-size: 15px;">
		<span style="font-weight: bold;">Số điện thoai: </span>
		{{$data['buyer_phone']}}
	</div>
	
	<div style="margin-top: 10px; font-size: 15px;">
		<span style="font-weight: bold;">Địa chỉ</span>: {{$data['order_address']}} ( {{$data['buyer_ward']}} - {{$data['buyer_district']}} - {{$data['buyer_city']}} )
	</div>
	<div style="margin-top:10px; font-weight: bold;">
		<span style="font-size: 15px; font-weight: bold;">Hình thức thành toán: </span>
		@php
			if($data['payment_method'] == 1)
			{
				echo 'Thanh toán khi nhận hàng(COD)';
			}
			else if($data['payment_method'] == 2)
			{
				echo 'Thanh toán tại cửa hàng';
			}
			else if($data['payment_method'] == 3)
			{
				echo 'Chuyển khoản ngân hàng';
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
	<div style="font-size: 36px; font-weight: bold; text-align: center;">THÔNG TIN ĐƠN HÀNG</div>
	<div>
		<table style="width: 100%; border: 1px solid #d3d3d3; border-collapse: collapse; margin-top: 15px;">
			<thead>
				<tr>
					<th style="width: 50px; padding: 5px 10px; font-size: 18px;">
						STT
					</th>
					<th style="text-align: left; padding: 5px 10px; font-size: 18px;">
						Tên Sản Phẩm
					</th>
					<th style="width: 150px; text-align: center; padding: 5px 10px; font-size: 18px;">
						Giá
					</th>
					<th style="width: 100px; text-align: center; padding: 5px 10px; font-size: 18px;">
						Số lượng
					</th>
					<th style="width: 200px; text-align: center; padding: 5px 10px; font-size: 18px;">Thành tiền</th>
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
					<td colspan="4" style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">Tạm tính: </td>
					<td style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ number_format($totalPrice, 0, '', '.') }}₫</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">Phí vận chuyển</td>
					<td style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">{{ number_format(30000, 0, '', '.') }}₫</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right; border: 1px solid #d3d3d3; padding: 5px 10px;">Thành tiền: </td>
					<td style="text-align: right; border: 1px solid #d3d3d3; color: red; padding: 5px 10px; font-size: 18px;">{{ number_format($totalPrice+ 30000, 0, '', '.') }}₫ </td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<div style="margin-top: 30px;">
	<div style="font-size: 24px;
	text-align: center; font-style: italic;">
		CẢM ƠN BẠN ĐÃ TIN TƯỞNG VÀ SỬ DỤNG SẢN PHẨM CỦA GALEN
	</div>
</div>