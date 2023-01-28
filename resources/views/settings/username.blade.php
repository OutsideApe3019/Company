@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Edit username') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.edit.username') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="form-label">New username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ Auth::user()->username }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror @if (session('password')) is-invalid @endif"
                                    id="password" name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if (session('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ session('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('settings') }}" class="btn btn-danger">Cancel</a> <button type="submit"
                                class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
