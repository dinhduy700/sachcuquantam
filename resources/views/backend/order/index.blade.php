@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid order-content-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">{{ __('app.order.title') }}</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
      <div class="content-title">
        <h2>{{ __('app.order.title') }}</h2>
      </div>

      <div class="content-btn d-flex align-items-center">
        <div class="btn-group">
          <!-- <a href="javascript:void(0)" class="btn">
            <i class="fas fa-file-download"></i>
            Export
          </a> -->
          <!-- <a href="{{ route('admin.orders.create') }}#" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create order
          </a> -->
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="filter-wrapper pb-3">
            <form class="search-form d-flex align-items-end justify-content-between" method="GET" id="filter">
              <div class="input-group">
                <div class="input-group-icon d-flex align-items-center justify-content-between">
                  <i class="fab fa-sistrix"></i>
                </div>
                <input type="hidden" name="page" value="{{ Request::get('page') }}">
                <input type="hidden" id="items" name="items" value="{{ Request::get('items') }}" >
                <input type="text" name="search" id="search" class="input-group-text" placeholder="Mã đơn hàng,tên khách hàng,sđt..." value="">
              </div>

              <div class="btn-group padding-filter">
                <div class="form-group">
                  <label>Trạng thái</label>
                  <select class="form-select rounded-0" name="order_status" id="order_status">
                    <option value="">Tất cả</option>
                    <option value="0">Chờ xác nhận </option>
                    <option value="1">Đã xác nhận</option>
                    <option value="2">Đã giao</option>
                    <option value="3">Đã hủy</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Ngày</label>
                  <input type="text" name="order_date" id="order_date" class="form-control" placeholder="Ngày đặt" value="">
                </div>
              </div>

              <div class="btn-group padding-filter">
                <button type="submit" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
              </div>
            </form>
          </div>

          <div class="tab-content">
            <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
              <div class="table-responsive">
                <div class="table-item-list">
                  <table class="table table-hover">
                    <thead>
                      <tr class="position-relative">
                        <th>
                          <!-- <input id="jsCheckAll" class="check-all" type="checkbox"> -->
                        </th>
                        <th>
                          Đơn hàng
                          <div class="table-bulk-actions">
                            <a id="jsBtnBulkAction" class="btn bulk-actions-select dropdown-toggle">
                              <strong>More actions</strong>
                              <span class="mr-1 text-secondary">(<span class="count-number">0</span> selected)</span>
                            </a>

                            <div class="dropdown-menu fs-14px" aria-labelledby="jsBtnBulkAction">
                              <a href="javascript:;" class="dropdown-item">
                                <span class="ml-1">Print packing slips</span>
                              </a>
                              <a href="javascript:;" class="dropdown-item border-bottom">
                                <span class="ml-1">Payment confirm</span>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                <span class="ml-1">Archive orders</span>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                <span class="ml-1">Unarchive orders</span>
                              </a>
                            </div>
                          </div>
                        </th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt hàng </th>
                        <th>Phương thức</th>
                        <th>Tổng</th>
                        <th>Trạng thái</th>
                        <th></th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($orders as $row)
                      <tr class="item-info-wrapper">
                        <td>
                          <!-- <input id="check-all" type="checkbox"> -->
                        </td>
                        <td>
                          <a href="javascript: void(0);" class="text-body font-weight-bold">#{{$row->id}}<br/>@lang('app.order.order_code'): {{$row->order_code}}</a>
                        </td>
                        <td>{{!empty($row->customter)?$row->customter->id.' - ':''}} {{$row->buyer_name}}
                          <br/>
                          <span class="fw-bold">@lang('app.order.order_address'): </span> {{ $row->address_buyer_format }}
                          <br/>
                          <span class="fw-bold">@lang('app.order.order_email'): </span> {{$row->order_email}}
                          <br/>
                          <span class="fw-bold">@lang('app.order.buyer_phone'): </span> {{$row->buyer_phone}}
                        </td>
                        <td>{{$row->format_created_at}}</td>
                        <td>{{getNamePaymentMethod($row->payment_method)}}</td>
                        <td>{{number_format($row->order_amount)}}</td>
                        <td>
                          {!!getStatusOrder($row->order_status)!!}
                        </td>
                        <td class="action-cell text-center">
                          <div class="btn-group">
                          <a href="{{ route('admin.orders.edit', $row->id) }}"><i class="fas fa-edit"></i></a>
                            {{-- <a href="javascript:void(0)" data-toggle="collapse">
                              <i class="fas fa-eye"></i>
                            </a> --}}
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="d-flex align-items-center justify-content-between">
                  @include('backend.component.items', ['items' => $orders])
                  {{ $orders->withQueryString()->links('backend.component.pagination') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
/* ORDER */
.order-content-wrapper .order-item-info {
  position: absolute;
}

.order-detail .product-img {
  width: 50px;
}

</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
  $(function() {
    $('input[name="order_date"]').daterangepicker({
      opens: 'left',
      startDate: moment().startOf('month').format('MM/DD/YYYY'),
      endDate: moment().endOf('month').format('MM/DD/YYYY'),
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
  $(document).ready(function() {
  $('#filter-page-items').change(function(e) {
    $('#pageItems').val($(this).val());
  })
  $('#status, #filter-page-items, #sortBy').change(function(e) {
    $('#filter').submit();
  })
  $('#search').blur(function(e) {
    $('#filter').submit();
  })
});


</script>
@endpush