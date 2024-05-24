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
                                    <input type="hidden" class="form-control" name="news_image"
                                        value="{{ old('news_image', $news->news_image ?? null) }}" id="img-upload">
                                </div>
                                <div class="box-uploads">
                                    <img class="jsImgPreview"
                                        src="{{ asset(!empty(old('news_image', $news->news_image ?? null))? old('news_image', $news->news_image ?? null): 'assets/images/no-image.jpg') }}"
                                        width="15%">
                                </div>
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('news_image') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Feature Image-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.news.position') <sup>*</sup>
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="number"
                                    class="form-control @error('news_position') border-danger @enderror"
                                    name="news_position"
                                    value="{{ old('news_position', $news->news_position ?? 0) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('news_position') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.news.news_publish')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control jsDatepicker @error('news_publish') border-danger @enderror"
                                    autocomplete="off" 
                                    autofill="off"
                                    name="news_publish"
                                    value="{{ old('news_publish', $news->news_publish_format ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('news_publish') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.news.news_tags')
                            </label>
                            <div class="col-sm-10 justify-content-between align-items-center">
                                <select class="form-control jsSelect2Multiple" name="tag_id[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ !empty($news) && is_array($news->tag_array) && in_array($tag->id, $news->tag_array) ? 'selected' : null }}>{{ $tag->translation->tag_name }}</option>
                                    @endforeach
                                </select>
                            <div class="offset-2 col-sm-10">
                                @error('tag_id') <span class="text-danger">{{ $message }}</span>
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
                                        {{ empty($news) || old('is_active', $news->is_active) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Banner-->

                        <!--Active Banner-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.news.hot-news')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customHot"
                                        value="1" name="is_hot_news"
                                        {{ old('is_hot_news', $news->is_hot_news ?? 0) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customHot"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Banner-->

                        <!--Active Banner-->
                        {{-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.news.promotion-news')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox"
                                        id="customPromotion" value="1" name="is_promotion_news"
                                        {{ old('is_promotion_news', $news->is_promotion_news ?? 0) == config('constants.status.active')? 'checked': null }}>
                                    <label class="form-check-label" for="customPromotion"></label>
                                </div>
                            </div>
                        </div> --}}
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
                                            @lang('app.news.title') <sup>*</sup>
                                            <div class="form-note">(@lang('app.max_characters', ['number' => 255]))
                                            </div>
                                        </label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.news_title') border-danger @enderror"
                                                maxlength='255' onkeyup="countString(this)"
                                                name="{{ $lang }}[news_title]"
                                                value="{{ old($lang . '.news_title', $news->translations[$key]->news_title ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.news_title') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.news.slug')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.news_slug') border-danger @enderror"
                                                name="{{ $lang }}[news_slug]"
                                                value="{{ old($lang . '.news_slug', $news->translations[$key]->news_slug ?? null) }}">
                                        </div>
                                        <div class="offset-2 col-sm-10">
                                            @error($lang . '.news_slug') <span
                                                class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.news.description')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <textarea class="form-control"
                                                name="{{ $lang }}[news_description]">{{ old($lang . '.news_description', $news->translations[$key]->news_description ?? null) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.news.content')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <textarea class="form-control ckeditor"
                                                name="{{ $lang }}[news_content]">{{ old($lang . '.news_content', $news->translations[$key]->news_content ?? null) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_title')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text"
                                                class="form-control @error($lang . '.seo_title') border-danger @enderror"
                                                name="{{ $lang }}[seo_title]"
                                                value="{{ old($lang . '.seo_title', $news->translations[$key]->seo_title ?? null) }}">
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
                                                name="{{ $lang }}[seo_description]">{{ old($lang . '.seo_description', $news->translations[$key]->seo_description ?? null) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_keywords')</label>
                                        <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                            <input type="text" class="form-control"
                                                name="{{ $lang }}[seo_keywords]"
                                                value="{{ old($lang . '.seo_keywords', $news->translations[$key]->seo_keywords ?? null) }}">
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
        $(".jsSelect2Multiple").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

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
