@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid order-content-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.orders.index') }}">
              {{ __('app.order.title') }}
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('app.order.add-title') }}</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
      <div class="content-title">
        <h2>{{ __('app.order.add-title') }}</h2>
      </div>

      <div class="content-btn d-flex align-items-center">
        <div class="btn-group">
          <a href="javascript:void(0)" class="btn btn-primary text-white">
            {{ __('app.save') }}
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-12 col-lg-8">
      <div class="card">
        <div class="card-header">
          Order Details
        </div>
    
        <div class="card-body">
          <div class="filter-wrapper pb-3">
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
          </div>

          <div class="col-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Product</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-end">Total</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                <tr class="item-info-wrapper">
                  <td>
                    <div class="d-flex align-items-center">
                      <img src="https://cdn.pico.vn/Product/38638/big_303866_am_dun_nuoc_elmich_2353373_dung_tu_3_lit.jpg" alt="">
                      
                      <div clas="item-info">
                        <div class="item-name">
                          <a href="app-product.html" class="text-reset">Ấm Đun Nước Elmich 2353373 3 lít Giá Rẻ</a>
                        </div>

                        <div class="item-code">
                          <span class="Polaris-TextStyle--variationSubdued_1segu">SKU: 123456456</span>
                        </div>

                        <div class="item-original-price">
                          <span class="Polaris-TextStyle--variationSubdued_1segu">$849</span>
                        </div>
                      </div>
                    </div>
                  </td>
                  
                  <td class="text-center">
                    <div class="item-qty">
                      <input type="number" id="inputItemQty" class="form-control" value="1" min="0" max="9999">
                    </div>
                  </td>

                  <td class="text-end">
                    <div class="item-price">$849</div>
                  </td>

                  <td class="text-end">
                    <a href="javascript:void(0)" class="remove-item">
                      <i class="fas fa-times"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-12">
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Notes</label>
                  <textarea class="form-control" id="inputNote" rows="5"></textarea>
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">Paymnet</label>

                  <div class="payment-info-wrapper">
                    <table class="col-12">
                      <tbody>
                        <tr>
                          <td>Subtotal</td>
                          <td>$5,877.00</td>
                        </tr>
                        <tr>
                          <td>
                            Shipping
                            <div class="text-muted">via FedEx International</div>
                          </td>
                          <td>$25.00</td>
                        </tr>
                        <tr>
                          <td>Tax</td>
                          <td>$5</td>
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
          Customer
        </div>
    
        <div class="card-body">
          <div class="col-12">
            <div class="mb-3">
              <label class="form-label customer-note">
                If you don not have a customer info list below. Create
                <a href="" data-bs-toggle="modal" data-bs-target="#addCustomerPopup">here</a>
                .
              </label>

              <div class="filter-wrapper">
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
              </div>
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
