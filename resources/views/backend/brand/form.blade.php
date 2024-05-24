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
                                    <input type="hidden" class="form-control" name="brand_image"
                                        value="{{ old('brand_image', $brand->brand_image ?? null) }}" id="img-upload">
                                </div>
                                <div class="box-uploads">
                                    <img class="jsImgPreview"
                                        src="{{ asset(!empty(old('brand_image', $brand->brand_image ?? null))? old('brand_image', $brand->brand_image ?? null): 'assets/images/no-image.jpg') }}"
                                        width="15%">
                                </div>
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('brand_image') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--End Feature Image-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.brands.title') 
                                <sup>*</sup>
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="text"
                                    class="form-control @error('brand_name') border-danger @enderror"
                                    name="brand_name"
                                    value="{{ old('brand_name', $brand->brand_name ?? null) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('brand_name') <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.brands.position') 
                                <sup>*</sup>
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                <input type="number"
                                    class="form-control @error('brand_position') border-danger @enderror"
                                    name="brand_position"
                                    value="{{ old('brand_position', $brand->brand_position ?? 0) }}">
                            </div>
                            <div class="offset-2 col-sm-10">
                                @error('brand_position') <span class="text-danger">{{ $message }}</span>
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
                                        {{ empty($brand) || old('is_active', $brand->is_active) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div>
                        <!--End Active Banner-->
                    </div>
                </div>
                <!--End General Information-->
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
