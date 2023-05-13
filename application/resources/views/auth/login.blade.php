<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'TAPM') }}</title>
    @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="bg-image" style="background-image: url('/storage/apc-building.png'); height: 100vh">
    <div class="container">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card" style="background-color:rgba(245, 245, 220, 0.562)">
                        <div class="card-header">
                        <div class="d-flex justify-content-center p-3">
                            <img src = "/storage/tapm-logo.png" alt="TAPM Logo" width="180px">
                        </div>
                        <div class="d-flex justify-content-center">                    
                            <h5>Login with <img src="/storage/365-logo.png" width="82"> Account</h5>
                        </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <div>
                                        <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div>
                                        <input id="password" type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>