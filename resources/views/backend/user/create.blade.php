@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid user-add-wrapper">
        <form id="product-add-form" method="post" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('app.users.all-users') }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('app.users.add-title') }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 d-inline-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                    <div class="content-title">
                        <h2>{{ __('app.users.add-title') }}</h2>
                    </div>

                    <div class="content-btn d-flex align-items-center">
                        <div class="btn-group">
                            <button type="submmit" class="btn btn-primary text-white">
                                {{ __('app.save') }}
                                </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                          {{ __('app.users.account-info') }}
                        </div>

                        <div class="card-body">

                            @include('backend.user.form')

                        </div>
                    </div>
                </div>

                {{-- <div class="col-12 col-lg-4">
        <div class="card">
          <div class="card-header">
            User Role
          </div>

          <div class="card-body">
            <table class="table table-hover table-bordered">
              <thead class="table-dark">
                <tr class="position-relative">
                  <th class="text-center">{{ __('app.assigned') }}</th>
                  <th>{{ __('app.role') }}</th>
                </tr>
              </thead>

              <tbody>
                <tr class="item-info-wrapper">
                  <td class="text-center">
                    <input type="radio" name="user-role">
                  </td>
                  <td>Supper admin</td>
                </tr>

                <tr class="item-info-wrapper">
                  <td class="text-center">
                    <input type="radio" name="user-role">
                  </td>
                  <td>Manage 1</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> --}}
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        /* .user-add-wrapper li a {
      color: #fff!important;
    } */
        .user-add-wrapper .nav-tabs .nav-link.focus,
        .user-add-wrapper .nav-tabs .nav-link.active {
            border-color: unset !important;
            border: unset !important;
            border-bottom: 1px solid #dee2e6 !important;
        }

        .user-add-wrapper .nav-tabs .nav-link:hover {
            border-color: #e9ecef #e9ecef #dee2e6;
            isolation: isolate;
        }

    </style>
@endpush

@push('scripts')
@endpush
