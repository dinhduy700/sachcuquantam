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
                                @lang('app.contacts.name') 
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $contact->name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.contacts.phone')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $contact->phone }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.contacts.email')
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {{ $contact->email }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">
                                @lang('app.contacts.content') 
                            </label>
                            <div class="col-sm-10 d-flex justify-content-between align-items-center">
                                {!! $contact->content !!}
                            </div>
                        </div>

                        <!--Approved-->
                        @if ($contact->status != config('constants.status.active'))
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">@lang('app.contacts.status')</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch custom-switch">
                                    <input class="form-check-input form-switch-custom" type="checkbox" id="customActive"
                                        value="1" name="status"
                                        {{ empty($contact) || old('status', $contact->status) == config('constants.status.active') ? 'checked' : null }}>
                                    <label class="form-check-label" for="customActive"></label>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--End Approved-->
                    </div>
                </div>
                <!--End General Information-->
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush
