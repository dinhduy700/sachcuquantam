@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid category-content-wrapper">
    <form id="product-add-form" method="post" action="{{ route('admin.videos.update', ['video' => $video]) }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.videos.index') }}">
                                {{ __('app.videos.all-videos') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.videos.edit-title') }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>{{ __('app.videos.edit-title') }}</h2>
                </div>

                <div class="content-btn d-flex align-items-center">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary text-white">
                            {{ __('app.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.video.form')
    </form>
</div>

@endsection

@push('styles')

@endpush

@push('scripts')
<script>
    // $(document).ready(function() {
    //     $(window).on('load', function() {
    //         if ($('select[name="banner_page"').val() == 1) {
    //             $('#banner-type-position').show();
    //         } else {
    //             $('#banner-type-position').hide();
    //         }
    //     })

    //     $('select[name="banner_page"').change(function() {
    //         if ($(this).val() == 1) {
    //             $('#banner-type-position').show();
    //         } else {
    //             $('#banner-type-position').hide();
    //         }
    //     });
    // });
</script>
@endpush