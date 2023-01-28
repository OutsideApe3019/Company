@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
        
        $users = User::withTrashed()->paginate(15);
    @endphp
    @include('panel.layouts.nav')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Panel / Users') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <br>
                        {{ $users->links() }}
                        <br>
                        <div class="users scroll d-flex justify-content-center align-items-center">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">First name</th>
                                        <th scope="col">Last name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Banned</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Updated at</th>
                                        <th scope="col">Deleted at</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($users as $user)
                                        @if ($user->deleted_at != null)
                                            <tr class="opacity-50">
                                            @else
                                            <tr>
                                        @endif
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->firstName }}</td>
                                        <td>{{ $user->lastName }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->isAdmin)
                                                <span class="badge bg-danger p-2">Admin</span>
                                            @else
                                                <span class="badge bg-secondary p-2">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->isBanned)
                                                <span class="badge bg-danger p-2">Banned</span>
                                            @else
                                                <span class="badge bg-success p-2">Not banned</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            @if ($user->deleted_at == null)
                                                <span class="badge bg-primary p-2">Not deleted</span>
                                            @else
                                                {{ $user->deleted_at }}
                                            @endif
                                        </td>
                                        @if ($user->deleted_at != null)
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('panel.users.restore', ['id' => $user->id]) }}">
                                                    @csrf
                                                    <button href="" class="btn btn-success">Restore</button>
                                                </form>
                                            </td>
                                        @else
                                            <td><a href="{{ route('panel.users.edit', ['id' => $user->id]) }}"
                                                    class="btn btn-secondary">Edit</a></td>
                                        @endif

                                        @if ($user->deleted_at != null)
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('panel.users.forceDelete', ['id' => $user->id]) }}">
                                                    @csrf
                                                    <button href="" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @else
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('panel.users.delete', ['id' => $user->id]) }}">
                                                    @csrf
                                                    <button href="" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                        <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        {{ $users->links() }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
