@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div>
                                <label for="email" class="form-label">Email</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" aria-describedby="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" aria-describedby="password">
                                    <button class="btn btn-secondary" type="button" id="showPassword"><i
                                            class="fa-solid fa-eye" id="passwordIcon"></i></button>
                                    @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" target="_blank">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        showPassword = document.getElementById('showPassword');
        password = document.getElementById('password');
        icon = document.getElementById('passwordIcon');
        showPassword.addEventListener('click', function() {
            if (password.getAttribute("type") == "password") {
                password.setAttribute("type", "text");
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.setAttribute("type", "password");
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endsection