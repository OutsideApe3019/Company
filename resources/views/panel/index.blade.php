@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
        
        $users = User::limit(5)->get();
    @endphp
    @include('panel.layouts.nav')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Panel') }}
                    </div>
                    <div class="card-body">

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-15">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ __('Last users') }}
                                        </div>
                                        <div class="card-body">

                                            @isset($users)
                                                <div class="index scroll d-flex justify-content-center align-items-center">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th>Created at</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $user)
                                                                <tr>
                                                                    <th scope="row">{{ $user->id }}</th>
                                                                    <td>{{ $user->username }}</td>
                                                                    <td>{{ $user->email }}</td>
                                                                    <td>{{ $user->created_at }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <th scope="row"></th>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <div class="d-flex justify-content-end"><a
                                                                        href="{{ route('panel.users') }}"
                                                                        class="btn btn-secondary">See more...</a></div>
                                                            </td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endisset

                                            @empty($users)
                                                No new users.
                                            @endempty
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
