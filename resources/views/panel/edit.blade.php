@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Edit user') }}
                    </div>
                    <div class="card-body">
                        <h3>Editing user <b>{{ $user->id }}</b></h3>
                        <form action="{{ route('panel.users.edit', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <div>
                                <label for="firstName" class="form-label">First name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                        id="firstName" name="firstName" aria-describedby="firstName"
                                        value="{{ $user->firstName }}" disabled>
                                    <button class="btn btn-primary" type="button" id="editFirstName"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    @error('firstName')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="lastName" class="form-label">Last name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                        id="lastName" name="lastName" aria-describedby="lastName"
                                        value="{{ $user->lastName }}" disabled>
                                    <button class="btn btn-primary" type="button" id="editLastName"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    @error('lastName')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" aria-describedby="username"
                                        value="{{ $user->username }}" disabled>
                                    <button class="btn btn-primary" type="button" id="editUsername"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    @error('username')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="email" value="{{ $user->email }}" disabled>
                                    <button class="btn btn-primary" type="button" id="editEmail"><i class="fa-solid fa-pen-to-square"></i></button>
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="isAdmin" class="form-label">Role</label>
                                <div class="input-group mb-3">
                                    <select class="form-select @error('isAdmin') is-invalid @enderror" name="isAdmin"
                                        disabled id="isAdmin">
                                        <option @if (!$user->isAdmin) selected @endif value="0">User
                                        </option>
                                        <option @if ($user->isAdmin) selected @endif value="1">Admin
                                        </option>
                                    </select>
                                    <button class="btn btn-primary" type="button" id="editIsAdmin"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    @error('isAdmin')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('panel.users') }}" class="btn btn-danger">Cancel</a>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @if ($user->isBanned)
                            <form action="{{ route('panel.users.unban', ['id' => $user->id]) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-warning">Unban user</button>
                            </form>
                        @else
                            <form action="{{ route('panel.users.ban', ['id' => $user->id]) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-warning">Ban user</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        editFirstName = document.getElementById('editFirstName');
        firstName = document.getElementById('firstName');
        editFirstName.addEventListener('click', function() {
            firstName.removeAttribute('disabled');
        });

        editLastName = document.getElementById('editLastName');
        lastName = document.getElementById('lastName');
        editLastName.addEventListener('click', function() {
            lastName.removeAttribute('disabled');
        });

        editUsername = document.getElementById('editUsername');
        username = document.getElementById('username');
        editUsername.addEventListener('click', function() {
            username.removeAttribute('disabled');
        });

        editEmail = document.getElementById('editEmail');
        email = document.getElementById('email');
        editEmail.addEventListener('click', function() {
            email.removeAttribute('disabled');
        });

        editIsAdmin = document.getElementById('editIsAdmin');
        isAdmin = document.getElementById('isAdmin');
        editIsAdmin.addEventListener('click', function() {
            isAdmin.removeAttribute('disabled');
        });
    </script>
@endsection
