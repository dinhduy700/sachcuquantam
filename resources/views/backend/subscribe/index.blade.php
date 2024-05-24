@extends('backend.index')

@section('backend-content-wrapper')
    <div class="container-fluid order-content-wrapper">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.subscribes.all-subscribes') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>@lang('app.subscribes.subscribes')</h2>
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
                                <input type="text" name="search" id="search" class="input-group-text" placeholder="@lang('app.subscribes.filter-here')" value="{{ Request::get('search') }}">
                              </div>
                
                              <div class="btn-group padding-filter">
                                <div class="form-group">
                                  <label>@lang('app.status_item')</label>
                                  <select class="form-select rounded-0" name="status" id="status">
                                    <option value="">@lang('app.layouts.all')</option>
                                    <@foreach (config('constants.contact_status_filter.'.config('app.locale')) as $key => $type)
                                        <option value="{{ $key }}" {{ Request::get('status') != null && Request::get('status') == $key ? 'selected' : null }}>@lang('app.subscribes.status_filter.'.$key)</option>
                                    @endforeach
                                  </select>
                                </div>
                
                                <div class="form-group">
                                  <label>@lang('app.layouts.sort-by')</label>
                                  <select class="form-select rounded-0" name="sortBy" id="sortBy">
                                    <option value="">@lang('app.layouts.all')</option>
                                        @foreach (config('constants.news_filter.'.config('app.locale')) as $key => $type)
                                    <option value="{{ $key }}" {{ Request::get('sortBy') != null && Request::get('sortBy') == $key ? 'selected' : null }}>@lang('app.subscribes.contact_filter.'.$key)</option>
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
                                                <th>@lang('app.subscribes.email')</th>
                                                <th>@lang('app.subscribes.status')</th>
                                                <th>@lang('app.subscribes.create-at')</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($subscribes as $subscribe)
                                            <tr class="item-info-wrapper">
                                                <th scope="row">{{ $subscribe->id }}</th>
                                                <td>{{ $subscribe->email }}</td>
                                                <td>
                                                    <div class="form-check form-switch custom-switch">
                                                        <input attr-id="{{ $subscribe->id }}" class="form-check-input form-switch-custom {{ !empty($subscribe->is_active) ? 'follow' : 'unfollow' }}" type="checkbox" id="customActive{{ $subscribe->id }}"
                                                            {{ !empty($subscribe->is_active) ? 'checked' : null }}>
                                                        <label class="form-check-label" for="customActive{{ $subscribe->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $subscribe->created_at_format }}</td>
                                                <td class="action-cell text-center">
                                                    <div class="btn-group">
                                                        <form action="{{ route('admin.subscribes.delete', $subscribe) }}" method="post" class="form-delete edit">
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
                                        @include('backend.component.items', ['items' => $subscribes])

                                        {{ $subscribes->withQueryString()->links('backend.component.pagination') }}
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

@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#filter-page-items').change(function(e) {
                $('#items').val($(this).val());
            })
            $('#filter-page-items').change(function(e) {
                $('#filter').submit();
            });
            $('.form-switch-custom').change(function(e) {
                const subscribe = $(this).attr('attr-id');
                var is_active = 1;
                if ($(this).hasClass('follow')) {
                    $(this).removeClass('follow');
                    $(this).addClass('unfollow');
                    is_active = 0;
                } else {
                    $(this).addClass('follow');
                    $(this).removeClass('unfollow');
                    is_active = 1;
                }

                $.ajax({
                    type: 'POST',
                    url: '/admin/subscribes/update/'+subscribe,
                    data: { is_active },
                    success: function(result){
                        
                    },
                    error: function(result) {
                        console.error('update subscribe error')
                    }
                });
            })
        });
    </script>
@endpush
