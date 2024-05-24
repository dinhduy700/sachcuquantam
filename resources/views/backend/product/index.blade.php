@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid product-content-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">{{ __('app.products.all-products') }}</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
      <div class="content-title">
        <h2>{{ __('app.products.title') }}</h2>
      </div>

      <div class="content-btn d-flex align-items-center">
        <div class="btn-group">
          <!-- <a href="javascript:void(0)" class="btn">
            <i class="fas fa-file-upload"></i>
            {{ __('app.export.export') }}
          </a> -->
          <!-- <a href="javascript:void(0)" class="btn">
            <i class="fas fa-file-download"></i>
            {{ __('app.export.import') }}
          </a> -->
          <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            {{ __('app.products.add-title') }}
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="filter-wrapper pb-3">
            <form class="search-form d-flex align-items-end justify-content-between" action="" method ="get">
              <div class="input-group">
                <div class="input-group-icon d-flex align-items-center justify-content-between">
                  <i class="fab fa-sistrix"></i>
                </div>
                <input type="hidden" name="page" value="{{ Request::get('page') }}">
                <input type="hidden" id="items" name="items" value="{{ Request::get('items') }}" >
                <input type="text" name="search" class="input-group-text" placeholder="@lang('app.products.filter-here')" value="{{ Request::get('search') }}">
              </div>

              <div class="btn-group"> 
                <div class="form-group">
                  <label>Danh mục</label>
                  <select class="form-select rounded-0" name ="category">
                  <option selected value ='' disabled>Tất cả</option>
                    @php
                    function category($data,$parent_id,$str=''){
                      foreach ($data as $items) {
                        if($items->parent_id==$parent_id){
                          echo "<option value=".$items->id.">".$str.$items->translation->product_category_name."</option>";
                          category($data,$items->id,$str.' - - ');
                        }
                      }
                    }
                    category($categories,0,$str='');
                    @endphp
                  </select>
                </div>

                <div class="form-group">
                  <label>Thương hiệu</label>
                  <select class="form-select rounded-0" name ="brand">
                    <option selected value ='' disabled>Tất cả</option>
                    @foreach($brands as $row)
                       <option value ="{{$row->id}}">{{$row->brand_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="btn-group padding-filter">
                <button type="submit" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
              </div>
            </form>
          </div>

          <div class="tab-content">
            <div class="tab-pane fade show active">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>SKU</th>
                      <th>Hình ảnh</th>
                      <th>Tên SP</th>
                      <th>Giá</th>
                      <th>Trạng Thái</th>
                      <th>Danh mục</th>
                      <th>Thương hiệu</th>
                      <th>Ngày tạo</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($listProducts as $row)
                    <tr class="item-info-wrapper">
                      <th scope="row">{{$row->id}}</th>
                      <td>{{$row->product_code}}</td>
                      <td><img style="width:120px" src="{{url('/').$row->product_image}}"/></td>
                      <td>{{$row->translation->product_name}}</td>
                      <td>{{number_format($row->price)}}</td>
                      <td>{{getStatusProduct($row->is_active)}}</td>
                      <td>{{!empty($row->categoryTranslation->product_category_name)?$row->categoryTranslation->product_category_name:'N/A'}}</td>
                      <td>{{!empty($row->brand->brand_name)?$row->brand->brand_name:'N/A'}}</td>
                      <td>{{$row->created_at}}</td>
                      <td class="action-cell text-center">
                        <div class="btn-group">
                          <a href="{{ route('admin.products.edit', $row->id) }}"><i class="fas fa-edit"></i></a>
                          <form action="{{ route('admin.products.delete', $row->id) }}" method="post" class="form-delete edit">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn text-edit btn-remove" onClick="swalDeleteConfirm(this, '@lang('app.are_you_sure_delete')', '@lang('app.confirm_delete')')"><i class="fas fa-trash"></i></button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="d-flex align-items-center justify-content-between">
                  @include('backend.component.items', ['items' => $listProducts])
                  {{ $listProducts->withQueryString()->links('backend.component.pagination') }}
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
<style>
.product-content-wrapper .card-header,
.order-wrapper .card-header {
  display: flex;
  flex-wrap: wrap;
  background: #ffff;
  padding: 0 1rem;
}

.product-content-wrapper .btn-group .btn,
.order-wrapper .btn-group .btn {
  border-radius: unset;
}

.product-content-wrapper .btn-group .btn i,
.order-wrapper .btn-group .btn i {
  font-size: 16px;
  margin-right: 7px;
  line-height: 0;
}

.product-content-wrapper .btn-primary:hover,
.order-wrapper .btn-primary:hover {
  color: #fff;
  background-color: #0069d9 !important;
  border-color: #0062cc !important;
}

.product-content-wrapper .nav-tabs .nav-item,
.order-wrapper .nav-tabs .nav-item {
  position: relative;
  display: flex;
  margin: 0;
  padding: 0;
}

.product-content-wrapper .nav-tabs .nav-link,
.order-wrapper .nav-tabs .nav-link {
  min-width: 5rem;
  padding: .8rem 1.6rem;
  border: unset;
}

.product-content-wrapper .nav-link.active::after,
.order-wrapper .nav-link.active::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  border: 2px solid #007bff;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}

.product-content-wrapper .filter-wrapper {
  width: 100%;
  height: 100%;
}

.product-content-wrapper .search-form,
.order-wrapper .search-form {
  width: 100%;
}

.product-content-wrapper .search-form .input-group,
.order-wrapper .search-form .input-group {
  width: 100%;
  padding: .35rem 1rem;
  border: 1px solid #ced4da;
}

.product-content-wrapper .search-form .btn-group .form-group,
.order-wrapper .search-form .btn-group .form-group {
  min-width: 200px;
  margin-bottom: 0;
  margin-left: 10px;
}

.product-content-wrapper .input-group-icon i,
.order-wrapper .input-group-icon i {
  cursor: pointer;
  font-size: 20px;
}

.product-content-wrapper .input-group-text,
.order-wrapper .input-group-text  {
  position: relative;
  padding: 0 .8rem;
  margin: 0;
  border: 0;
  background: #fff;
  text-align: left;
  flex: 1 1 auto;
}

.product-content-wrapper .table-responsive .btn-group a,
.order-wrapper .table-responsive .btn-group a {
  margin-left: 20px;
}

.product-content-wrapper .hiddenRow,
.order-wrapper .hiddenRow {
  padding: 0;
}

.product-content-wrapper .table tbody+tbody {
  border: 0;
}
</style>
@endpush

@push('scripts')

@endpush

