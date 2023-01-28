@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Settings') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mb-1">
                            <h5>First name: {{ Auth::user()->firstName }}</h5>
                            <a href="{{ route('settings.edit.firstName') }}" class="btn btn-primary">Change first name</a>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <h5>Last name: {{ Auth::user()->lastName }}</h5>
                            <a href="{{ route('settings.edit.lastName') }}" class="btn btn-primary">Change last name</a>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <h5>Username: {{ Auth::user()->username }}</h5>
                            <a href="{{ route('settings.edit.username') }}" class="btn btn-primary">Change username</a>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <h5>Email: {{ Auth::user()->email }}</h5>
                            <a href="{{ route('settings.edit.email') }}" class="btn btn-primary">Change email</a>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <h5>Password:</h5>
                            <a href="{{ route('settings.edit.password') }}" class="btn btn-primary">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
