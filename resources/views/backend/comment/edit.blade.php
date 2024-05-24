@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid category-content-wrapper">

    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.comments.index') }}">
                            {{ __('app.comments.all-comments') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('app.comments.edit-title') }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
            <div class="content-title">
                <h2>{{ __('app.comments.edit-title') }}</h2>
            </div>

            <div class="content-btn d-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary text-white btn-save-comment">
                        {{ __('app.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('backend.comment.form')
</div>

@endsection

@push('styles')

@endpush

@push('scripts')
<script>
    $('.btn-save-comment').click(function() {
        $('#comment-save-form').submit();
    })
</script>
@endpush