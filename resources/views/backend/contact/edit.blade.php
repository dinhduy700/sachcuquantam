@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid category-content-wrapper">
    <form id="product-add-form" method="post" action="{{ route('admin.contacts.update', ['contact' => $contact]) }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.contacts.index') }}">
                                {{ __('app.contacts.all-contacts') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.contacts.edit-title') }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>{{ __('app.contacts.edit-title') }}</h2>
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

        @include('backend.contact.form')
    </form>
</div>

@endsection

@push('styles')

@endpush

@push('scripts')

@endpush