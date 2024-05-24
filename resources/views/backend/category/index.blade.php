@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid category-content-wrapper">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">
                            {{ __('app.categories.title') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('app.categories.all-categories') }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
            <div class="content-title">
                <h2>{{ __('app.categories.title') }}</h2>
            </div>

            <div class="content-btn d-flex align-items-center">
                <div class="btn-group">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary text-white">
                        <i class="fas fa-plus"></i>
                        {{ __('app.categories.add-title') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 col-lg-12">
                        <div class="box" id="accordion">
                            @include('backend.category._tree-index')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 col-lg-12">
                        <div class="box category-note" id="accordion">
                            @lang('app.categories.note')
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
    .block {
        border: 1px solid #f1e8e2;
        background: #fff;
    }

    .block-title {
        font-family: Arial;
        font-size: 12px;
        color: #4c4743;
        padding: 0 10px;
        height: 33px;
        line-height: 33px;
        position: relative;
    }

    .sortable {
        list-style: none;
        padding-left: 0;
        min-height: 15px
    }

    .sortable ul {
        margin-left: 25px;
    }

    .ui-sortable-helper {
        box-shadow: rgba(0, 0, 0, 0.15) 0 3px 5px 0;
        width: 300px !important;
        height: 33px !important;
    }

    .sortable-placeholder {
        height: 35px;
        background: #e3dcd7;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .category-note {
        line-height: 25px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
            var $sortable = $('.sortable').sortable({ 
                connectWith:    '.sortable',
                cursor:         'move',
                placeholder:    'sortable-placeholder',
                handle:         '.block-title',
                cursorAt:       { left: 100, top: 17 },
                tolerance:      'pointer',
                scroll:         false,
                zIndex:         9999,
                update: function (event, ui) {
                    let element = [];
                    $('.tree-element', $sortable).each(function(position) {
                        const parent = $(this).parent().closest('.tree-element').attr('tree-category') !== undefined ? $(this).parent().closest('.tree-element').attr('tree-category') : null;
                        element.push({ category: $(this).attr('tree-category'), position, parent });
                    });
                    const data = JSON.stringify(element);
                    $.ajax({
                        data,
                        type: 'POST',
                        dataType : "json",
                        contentType: "application/json",
                        url: '/admin/categories/sortable'
                        
                    });
                }
            });
            $('.sortable').disableSelection();
        });
</script>
@endpush