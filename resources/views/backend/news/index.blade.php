@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid order-content-wrapper">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">@lang('app.news.all-news')</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>@lang('app.news.news')</h2>
                </div>

                <div class="content-btn d-flex align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('admin.news.create') }}#" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            @lang('app.news.create-news')
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
                            <form class="search-form d-flex align-items-end justify-content-between" method="GET" id="filter">
                              <input type="hidden" name="page" value="{{ Request::get('page') }}">
                              <input type="hidden" id="items" name="items" value="{{ Request::get('items') }}" >
                
                              <div class="input-group">
                                <div class="input-group-icon d-flex align-items-center justify-content-between">
                                  <i class="fab fa-sistrix"></i>
                                </div>
                                <input type="text" name="search" id="search" class="input-group-text" placeholder="@lang('app.news.filter-here')" value="{{ Request::get('search') }}">
                              </div>
                
                              <div class="btn-group padding-filter">
                                <div class="form-group">
                                  <label>@lang('app.news.status')</label>
                                  <select class="form-select rounded-0" name="status" id="status">
                                    <option value="">@lang('app.layouts.all')</option>
                                    <@foreach (config('constants.status_filter.'.config('app.locale')) as $key => $type)
                                        <option value="{{ $key }}" {{ Request::get('status') != null && Request::get('status') == $key ? 'selected' : null }}>@lang('app.news.status_filter.'.$key)</option>
                                    @endforeach
                                  </select>
                                </div>
                
                                <div class="form-group">
                                  <label>@lang('app.layouts.sort-by')</label>
                                  <select class="form-select rounded-0" name="sortBy" id="sortBy">
                                    <option value="">@lang('app.layouts.all')</option>
                                    @foreach (config('constants.news_filter.'.config('app.locale')) as $key => $type)
                                    <option value="{{ $key }}" {{ Request::get('sortBy') != null && Request::get('sortBy') == $key ? 'selected' : null }}>@lang('app.news.news_filter.'.$key)</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                
                              <div class="btn-group padding-filter">
                                <button type="submit" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
                              </div>
                            </form>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>@lang('app.news.title')</th>
                                                <th>@lang('app.news.image')</th>
                                                <th>@lang('app.news.news_publish')</th>
                                                <th>@lang('app.news.position')</th>
                                                <th>@lang('app.news.show_news')</th>
                                                <th>@lang('app.news.status')</th>
                                                <th>@lang('app.news.create-at')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($listNews as $news)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $news->id }}</th>
                                                <td>{{ $news->translation->news_title }}</td>
                                                <td><img src="{{ asset($news->display_news_image) }}" width="80" height="50" /></td>
                                                <td>{{ $news->news_publish_format }}</td>
                                                <td>{{ $news->news_position }}</td>
                                                <td>
                                                    @if($news->is_hot_news == config('constants.status.active'))
                                                        <span class="badge rounded-pill bg-danger fs-12px">@lang('app.news.hot-news')</span>
                                                    @endif

                                                    {{-- @if($news->is_promotion_news == config('constants.status.active'))
                                                        <span class="badge rounded-pill bg-primary fs-12px">@lang('app.news.promotion-news')</span>
                                                    @endif --}}
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $news->is_active == config('constants.status.active') ? 'bg-success' : 'bg-dark' }} fs-12px">{{ $news->active_text }}</span>
                                                </td>
                                                <td>{{ $news->created_at_format }}</td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.news.edit', ['news' => $news]) }}"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.news.delete', $news->id) }}" method="post" class="form-delete edit">
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
                                        @include('backend.component.items', ['items' => $listNews])

                                        {{ $listNews->withQueryString()->links('backend.component.pagination') }}
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
