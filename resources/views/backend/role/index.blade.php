@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid role-content-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.roles.index') }}">
              {{ __('app.roles.title') }}
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('app.roles.all-roles') }}</li>
        </ol>
      </nav>
    </div>

    <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
      <div class="content-title">
        <h2>{{ __('app.roles.title') }}</h2>
      </div>

      <div class="content-btn d-flex align-items-center">
        <div class="btn-group">
          <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            {{ __('app.roles.add-title') }}
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
            <form class="search-form d-flex align-items-end justify-content-between">
              <div class="input-group">
                <div class="input-group-icon d-flex align-items-center justify-content-between">
                  <i class="fab fa-sistrix"></i>
                </div>
                <input type="text" class="input-group-text" placeholder="Filter roles here...">
              </div>

              <div class="btn-group"> 
                <div class="form-group">
                  <label>Search attributes</label>
                  <select class="form-select rounded-0">
                    <option>Name, email (begins with)</option>
                    <option>1</option>
                    <option>2</option>
                  </select>
                </div>
              </div>

              <div class="btn-group padding-filter">
                <a href="javascript:void(0)" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
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
                      <th>Name</th>
                      <th>Allowed Scopes</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr class="item-info-wrapper">
                      <th scope="row">1</th>
                      <td>Administrator</td>
                      <td>All</td>
                      <td>Active</td>
                      <td class="action-cell text-center">
                        <div class="btn-group">
                          <a href="javascript:void(0)"><i class="fas fa-edit"></i></a>
                          <a href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center justify-content-between">
                    Show
                    <select class="form-select rounded-0 ml-1 mr-1">
                      <option>10</option>
                      <option>20</option>
                      <option>50</option>
                    </select>
                    entries
                  </div>

                  <div class="col-auto p-0">
                    <span style="color: rgb(128, 128, 128);">Showing 1 to 10 of 57 entries</span>
                  </div>

                  <ul class="pagination m-0">
                    <li class="page-item disabled">
                      <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
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
.role-content-wrapper .card-header {
  display: flex;
  flex-wrap: wrap;
  background: #ffff;
  padding: 0 1rem;
}

.role-content-wrapper .btn-group .btn {
  border-radius: unset;
}

.role-content-wrapper .btn-group .btn i {
  font-size: 16px;
  margin-right: 7px;
  line-height: 0;
}

.role-content-wrapper .btn-primary:hover {
  color: #fff;
  background-color: #0069d9 !important;
  border-color: #0062cc !important;
}

.role-content-wrapper .nav-tabs .nav-item {
  position: relative;
  display: flex;
  margin: 0;
  padding: 0;
}

.role-content-wrapper .nav-tabs .nav-link {
  min-width: 5rem;
  padding: .8rem 1.6rem;
  border: unset;
}

.role-content-wrapper .nav-link.active::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  border: 2px solid #007bff;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}

.role-content-wrapper .filter-wrapper {
  width: 100%;
  height: 100%;
}

.role-content-wrapper .search-form,
.order-wrapper .search-form {
  width: 100%;
}

.role-content-wrapper .search-form .input-group {
  width: 100%;
  padding: .35rem 1rem;
  border: 1px solid #ced4da;
}

.role-content-wrapper .search-form .btn-group .form-group {
  min-width: 200px;
  margin-bottom: 0;
  margin-left: 10px;
}

.role-content-wrapper .input-group-icon i {
  cursor: pointer;
  font-size: 20px;
}

.role-content-wrapper .input-group-text {
  position: relative;
  padding: 0 .8rem;
  margin: 0;
  border: 0;
  background: #fff;
  text-align: left;
  flex: 1 1 auto;
}

.role-content-wrapper .table-responsive .btn-group a {
  margin-left: 20px;
}

.role-content-wrapper .hiddenRow {
  padding: 0;
}

.role-content-wrapper .table tbody+tbody {
  border: 0;
}
</style>
@endpush

@push('scripts')

@endpush

