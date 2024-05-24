<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 col-lg-9">
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
                                    <button type="button" class="btn btn-primary btn-lfm text-white rounded-0">@lang('app.layouts.choose-image')</button>
                                    <input type="hidden" class="form-control" name="image"
                                        value="{{ old('image', $productCategory->image ?? null) }}">
                                </div>
                                <div class="box-upload">
                                    <img src="{{ asset(!empty(old('image', $productCategory->image ?? null))? old('image', $productCategory->image ?? null): 'assets/images/no-image.jpg') }}" width="15%">
                                </div>
                            </div>
                        </div>
                        <!--End Feature Image-->

                        <!--Category-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.categories.parent-category')
                            </label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" @if (!empty($productCategory->parent_id)
                                        && $parentCategory->id == $productCategory->parent_id) selected
                                        @endif
                                        >{{ $parentCategory->translation->product_category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--End Category-->

                        <!--Active Category-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.active')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customActive" value="1"
                                        name="is_active" {{ empty($productCategory) || $productCategory->is_active == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Category-->

                        <!--Active Top Category-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.top_category')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="topActive" value="1"
                                        name="is_top" {{ empty($productCategory) || $productCategory->is_top == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="topActive"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Top Category-->
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
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">
                                        @lang('app.categories.name') <sup>*</sup>
                                        <div class="form-note">(@lang('app.max_characters', ['number' => 255]))</div>
                                    </label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text"
                                            class="form-control @error($lang . '.product_category_name') border-danger @enderror"
                                            maxlength='255' onkeyup="countString(this)"
                                            name="{{ $lang }}[product_category_name]"
                                            value="{{ $productCategory->translations[$key]->product_category_name ?? old($lang . '.product_category_name') }}">
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.product_category_name') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.categories.slug')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text" class="form-control @error($lang . '.product_category_slug') border-danger @enderror"
                                            name="{{ $lang }}[product_category_slug]"
                                            value="{{ $productCategory->translations[$key]->product_category_slug ?? old($lang . '.product_category_slug') }}">
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.product_category_slug') <span
                                            class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control ckeditor"
                                            name="{{ $lang }}[product_category_description]">{{ $productCategory->translations[$key]->product_category_description ??old($lang . '.product_category_description') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_title')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text"
                                            class="form-control @error($lang . '.seo_title') border-danger @enderror"
                                            name="{{ $lang }}[seo_title]"
                                            value="{{ $productCategory->translations[$key]->seo_title ?? old($lang . '.seo_title') }}">
                                        @error($lang . '.seo_title') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_description')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control"
                                            name="{{ $lang }}[seo_description]">{{ $productCategory->translations[$key]->seo_description ?? old($lang . '.seo_description') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_keywords')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text" class="form-control" name="{{ $lang }}[seo_keywords]"
                                            value="{{ $productCategory->translations[$key]->seo_keywords ?? old($lang . '.seo_keywords') }}">
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
            <div class="col-12 col-lg-3">
                <div class="box">
                    @include('backend.category._tree')
                </div>
            </div>
        </div>
    </div>
</div>