@extends('layouts.app')

@section('content')
    @php
        use App\Models\User;
        use Illuminate\Support\Carbon;
        
        $users = User::withTrashed()->paginate(15);
        $totalUsers = User::all()->count();
        $totalLastUsers = User::where('created_at', '>', Carbon::now()->subDays(7))->count();
        $totalBannedUsers = User::withTrashed()->where('isBanned', true)->count();
        $totalDeletedUsers = User::withTrashed()->whereNot('deleted_at', null)->count();
        $totalAdmins = User::withTrashed()->where('isAdmin', true)->count();
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
                        <div class="d-flex justify-content-around">
                            <div class="btn btn-primary text-center">
                                <span class="fs-1">{{ $totalUsers }}</span>
                                <br>
                                <span class="fs-5">total users.</span>
                            </div>
                            <div class="btn @if($totalLastUsers > 0) btn-success @else btn-warning @endif text-center">
                                <span class="fs-1">{{ $totalLastUsers }}</span>
                                <br>
                                <span class="fs-5">users in the last 7 days.</span>
                            </div>
                            <div class="btn @if($totalBannedUsers > 0) btn-warning @else btn-success @endif text-center">
                                <span class="fs-1">{{ $totalBannedUsers }}</span>
                                <br>
                                <span class="fs-5">total banned users.</span>
                            </div>
                            <div class="btn @if($totalDeletedUsers > 0) btn-danger @else btn-success @endif text-center">
                                <span class="fs-1">{{ $totalDeletedUsers }}</span>
                                <br>
                                <span class="fs-5">total deleted users.</span>
                            </div>
                            <div class="btn btn-primary text-center">
                                <span class="fs-1">{{ $totalAdmins }}</span>
                                <br>
                                <span class="fs-5">total admins.</span>
                            </div>
                        </div>
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
                                        <td><a href="{{ route('user', ['username' => $user->username]) }}">{{ $user->username }}</a></td>
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
