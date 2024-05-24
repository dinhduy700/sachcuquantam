@if (session()->has('success') || session()->has('error') || $errors->any())
<div class="toast-wrapper">
    <div class="toast-list">
        @if (session()->has('success'))
        <div class="toast toast-success">
            <div class="toast-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="toast-content">
                <p class="toast-type">@lang('app.layouts.success')</p>
                <p class="toast-message">{{ session()->get('success') }}</p>
            </div>

            <div class="toast-close">
                <i class="fas fa-times"></i>
            </div>
        </div>
        @endif

        @if (session()->has('warning'))
        <div class="toast toast-warning">
            <div class="toast-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <div class="toast-content">
                <p class="toast-type">@lang('app.layouts.warning')</p>
                <p class="toast-message">{{ session()->get('error') }}</p>
            </div>

            <div class="toast-close">
                <i class="fas fa-times"></i>
            </div>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="toast toast-danger">
            <div class="toast-icon">
                <i class="fas fa-times-circle"></i>
            </div>

            <div class="toast-content">
                <p class="toast-type">@lang('app.layouts.warning')</p>
                <p class="toast-message">{{ session()->get('error') }}</p>
            </div>

            <div class="toast-close">
                <i class="fas fa-times"></i>
            </div>
        </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="toast toast-warning">
                    <div class="toast-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>

                    <div class="toast-content">
                        <p class="toast-type">@lang('app.layouts.warning')</p>
                        <p class="toast-message">{{ $error }}</p>
                    </div>

                    <div class="toast-close">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endif