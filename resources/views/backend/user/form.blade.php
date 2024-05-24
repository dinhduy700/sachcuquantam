<div class="form-group row">
    <label class="col-sm-2 col-form-label field-required">
        @lang('app.users.name'):<sup>*</sup>
    </label>

    <div class="col-sm-10 text-end">
        <input type="text" id="inputName" name="name" class="form-control @error('name') border-danger @enderror" value="{{ old('name', $user->name ?? null) }}">
    </div>

    <div class="offset-2 col-sm-10">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label field-required">
        @lang('app.users.username'):<sup>*</sup>
    </label>

    <div class="col-sm-10 text-end">
        <input type="text" id="inputName" name="username" class="form-control @error('username') border-danger @enderror" value="{{ old('username', $user->username ?? null) }}">
    </div>

    <div class="offset-2 col-sm-10">
        @error('username') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-2 col-form-label field-required">
        @lang('app.users.email'):<sup>*</sup>
    </label>

    <div class="col-sm-10 text-end">
        <input type="text" id="inputEmail" name="email" class="form-control @error('email') border-danger @enderror" value="{{ old('email', $user->email ?? null) }}">
    </div>

    <div class="offset-2 col-sm-10">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label field-required">
        @lang('app.users.password'):@if(empty($user))<sup>*</sup>@endif
    </label>

    <div class="col-sm-10 text-end">
        <input type="password" id="inputPassword" name="password" class="form-control @error('password') border-danger @enderror" value="">
    </div>

    <div class="offset-2 col-sm-10">
        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label field-required">
        @lang('app.users.password-confirmation'): @if(empty($user))<sup>*</sup>@endif
    </label>

    <div class="col-sm-10 text-end">
        <input type="password" id="inputPasswordConfirmation" name="password_confirm" class="form-control @error('password_confirm') border-danger @enderror" value="">
    </div>

    <div class="offset-2 col-sm-10">
        @error('password_confirm') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

@if(empty($user) || Auth::user()->id !== $user->id)
<div class="form-group row">
    <label class="col-sm-2 col-form-label">@lang('app.layouts.active')</label>
    <div class="col-sm-10">
        <div class="form-check form-switch custom-switch">
            <input class="form-check-input form-switch-custom" type="checkbox" id="customActive"
                value="1" name="is_active"
                {{ empty($user) || old('is_active', $user->is_active) == config('constants.status.active') ? 'checked' : null }}>
            <label class="form-check-label" for="customActive"></label>
        </div>
    </div>
</div>
@endif