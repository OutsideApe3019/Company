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
                        <div class="row mb-1">
                            <h5 class="col d-flex align-items-center text-break">First name: {{ Auth::user()->firstName }}</h5>
                            <a href="{{ route('settings.edit.firstName') }}" class="btn btn-primary col-sm-3">Change first name</a>
                        </div>
                        <div class="row mb-1">
                            <h5 class="col d-flex align-items-center text-break">Last name: {{ Auth::user()->lastName }}</h5>
                            <a href="{{ route('settings.edit.lastName') }}" class="btn btn-primary col-sm-3">Change last name</a>
                        </div>
                        <div class="row mb-1">
                            <h5 class="col d-flex align-items-center text-break">Username: {{ Auth::user()->username }}</h5>
                            <a href="{{ route('settings.edit.username') }}" class="btn btn-primary col-sm-3">Change username</a>
                        </div>
                        <div class="row mb-1">
                            <h5 class="col d-flex align-items-center text-break">Email: {{ Auth::user()->email }}</h5>
                            <a href="{{ route('settings.edit.email') }}" class="btn btn-primary col-sm-3">Change email</a>
                        </div>
                        <div class="row mb-1">
                            <h5 class="col d-flex align-items-center text-break">Password:</h5>
                            <a href="{{ route('settings.edit.password') }}" class="btn btn-primary col-sm-3">Change password</a>
                        </div>
                        <div class="row mb-1">
                            <a href="{{ route('settings.edit.delete') }}" class="btn btn-danger col">Delete account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
