@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid order-content-wrapper">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.comments.all-comments') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>@lang('app.comments.comments')</h2>
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
                              <input type="hidden" id="items" name="items" value="{{ Request::get('items') }}">
                              <input type="hidden" name="filter" value="{{ Request::get('filter') }}">
                
                              <div class="input-group">
                                <div class="input-group-icon d-flex align-items-center justify-content-between">
                                  <i class="fab fa-sistrix"></i>
                                </div>
                                <input type="text" name="search" id="search" class="input-group-text" placeholder="@lang('app.comments.filter-here')" value="{{ Request::get('search') }}">
                              </div>
                
                              <div class="btn-group padding-filter">
                                <div class="form-group">
                                  <label>@lang('app.status_item')</label>
                                  <select class="form-select rounded-0" name="status" id="status">
                                    <option value="">@lang('app.layouts.all')</option>
                                    <@foreach (config('constants.contact_status_filter.'.config('app.locale')) as $key => $type)
                                        <option value="{{ $key }}" {{ Request::get('status') != null && Request::get('status') == $key ? 'selected' : null }}>@lang('app.contacts.status_filter.'.$key)</option>
                                    @endforeach
                                  </select>
                                </div>
                
                                <div class="form-group">
                                  <label>@lang('app.layouts.sort-by')</label>
                                  <select class="form-select rounded-0" name="sortBy" id="sortBy">
                                    <option value="">@lang('app.layouts.all')</option>
                                        @foreach (config('constants.news_filter.'.config('app.locale')) as $key => $type)
                                    <option value="{{ $key }}" {{ Request::get('sortBy') != null && Request::get('sortBy') == $key ? 'selected' : null }}>@lang('app.contacts.contact_filter.'.$key)</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                
                              <div class="btn-group padding-filter">
                                <button type="submit" class="btn btn-warning btn-search">{{ __('app.search') }}</a>
                              </div>
                            </form>
                        </div>
                        <ul class="tab-comment">
                            <li class="btn {{ (Request::get('filter') == 'news') === true ? null : 'active' }}"><a href="{{ route('admin.comments.index') }}">@lang('app.comments.comment-product')</a></li>
                            <li class="btn {{ (Request::get('filter') == 'news') === true ? 'active' : null }}"><a href="{{ route('admin.comments.index', ['filter' => 'news']) }}">@lang('app.comments.comment-news')</a></li>
                        </ul>

                        @if (!empty(Request::get('filter')) && Request::get('filter') == 'news')
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>@lang('app.comments.name')</th>
                                                <th>@lang('app.comments.email')</th>
                                                <th>@lang('app.comments.news')</th>
                                                <th class="short-comment">@lang('app.comments.comment')</th>
                                                <th>@lang('app.comments.status')</th>
                                                <th>@lang('app.comments.create-at')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($comments as $comment)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $comment->id }}</th>
                                                <td>{{ $comment->name }}</td>
                                                <td>{{ $comment->email }}</td>
                                                <td>{{ $comment->news->news_title }}</td>
                                                <td class="short-comment" data-bs-toggle="tooltip" data-bs-placement="top" title="{!! $comment->comment !!}">{{ $comment->comment }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $comment->is_active == config('constants.status.active') ? 'bg-success' : 'bg-dark' }} fs-12px">{{ $comment->active_text }}</span>
                                                </td>
                                                <td>{{ $comment->created_at_format }}</td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.comments.edit', ['comment' => $comment, 'filter' => 'news']) }}"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.comments.delete', ['comment' => $comment, 'filter' => 'news']) }}" method="post" class="form-delete edit">
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
                                        @include('backend.component.items', ['items' => $comments])

                                        {{ $comments->withQueryString()->links('backend.component.pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>@lang('app.comments.name')</th>
                                                <th>@lang('app.comments.product')</th>
                                                <th class="short-comment">@lang('app.comments.comment')</th>
                                                <th>@lang('app.comments.score')</th>
                                                <th>@lang('app.comments.status')</th>
                                                <th>@lang('app.comments.create-at')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($comments as $comment)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $comment->id }}</th>
                                                <td>{{ $comment->name }}</td>
                                                <td>{{ $comment->product->product_name }}</td>
                                                <td class="short-comment" data-bs-toggle="tooltip" data-bs-placement="top" title="{!! $comment->review_content !!}">{{ $comment->review_content }}</td>
                                                <td>{{ $comment->score }}</td>
                                                <td>
                                                    <span class="badge rounded-pill {{ $comment->is_active == config('constants.status.active') ? 'bg-success' : 'bg-dark' }} fs-12px">{{ $comment->active_text }}</span>
                                                </td>
                                                <td>{{ $comment->created_at_format }}</td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.comments.edit', ['comment' => $comment]) }}"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.comments.delete', $comment) }}" method="post" class="form-delete edit">
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
                                        @include('backend.component.items', ['items' => $comments])

                                        {{ $comments->withQueryString()->links('backend.component.pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
