<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-12">
                <!--General Information-->
                <div class="card">
                    <div class="card-header">
                        @lang('app.layouts.general-information')
                    </div>

                    <div class="card-body">

                        <!--Feature Image-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.feature-image')</label>
                            <div class="col-sm-10">
                                <div class="choose-meeting-feature">
                                    <label class="label-select">
                                        <span class="glyphicon glyphicon-picture"></span>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-lfm text-white rounded-0"
                                        id="jsUploadImgBtn">@lang('app.layouts.choose-image')</button>
                                    <input type="hidden" class="form-control" name="page_image"
                                        value="{{ old('page_image', $page->page_image ?? null) }}" id="img-upload">
                                </div>
                                <div class="box-uploads">
                                    <img class="jsImgPreview"
                                        src="{{ asset(!empty(old('page_image', $page->page_image ?? null))? old('page_image', $page->page_image ?? null): 'assets/images/no-image.jpg') }}"
                                        width="15%">
                                </div>
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('page_image') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Feature Image-->

                        <!--Active Page-->
                        {{-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.active')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customActive"
                                        value="1" name="is_active"
                                        {{ empty($page) || old('is_active', $page->is_active) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div> --}}
                        <!--End Active Page-->
                    </div>
                </div>
                <!--End General Information-->

                <!--More Information-->
                <div class="card">
                    <div class="card-header">
                        @lang('app.layouts.more-information')
                    </div>

                    <div class="card-body">
                        <!--Tab Language-->
                        <ul class="nav nav-tabs" id="tabLanguage" role="tablist">
                            @foreach (config('constants.full_locale') as $key => $lang)
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                        data-bs-toggle="tab" data-bs-target="#{{ $key }}" role="tab"
                                        aria-controls="{{ $key }}" aria-selected="true">
                                        {{ __('app.languages.' . config('constants.full_locale')[$key]) }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <!--End Tab Language-->

                        <!--Tab Language Content-->
                        <div class="tab-content" id="tabLanguageContent">
                            @foreach (config('constants.multilang') as $key => $lang)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
                                    id="{{ $lang }}" role="tabpanel"
                                    aria-labelledby="{{ $lang }}-tab">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">
                                            @lang('app.pages.title') <sup>*</sup>
                                            <div class="form-note">(@lang('app.max_characters', ['number' => 255]))
                                            </div>
                                        </label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.page_title') border-danger @enderror"
                                                maxlength='255' onkeyup="countString(this)"
                                                name="{{ $lang }}[page_title]"
                                                value="{{ old($lang . '.page_title', $page->translations[$key]->page_title ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.page_title') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    @if (!empty($page) && $page->id != 1)
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.pages.slug')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.page_slug') border-danger @enderror"
                                                name="{{ $lang }}[page_slug]"
                                                value="{{ old($lang . '.page_slug', $page->translations[$key]->page_slug ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.page_slug') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.pages.description')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <textarea class="form-control"
                                                name="{{ $lang }}[page_description]">{{ old($lang . '.page_description', $page->translations[$key]->page_description ?? null) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.pages.content')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <textarea class="form-control ckeditor"
                                                name="{{ $lang }}[page_content]">{{ old($lang . '.page_content', $page->translations[$key]->page_content ?? null) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_title')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.seo_title') border-danger @enderror"
                                                name="{{ $lang }}[seo_title]"
                                                value="{{ old($lang . '.seo_title', $page->translations[$key]->seo_title ?? null) }}">
                                            @error($lang . '.seo_title') <span
                                                    class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="col-sm-2 col-form-label">@lang('app.layouts.seo_description')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <textarea class="form-control"
                                                name="{{ $lang }}[seo_description]">{{ old($lang . '.seo_description', $page->translations[$key]->seo_description ?? null) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_keywords')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text" class="form-control"
                                                name="{{ $lang }}[seo_keywords]"
                                                value="{{ old($lang . '.seo_keywords', $page->translations[$key]->seo_keywords ?? null) }}">
                                        </div>
                                    </div> --}}
                                </div>
                            @endforeach
                        </div>
                        <!--End Tab Language Content-->
                    </div>
                </div>
                <!--End More Information-->
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const imgUploadInput = $('#img-upload');
        const previewDiv = $('#jsImgPreview');
        const uploadImgBtn = $('#jsUploadImgBtn');

        imgUploadInput.on('change', function(e) {
            const file = e.target.value ?? '';

            if (file) {
                previewDiv.src = file;
            }
        });
    </script>
@endpush
