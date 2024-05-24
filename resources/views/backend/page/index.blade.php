@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid order-content-wrapper">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.pages.all-pages') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>@lang('app.layouts.pages')</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> 
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>@lang('app.pages.title')</th>
                                                <th>@lang('app.pages.slug')</th>
                                                <th>@lang('app.pages.status')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($pages as $page)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $page->id }}</th>
                                                <td>{{ $page->translation->page_title }}</td>
                                                <td>{{ $page->translation->page_slug }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $page->is_active == config('constants.status.active') ? 'bg-success' : 'bg-dark' }} fs-12px">{{ $page->active_text }}</span>
                                                </td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.pages.edit', ['page' => $page]) }}"><i class="fas fa-edit"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
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

@endpush
