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
                        <!--Logo-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.logo')</label>
                            <div class="col-sm-10">
                                <div class="choose-meeting-feature">
                                    <label class="label-select">
                                        <span class="glyphicon glyphicon-picture"></span>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-lfm text-white rounded-0">@lang('app.layouts.choose-image')</button>
                                    <input type="hidden" class="form-control" name="logo"
                                        value="{{ old('logo', $setting->logo ?? null) }}">
                                </div>
                                <div class="box-upload">
                                    <img src="{{ asset(!empty(old('logo', $setting->logo ?? null)) ? old('logo', $setting->logo ?? null) : 'assets/images/no-image.jpg') }}" width="15%">
                                </div>
                            </div>
                        </div>
                        <!--End Logo-->

                        <!--Logo Footer-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.layouts.logo-footer')</label>
                            <div class="col-sm-10">
                                <div class="choose-meeting-feature">
                                    <label class="label-select">
                                        <span class="glyphicon glyphicon-picture"></span>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-lfm text-white rounded-0">@lang('app.layouts.choose-image')</button>
                                    <input type="hidden" class="form-control" name="logo_footer"
                                        value="{{ old('logo_footer', $setting->logo_footer ?? null) }}">
                                </div>
                                <div class="box-upload">
                                    <img src="{{ asset(!empty(old('logo_footer', $setting->logo_footer ?? null)) ? old('logo_footer', $setting->logo_footer ?? null) : 'assets/images/no-image.jpg') }}" width="15%">
                                </div>
                            </div>
                        </div>
                        <!--End Logo Footer-->

                        <!--Email-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.email')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="email"
                                    class="form-control @error('email') border-danger @enderror"
                                    name="email"
                                    value="{{ old('email', $setting->email ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('email') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Email-->

                        <!--Tel-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.tel')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('tel') border-danger @enderror"
                                    name="tel"
                                    value="{{ old('tel', $setting->tel ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('tel') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Tel-->

                        <!--Hotline-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.hotline')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('hotline') border-danger @enderror"
                                    name="hotline"
                                    value="{{ old('hotline', $setting->hotline ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('hotline') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Hotline-->

                        <!--Fax-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.fax')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('fax') border-danger @enderror"
                                    name="fax"
                                    value="{{ old('fax', $setting->fax ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('fax') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Fax-->

                        <!--Map-->
                         <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.map')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <textarea class="form-control" rows="5"
                                    name="map">{{ old('map', $setting->map ?? null) }}</textarea>
                            </div>
                        </div>
                        <!--End Map-->

                        <!--Facebook-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.facebook')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('facebook') border-danger @enderror"
                                    name="facebook"
                                    value="{{ old('facebook', $setting->facebook ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('facebook') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Facebook-->

                        <!--Google Plus-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.google_plus')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('google_plus') border-danger @enderror"
                                    name="google_plus"
                                    value="{{ old('google_plus', $setting->google_plus ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('google_plus') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Google Plus-->

                        <!--Pinterest-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.pinterest')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('pinterest') border-danger @enderror"
                                    name="pinterest"
                                    value="{{ old('pinterest', $setting->pinterest ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('pinterest') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Pinterest-->

                        <!--Instagram-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.instagram')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('instagram') border-danger @enderror"
                                    name="instagram"
                                    value="{{ old('instagram', $setting->instagram ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('instagram') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Instagram-->

                        <!--Twitter-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.twitter')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('twitter') border-danger @enderror"
                                    name="twitter"
                                    value="{{ old('twitter', $setting->twitter ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('twitter') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Twitter-->

                        <!--Youtube-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.youtube')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('youtube') border-danger @enderror"
                                    name="youtube"
                                    value="{{ old('youtube', $setting->youtube ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('youtube') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Youtube-->

                        <!--Zalo-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.zalo')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('zalo') border-danger @enderror"
                                    name="zalo"
                                    value="{{ old('zalo', $setting->zalo ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('zalo') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Zalo-->

                        <!--Tiktok-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.tiktok')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('tiktok') border-danger @enderror"
                                    name="tiktok"
                                    value="{{ old('tiktok', $setting->tiktok ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('tiktok') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Tiktok-->

                        <!--Fanpage-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.fanpage')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('fanpage') border-danger @enderror"
                                    name="fanpage"
                                    value="{{ old('fanpage', $setting->fanpage ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('fanpage') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Fanpage-->

                        <!--FB Script-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.fb_script')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <textarea class="form-control" rows="5"
                                    name="fb_script">{{ old('fb_script', $setting->fb_script ?? null) }}</textarea>
                            </div>
                        </div>
                        <!--End FB Script-->

                        <!--Zalo Script-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.zalo_script')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <textarea class="form-control" rows="5"
                                    name="zalo_script">{{ old('zalo_script', $setting->zalo_script ?? null) }}</textarea>
                            </div>
                        </div>
                        <!--End Zalo Script-->

                        <!--Google Analystics-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.google_analystics')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <textarea class="form-control" rows="5"
                                    name="google_analystics">{{ old('google_analystics', $setting->google_analystics ?? null) }}</textarea>
                            </div>
                        </div>
                        <!--End Google Analystics-->

                        <!--Ecommerce Industry-->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.setting.ecommerce_industry')</label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input class="form-control"
                                    name="ecommerce_industry" value="{{ old('ecommerce_industry', $setting->ecommerce_industry ?? null) }}" />
                            </div>
                        </div>
                        <!--End Ecommerce Industry-->
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
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.site')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text"
                                            class="form-control @error($lang . '.site') border-danger @enderror"
                                            name="{{ $lang }}[site]"
                                            value="{{ old($lang . '.site', $setting->translations[$key]->site ?? null) }}">
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.site') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.description')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control"
                                            name="{{ $lang }}[description]">{{ old($lang . '.description', $setting->translations[$key]->description ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.office')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control"
                                            name="{{ $lang }}[office]">{{ old($lang . '.office', $setting->translations[$key]->office ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.working_time')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control"
                                            name="{{ $lang }}[working_time]">{{ old($lang . '.working_time', $setting->translations[$key]->working_time ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.address')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control"
                                            name="{{ $lang }}[address]">{{ old($lang . '.address', $setting->translations[$key]->address ?? null) }}</textarea>
                                    </div>
                                </div>

                                 <!--Bank-->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.bank')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control" rows="5"
                                            name="{{ $lang }}[bank_information]">{{ old($lang . '.address', $setting->translations[$key]->bank_information ?? null) }}</textarea>
                                    </div>
                                </div>
                                <!--End Bank-->

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.policy')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control ckeditor"
                                            name="{{ $lang }}[policy]">{{ old($lang . '.policy', $setting->translations[$key]->policy ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.payment_at')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control ckeditor"
                                            name="{{ $lang }}[payment_at]">{{ old($lang . '.payment_at', $setting->translations[$key]->payment_at ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.shipping_free')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control ckeditor"
                                            name="{{ $lang }}[shipping_free]">{{ old($lang . '.shipping_free', $setting->translations[$key]->shipping_free ?? null) }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.setting.staffs')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control ckeditor"
                                            name="{{ $lang }}[staffs]">{{ old($lang . '.staffs', $setting->translations[$key]->staffs ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_title')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text"
                                            class="form-control @error($lang . '.seo_title') border-danger @enderror"
                                            name="{{ $lang }}[seo_title]"
                                            value="{{ old($lang . '.seo_title', $setting->translations[$key]->seo_title ?? null) }}">
                                    </div>
                                    <div class="offset-2 col-sm-10">
                                        @error($lang . '.seo_title') <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_description')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <textarea class="form-control"
                                            name="{{ $lang }}[seo_description]">{{ old($lang . '.seo_description', $setting->translations[$key]->seo_description ?? null) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">@lang('app.layouts.seo_keywords')</label>
                                    <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                        <input type="text"
                                            class="form-control"
                                            name="{{ $lang }}[seo_keywords]"
                                            value="{{ old($lang . '.seo_keywords', $setting->translations[$key]->seo_keywords ?? null) }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--End Tab Language Content-->
                    </div>
                </div>
                <!--End More Information-->

                <!--General Information-->
                <div class="card">
                    <div class="card-header">
                        @lang('app.layouts.partners')
                    </div>

                    <div class="card-body">
                        <!--Logo-->
                        @for ($i = 0; $i <= 5; $i++)
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <div class="choose-meeting-feature">
                                    <label class="label-select">
                                        <span class="glyphicon glyphicon-picture"></span>
                                    </label>
                                    <button type="button" class="btn btn-primary btn-lfm text-white rounded-0">@lang('app.layouts.choose-image')</button>
                                    <input type="hidden" class="form-control" name="partner_logo[]"
                                        value="{{!empty($partners[$i]->logo)?$partners[$i]->logo:null}}">
                                </div>
                                <div class="box-upload">
                                    <img src="{{ asset(!empty(old('logo', $partners[$i]->logo ?? null)) ? old('logo', $partners[$i]->logo ?? null) : 'assets/images/no-image.jpg') }}" width="15%">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label">Link</label>
                                <input class="form-control" name ="partner_link[]" value ="{{!empty($partners[$i]->link)?$partners[$i]->link:null}}">
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label">Hiển thị</label>
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="partner_is_active" value="1" name="partner_is_active[{{ $i }}]" @if(!empty($partners[$i]->is_active) && $partners[$i]->is_active==1) checked @endif />
                                    <label class="form-check-label" for="customNew"></label>
                                </div>
                            </div>
                        </div>
                        <hr style="border-top: 1px dashed red;"/>
                        @endfor
                    </div>
                </div>
                <!--End General Information-->
            </div>
        </div>
    </div>
</div>
<style>
/* Dashed red border */
/* hr {
  border-top: 1px dashed red;
} */
</style>