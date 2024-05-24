@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid order-content-wrapper">
  <form action="" method="post">
  @csrf
    <div class="row">
      <div class="col-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.orders.index') }}">
                {{ __('app.order.title') }}
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('app.order.edit_title') }}</li>
          </ol>
        </nav>
      </div>

      <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
        <div class="content-title">
          <h2>{{ __('app.order.edit_title') }}</h2>
        </div>

        <div class="content-btn d-flex align-items-center">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary text-white">
              {{ __('app.save') }}
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-8">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
          <div>{{__('app.order.order_details') }}: #{{ $order->order_code }}</div> <div>{{__('app.order.create-at') }}: {{ $order->format_created_at }}</div>
          </div>
      
          <div class="card-body">
            <!-- <div class="filter-wrapper pb-3">
              <form class="search-form d-flex align-items-end justify-content-between" method="GET" id="filter">
                <div class="input-group">
                  <div class="input-group-icon d-flex align-items-center justify-content-between">
                    <i class="fab fa-sistrix"></i>
                  </div>
                  <input type="text" name="search" id="search" class="input-group-text" placeholder="Search products here..." value="">
                </div>

                <div class="btn-group padding-filter">
                  <a href="javascript:void(0)" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
                </div>
              </form>
            </div> -->

            <div class="col-12">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th> {{__('app.order.product_name') }}</th>
                    <th class="text-center">{{__('app.order.quantity') }}</th>
                    <th class="text-end">{{__('app.order.total') }}</th>
                    <th></th>
                  </tr> 
                </thead>

                <tbody>
                  @foreach($detail as $row)
                  <tr class="item-info-wrapper">
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{!empty($row->product)?$row->product->product_image:'N/A'}}" alt="">
                        
                        <div clas="item-info">
                          <div class="item-name">
                            <a href="/admin/products/edit/{{!empty($row->productTranslation)?$row->productTranslation->product_id:'N/A'}}" class="text-reset">{{!empty($row->productTranslation)?$row->productTranslation->product_name:'N/A'}}</a>
                          </div>

                          <div class="item-code">
                            <span class="Polaris-TextStyle--variationSubdued_1segu">SKU: {{!empty($row->product)?$row->product->product_code:'N/A'}}</span>
                          </div>

                          <div class="item-original-price">
                            <span class="Polaris-TextStyle--variationSubdued_1segu">Giá:  {{number_format($row->price)}}</span>
                          </div>
                        </div>
                      </div>
                    </td>
                    
                    <td class="text-center">
                      <div class="item-qty">
                        <span class="Polaris-TextStyle--variationSubdued_1segu">{{$row->quantity}}</span>
                        <!-- <input type="number" id="inputItemQty" class="form-control" value="1" min="0" max="9999"> -->
                      </div>
                    </td>

                    <td class="text-end">
                      <div class="item-price"> {{number_format($row->price*$row->quantity)}}</div>
                    </td>

                    <td class="text-end">
                      <!-- <a href="javascript:void(0)" class="remove-item">
                        <i class="fas fa-times"></i>
                      </a> -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="col-12">
              <div class="row">
                <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">{{__('app.order.payment_method') }}:</label> <br/> 
                    <span>{{getNamePaymentMethod($order->payment_method)}}</span>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">{{__('app.order.status') }}</label>
                    <select class="form-control form-select" name ="order_status">
                      <option value="0" @if($order->order_status == 0) selected @endif>Chưa xác nhận</option>
                      <option value="1" @if($order->order_status == 1) selected @endif>Đã Xác nhận</option>
                      <option value="2" @if($order->order_status == 2) selected @endif>Đã giao</option>
                      <option value="3" @if($order->order_status == 3) selected @endif>Đã hủy</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">{{__('app.order.notes') }}</label>
                    <textarea class="form-control" id="inputNote" name="buyer_note" rows="3">{{$order->buyer_note}}</textarea>
                  </div>
                </div>

                <div class="col-12 col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">{{__('app.order.payment') }}</label>

                    <div class="payment-info-wrapper">
                      <table class="col-12">
                        <tbody>
                          <tr>
                            <td>{{__('app.order.subtotal') }}</td>
                            <td>{{number_format(round($order->order_amount,2))}}</td>
                          </tr>
                          <tr>
                            <td>
                            {{__('app.order.shipping') }}
                              <!-- <div class="text-muted">via FedEx International</div> -->
                            </td>
                            <td>{{number_format(round($order->order_shipping_fee,2))}}</td>
                          </tr>
                          <tr>
                            <td>{{__('app.order.total_order') }}</td>
                            <td>{{number_format(round($order->total_amount,2))}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            {{__('app.order.customer_info') }}
          </div>
      
          <div class="card-body">
            <div class="col-12">
              <div class="mb-3">
                <!-- <label class="form-label customer-note">
                  If you don not have a customer info list below. Create
                  <a href="" data-bs-toggle="modal" data-bs-target="#addCustomerPopup">here</a>
                  .
                </label> -->
                <label class="form-label input-group">
                {{__('app.order.buyer_name') }}:  {{!empty($order->customter)?$order->customter->id.' - ':''}} {{$order->buyer_name}}
                </label>
                <label class="form-label input-group">
                {{__('app.order.buyer_phone') }}: {{$order->buyer_phone}}
                </label>
                <label class="form-label input-group">
                {{__('app.order.order_email') }}: {{$order->order_email}}
                </label>
                <label class="form-label input-group">
                {{__('app.order.order_address') }}: {{ $order->address_buyer_format }}
                </label>

                <!-- <div class="filter-wrapper">
                  <form class="search-form d-flex align-items-end justify-content-between" method="GET" id="filter">
                    <div class="input-group">
                      <div class="input-group-icon d-flex align-items-center justify-content-between">
                        <i class="fab fa-sistrix"></i>
                      </div>
                      <input type="text" name="search" id="search" class="input-group-text" placeholder="Search customers here..." value="">
                    </div>

                    <div class="btn-group padding-filter">
                      <a href="javascript:void(0)" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
                    </div>
                  </form>
                </div> -->
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="customer-popup" tabindex="-1" aria-labelledby="addCustomerPopup" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addCustomerPopup">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>

</div>
@endsection

@push('styles')
<style>
.order-content-wrapper .item-info-wrapper img {
  width: 40px;
  height: 40px;
  margin-right: 0.75rem;
}

.order-content-wrapper .item-info-wrapper a:not(.remove-item),
.customer-note a {
  color: #0b5be5!important;
  text-decoration: underline;
}

.order-content-wrapper .payment-info-wrapper {
  line-height: 30px;
}

.order-content-wrapper .payment-info-wrapper tr td:nth-child(2) {
  text-align: right;
}

.box {
  padding: 5%;
  background: #fff;
  border-radius: 2px;
  border: 1px solid rgba(0,0,0,.125);
}

</style>
@endpush

@push('scripts')
@endpush
