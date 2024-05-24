@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid user-content-wrapper">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.customers.all-customers') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>{{ __('app.customers.customers') }}</h2>
                </div>

                <div class="content-btn d-flex align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            {{ __('app.customers.add-title') }}
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
                            <form class="search-form d-flex align-items-end justify-content-between" method="GET"
                                id="filter">
                                <input type="hidden" name="page" value="{{ Request::get('page') }}">
                                <input type="hidden" id="items" name="items" value="{{ Request::get('items') }}">

                                <div class="input-group">
                                    <div class="input-group-icon d-flex align-items-center justify-content-between">
                                        <i class="fab fa-sistrix"></i>
                                    </div>
                                    <input type="text" name="search" id="search" class="input-group-text"
                                        placeholder="@lang('app.customers.filter-here')" value="{{ Request::get('search') }}">
                                </div>

                                <div class="btn-group padding-filter">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-select rounded-0" name="status" id="status">
                                            <option value="">@lang('app.layouts.all')</option>
                                            <@foreach (config('constants.status_filter.' . config('app.locale')) as $key => $type)
                                                <option value="{{ $key }}"
                                                    {{ Request::get('status') != null && Request::get('status') == $key ? 'selected' : null }}>
                                                    @lang('app.news.status_filter.'.$key)</option>
                                                @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>Sort by</label>
                                        <select class="form-select rounded-0" name="sortBy" id="sortBy">
                                            <option value="">@lang('app.layouts.all')</option>
                                            @foreach (config('constants.news_filter.' . config('app.locale')) as $key => $type)
                                                <option value="{{ $key }}"
                                                    {{ Request::get('sortBy') != null && Request::get('sortBy') == $key ? 'selected' : null }}>
                                                    @lang('app.news.news_filter.'.$key)</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
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
                                                <th>@lang('app.customers.name')</th>
                                                <th>@lang('app.customers.username')</th>
                                                <th>@lang('app.customers.email')</th>
                                                <th>@lang('app.customers.phone')</th>
                                                <th>@lang('app.customers.status')</th>
                                                <th>@lang('app.customers.create-at')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($customers as $customer)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $customer->id }}</th>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->username }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $customer->is_active == config('constants.status.active') ? 'bg-success' : 'bg-dark' }} fs-12px">{{ $customer->active_text }}</span>
                                                </td>
                                                <td>{{ $customer->created_at_format }}</td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.customers.edit', ['customer' => $customer]) }}"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.customers.delete', $customer->id) }}" method="post" class="form-delete edit">
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
                                        @include('backend.component.items', ['items' => $customers])

                                        {{ $customers->withQueryString()->links('backend.component.pagination') }}
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
        .user-content-wrapper .card-header {
            display: flex;
            flex-wrap: wrap;
            background: #ffff;
            padding: 0 1rem;
        }

        .user-content-wrapper .btn-group .btn {
            border-radius: unset;
        }

        .user-content-wrapper .btn-group .btn i {
            font-size: 16px;
            margin-right: 7px;
            line-height: 0;
        }

        .user-content-wrapper .btn-primary:hover {
            color: #fff;
            background-color: #0069d9 !important;
            border-color: #0062cc !important;
        }

        .user-content-wrapper .nav-tabs .nav-item {
            position: relative;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .user-content-wrapper .nav-tabs .nav-link {
            min-width: 5rem;
            padding: .8rem 1.6rem;
            border: unset;
        }

        .user-content-wrapper .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            border: 2px solid #007bff;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .user-content-wrapper .filter-wrapper {
            width: 100%;
            height: 100%;
        }

        .user-content-wrapper .search-form {
            width: 100%;
        }

        .user-content-wrapper .search-form .input-group {
            width: 100%;
            padding: .35rem 1rem;
            border: 1px solid #ced4da;
        }

        .user-content-wrapper .search-form .btn-group .form-group {
            min-width: 200px;
            margin-bottom: 0;
            margin-left: 10px;
        }

        .user-content-wrapper .input-group-icon i {
            cursor: pointer;
            font-size: 20px;
        }

        .user-content-wrapper .input-group-text {
            position: relative;
            padding: 0 .8rem;
            margin: 0;
            border: 0;
            background: #fff;
            text-align: left;
            flex: 1 1 auto;
        }

        .user-content-wrapper .table-responsive .btn-group a {
            margin-left: 20px;
        }

        .user-content-wrapper .hiddenRow {
            padding: 0;
        }

        .user-content-wrapper .table tbody+tbody {
            border: 0;
        }

    </style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#filter-page-items').change(function(e) {
            $('#items').val($(this).val());
        })
        $('#filter-page-items').change(function(e) {
            $('#filter').submit();
        })
    });
</script>
@endpush
