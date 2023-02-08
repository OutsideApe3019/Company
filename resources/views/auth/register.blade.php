@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div>
                                <label for="firstName" class="form-label">First name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                        id="firstName" name="firstName" aria-describedby="firstName"
                                        value="{{ old('firstName') }}">
                                    @error('firstName')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="lastName" class="form-label">Last name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                        id="lastName" name="lastName" aria-describedby="lastName"
                                        value="{{ old('lastName') }}">
                                    @error('lastName')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="username" class="form-label">Username</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" aria-describedby="username"
                                        value="{{ old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

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

                            <div>
                                <label for="password_confirmation" class="form-label">Confirm assword</label>
                                <div class="input-group mb-3">
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="passwordConfirmation" name="password_confirmation"
                                        aria-describedby="password_confirmation">
                                    <button class="btn btn-secondary" type="button" id="showPasswordConfirmation"><i
                                            class="fa-solid fa-eye" id="passwordConfirmationIcon"></i></button>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                        name="terms" id="terms" {{ old('terms') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="terms">
                                        I accept <a href="{{ route('terms') }}" target="_blank">Terms and Conditions</a>
                                    </label>

                                    @error('terms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Already have an account?') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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

        showPasswordConfirmation = document.getElementById('showPasswordConfirmation');
        passwordConfirmation = document.getElementById('passwordConfirmation');
        iconConfirmation = document.getElementById('passwordConfirmationIcon');

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

        showPasswordConfirmation.addEventListener('click', function() {
            if (passwordConfirmation.getAttribute("type") == "password") {
                passwordConfirmation.setAttribute("type", "text");
                iconConfirmation.classList.remove('fa-eye');
                iconConfirmation.classList.add('fa-eye-slash');
            } else {
                passwordConfirmation.setAttribute("type", "password");
                iconConfirmation.classList.remove('fa-eye-slash');
                iconConfirmation.classList.add('fa-eye');
            }
        });
    </script>
@endsection
