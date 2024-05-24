@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid order-content-wrapper">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Banners</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('app.banner.all-banner')</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>@lang('app.banner.banner')</h2>
                </div>

                <div class="content-btn d-flex align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('admin.banners.create') }}#" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            @lang('app.banner.create-banner')
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="search-form d-flex align-items-end justify-content-between" method="GET" id="filter">
                            <input type="hidden" name="page" value={{ Request::get('page') }}>
                            <input type="hidden" id="items" name="items" value={{ Request::get('items') }}>
                        </form>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>@lang('app.banner.banner')</th>
                                                <th>@lang('app.banner.image')</th>
                                                {{-- <th>@lang('app.banner.page')</th> --}}
                                                <th>@lang('app.banner.position')</th>
                                                <th>@lang('app.banner.sortable')</th>
                                                <th>@lang('app.banner.active')</th>
                                                <th>@lang('app.banner.create-at')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($banners as $banner)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $banner->id }}</th>
                                                <td>{{ $banner->translation->banner_title ?? null }}</td>
                                                <td><img src="{{ asset($banner->banner_image) }}" width="80" height="50" /></td>
                                                {{-- <td>{{ $banner->page->translation->page_title }}</td> --}}
                                                <td>{{ trans('app.banner.type.'.$banner->type) }}</td>
                                                <td>{{ $banner->banner_position }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $banner->is_active == config('constants.status.active') ? 'bg-success' : 'bg-dark' }} fs-12px">{{ $banner->active_text }}</span>
                                                </td>
                                                <td>{{ $banner->created_at_format ?? null }}</td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.banners.edit', ['banner' => $banner]) }}"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.banners.delete', $banner->id) }}" method="post" class="form-delete edit">
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
                                        @include('backend.component.items', ['items' => $banners])

                                        {{ $banners->withQueryString()->links('backend.component.pagination') }}
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
