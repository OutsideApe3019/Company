@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('User / ') }} {{ $user->username }}
                    </div>
                    <div class="card-body">
                        @if ($user->isBanned)
                            <div class="alert alert-warning" role="alert">
                                <span>This user is banned.</span>
                            </div>
                        @endif
                        <div class="user scroll scrollable d-flex justify-content-between">
                            <div>
                                <h3>
                                    {{ $user->username }}
                                    @if ($user->isAdmin)
                                        <span class="badge bg-danger p-2">Admin</span>
                                    @endif
                                </h3>
                            </div>
                            <div class="d-flex buttons">
                                <div>
                                    <a class="btn btn-primary">
                                        <i class="fa-solid fa-message"></i>
                                    </a>
                                </div>
                                &nbsp;&nbsp;&nbsp;
                                <div>
                                    <a class="btn btn-primary">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
