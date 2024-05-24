@extends('backend.index')

@section('backend-content-wrapper')
<div class="container-fluid category-content-wrapper">
    <form id="product-add-form" method="post"
        action="{{ route('admin.categories.update', ['category' => $productCategory]) }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.categories.index') }}">
                                {{ __('app.categories.title') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('app.categories.add-title') }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="col-12 d-flex justify-content-between align-items-center mb-4" id="fix-header-content">
                <div class="content-title">
                    <h2>{{ __('app.categories.add-title') }}</h2>
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

        @include('backend.category.form')
    </form>
</div>
@endsection

@push('styles')
<style>
    .box {
        padding: 5%;
        background: #fff;
        border-radius: 2px;
        border: 1px solid rgba(0, 0, 0, .125);
    }

    .directory-list ul {
        margin-left: 10px;
        padding-left: 20px;
        border-left: 1px dashed #ddd;
    }

    .directory-list li {
        list-style: none;
        /* text-transform: capitalize; */
        font-weight: normal;
    }

    .directory-list a {
        border-bottom: 1px solid transparent;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .directory-list a:hover {
        border-color: #eee;
        color: #000;
    }

    .directory-list .folder,
    .directory-list .folder>a {
        font-weight: bold;
    }

    .directory-list li:before,
    .directory-list li.folder:before {
        margin-right: 10px;
        content: "";
        height: 20px;
        vertical-align: middle;
        width: 20px;
        background-repeat: no-repeat;
        display: inline-block;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><path fill='lightgrey' d='M85.714,42.857V87.5c0,1.487-0.521,2.752-1.562,3.794c-1.042,1.041-2.308,1.562-3.795,1.562H19.643 c-1.488,0-2.753-0.521-3.794-1.562c-1.042-1.042-1.562-2.307-1.562-3.794v-75c0-1.487,0.521-2.752,1.562-3.794 c1.041-1.041,2.306-1.562,3.794-1.562H50V37.5c0,1.488,0.521,2.753,1.562,3.795s2.307,1.562,3.795,1.562H85.714z M85.546,35.714 H57.143V7.311c3.05,0.558,5.505,1.767,7.366,3.627l17.41,17.411C83.78,30.209,84.989,32.665,85.546,35.714z' /></svg>");
        background-position: center 2px;
        background-size: 60% auto;
    }

    .directory-list .folder div {
        display: inline-block;
    }
</style>
@endpush

@push('scripts')
@endpush