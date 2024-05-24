<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>THP.{{ __('app.login.title-form') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/style.css') }}">
</head>

<body class="container-fluid login-bg-wrapper">
    <main class="login-form d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5 position-relative bg-login bg-gradient-blue">
                        <img src="{{asset('assets/images/login.png')}}" alt="login" class="login-card-img">
                    </div>

                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <div class="sidebar-brand link-dark text-decoration-none d-flex align-items-baseline">
                                    <h1 class="fw-bold m-0">THP.</h1>
                                    <h3 class="m-0">{{ __('app.login.title-form') }}</h3>
                                </div>
                            </div>

                            <p class="login-card-description">{{__('app.sign-into-quote')}}</p>

                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="username"
                                        class="form-control @if(session()->has('error') || $errors->has('username')) border-danger @endif"
                                        placeholder="{{ __('app.login.input-email-username') }}"
                                        name="username" value="{{ old('username') }}" autofocus>
                                </div>

                                <div class="form-group">
                                    <input type="password" id="password"
                                        class="form-control @if(session()->has('error') || $errors->has('password')) border-danger @endif"
                                        placeholder="{{ __('app.login.input-password') }}"
                                        name="password" value="{{ old('password') }}">
                                </div>

                                @if(session()->has('error'))
                                    <div class="text-danger">{{ session()->get('error') }}</div>
                                @endif

                                @if(count($errors) > 0 )
                                    @foreach($errors->all() as $error)
                                        <div class="text-danger">{{$error}}</div>
                                    @endforeach
                                @endif

                                <div class="form-group login-submit">
                                    <button class="btn btn-block btn-primary col-12 bg-gradient-blue">{{ __('app.login.btn-login') }}</button>
                                </div>
                            </form>

                            <!-- <a href="#!" class="forgot-password-link">{{ __('app.login.forget-password') }}?</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>