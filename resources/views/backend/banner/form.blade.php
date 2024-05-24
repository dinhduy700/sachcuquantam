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
                        <!--Banner Page-->
                        {{-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.banner.page')
                            </label>
                            <div class="col-sm-10">
                                <select name="banner_page" class="form-control">
                                    @foreach ($pages as $page)
                                    <option value="{{ $page->id }}" @if (!empty($banner->banner_page)
                                        && $page->id == $banner->banner_page) selected
                                        @endif>{{ $page->translation->page_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <!--End Banner Page-->

                        <!--Banner Position Page-->
                        <div class="form-group row" id="banner-type-position">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.banner.position')
                            </label>
                            <div class="col-sm-10">
                                <select name="type" class="form-control">
                                    @foreach (config('constants.banner_type.'.config('app.locale')) as $key => $type)
                                    <option value="{{ $key }}" {{ old('type', $banner->type ?? 0) == $key ? 'selected' : null }}>@lang('app.banner.type.'.$key)</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--End Banner Position Page-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.banner.sortable')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="number"
                                    class="form-control @error('banner_position') border-danger @enderror"
                                    name="banner_position"
                                    value="{{ old('banner_position', $banner->banner_position ?? 0) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('banner_position') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!--Active Banner-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.active')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customActive" value="1"
                                        name="is_active" {{ empty($banner) || old('is_active', $banner->is_active) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Banner-->

                        <!--Button Banner-->
                        {{-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.has_button')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customButton" value="1"
                                        name="has_button" @if (!empty($banner->has_button) &&
                                    $banner->has_button == config('constants.status.active')) checked="checked"
                                    @endif>
                                    <label class="form-check-label" for="customButton"></label>
                                </div>
                            </div>
                        </div> --}}
                        <!--End Button Banner-->
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
                            <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="{{ $lang }}"
                                role="tabpanel" aria-labelledby="{{ $lang }}-tab">
                                <!--Feature Image-->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.feature-image') <sup>*</sup></label>
                                    <div class="col-sm-10">
                                        <div class="choose-meeting-feature">
                                            <label class="label-select">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </label>
                                            <button type="button"
                                                class="btn btn-primary btn-lfm text-white rounded-0" id="jsUploadImgBtn">@lang('app.layouts.choose-image')</button>
                                            <input type="hidden" class="form-control" name="{{ $lang }}[banner_image]"
                                                value="{{  old($lang.'.banner_image', $banner->translations[$key]->banner_image ?? null) }}" id="img-upload">
                                        </div>
                                        <div class="box-uploads">
                                            <img id="jsImgPreview" src="{{ asset(!empty(old($lang.'.banner_image', $banner->translations[$key]->banner_image ?? null)) ? old($lang.'.banner_image', $banner->translations[$key]->banner_image ?? null) : 'assets/images/no-image.jpg')  }}" width="15%">
                                        </div>
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.banner_image') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!--End Feature Image-->

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">
                                        @lang('app.banner.name') <sup>*</sup>
                                        <div class="form-note">(@lang('app.max_characters', ['number' => 255]))</div>
                                    </label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text"
                                            class="form-control @error($lang . '.banner_title') border-danger @enderror"
                                            maxlength='255' onkeyup="countString(this)" name="{{ $lang }}[banner_title]"
                                            value="{{ old($lang . '.banner_title', $banner->translations[$key]->banner_title ?? null) }}">
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.banner_title') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.banner.link')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text" class="form-control @error($lang . '.banner_link') border-danger @enderror" name="{{ $lang }}[banner_link]"
                                            value="{{ old($lang . '.banner_link', $banner->translations[$key]->banner_link ?? null) }}">
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.banner_link') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row banner-content">
                                    <label class="col-sm-2 col-form-label">@lang('app.banner.content')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control" rows="5"
                                            name="{{ $lang }}[banner_content]">{{ old($lang . '.banner_content', $banner->translations[$key]->banner_content ?? null) }}</textarea>
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

$(window).on('load', function() {
    const position = $('select[name="type"]').val();
    if (position == 2) {
        $('.banner-content').show();
    } else {
        $('.banner-content').hide();
    }
});

$('select[name="type"]').on('change', function() {
    const position = $(this).val();
    if (position == 2) {
        $('.banner-content').show();
    } else {
        $('.banner-content').hide();
    }
});
</script>
@endpush