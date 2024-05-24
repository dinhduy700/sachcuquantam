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

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.tags.position') <sup>*</sup>
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="number"
                                    class="form-control @error('position') border-danger @enderror"
                                    name="position"
                                    value="{{ old('position', $tag->position ?? 0) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('position') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!--Active Banner-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.active')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customActive"
                                        value="1" name="is_active"
                                        {{ empty($tag) || old('is_active', $tag->is_active) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Banner-->
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
                                            @lang('app.tags.title') <sup>*</sup>
                                            <div class="form-note">(@lang('app.max_characters', ['number' => 255]))
                                            </div>
                                        </label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.tag_name') border-danger @enderror"
                                                maxlength='255' onkeyup="countString(this)"
                                                name="{{ $lang }}[tag_name]"
                                                value="{{ old($lang . '.tag_name', $tag->translations[$key]->tag_name ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.tag_name') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.tags.slug')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.tag_slug') border-danger @enderror"
                                                name="{{ $lang }}[tag_slug]"
                                                value="{{ old($lang . '.tag_slug', $tag->translations[$key]->tag_slug ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.tag_slug') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
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
