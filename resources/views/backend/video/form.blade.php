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
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.feature-image')
                                <sup>*</sup></label>
                            <div class="col-sm-10">
                                <div class="choose-meeting-feature">
                                    <label class="label-select">
                                        <span class="glyphicon glyphicon-picture"></span>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-lfm text-white rounded-0"
                                        id="jsUploadImgBtn">@lang('app.layouts.choose-image')</button>
                                    <input type="hidden" class="form-control" name="video_image"
                                        value="{{ old('video_image', $video->video_image ?? null) }}" id="img-upload">
                                </div>
                                <div class="box-uploads">
                                    <img class="jsImgPreview"
                                        src="{{ asset(!empty(old('video_image', $video->video_image ?? null))? old('video_image', $video->video_image ?? null): 'assets/images/no-image.jpg') }}"
                                        width="15%">
                                </div>
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('video_image') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Feature Image-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.videos.position') 
                                <sup>*</sup>
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="number"
                                    class="form-control @error('video_position') border-danger @enderror"
                                    name="video_position"
                                    value="{{ old('video_position', $video->video_position ?? 0) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('video_position') <span class="text-danger">{{ $message }}</span>
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
                                        {{ empty($video) || old('is_active', $video->is_active) == config('constants.status.active') ? 'checked' : null }}>
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
                                            @lang('app.videos.title') <sup>*</sup>
                                            <div class="form-note">(@lang('app.max_characters', ['number' => 255]))
                                            </div>
                                        </label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.video_title') border-danger @enderror"
                                                maxlength='255' onkeyup="countString(this)"
                                                name="{{ $lang }}[video_title]"
                                                value="{{ old($lang . '.video_title', $video->translations[$key]->video_title ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.video_title') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.videos.slug')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.video_slug') border-danger @enderror"
                                                name="{{ $lang }}[video_slug]"
                                                value="{{ old($lang . '.video_slug', $video->translations[$key]->video_slug ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.video_slug') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.videos.link') <sup>*</sup></label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.video_link') border-danger @enderror"
                                                name="{{ $lang }}[video_link]"
                                                value="{{ old($lang . '.video_link', $video->translations[$key]->video_link ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.video_link') <span
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
