@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Panel / Alerts') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-around">
                            <div class="btn btn-primary text-center">
                                <span class="fs-1">{{ $totalAlerts }}</span>
                                <br>
                                <span class="fs-5">total alerts.</span>
                            </div>
                            <div class="btn btn-success text-center">
                                <span class="fs-1">{{ $totalReadAlerts }}</span>
                                <br>
                                <span class="fs-5">total read alerts.</span>
                            </div>
                            <div
                                class="btn @if ($totalNotReadAlerts > 0) btn-danger @else btn-success @endif text-center">
                                <span class="fs-1">{{ $totalNotReadAlerts }}</span>
                                <br>
                                <span class="fs-5">total not read alerts.</span>
                            </div>
                        </div>
                        <br>
                        <a class="btn btn-primary" href="{{ route('panel.alerts.create') }}">New alert</a>
                        @if (!$alerts->isEmpty())
                            <br>
                            {{ $alerts->links() }}
                            <div class="alerts scroll d-flex justify-content-center align-items-center">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Reciver</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Text</th>
                                            <th scope="col">Read</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Updated at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alerts as $alert)
                                            @php
                                                $user = User::find($alert->userId);
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $alert->id }}</th>
                                                <td>
                                                    <a
                                                        href="{{ route('user', ['username' => $user->username]) }}">{{ $user->username }}</a>
                                                </td>
                                                <td>{{ Str::limit($alert->title, 25) }}</td>
                                                <td>{{ Str::limit($alert->text, 25) }}</td>
                                                <td>
                                                    @if ($alert->read == true)
                                                        <span class="badge bg-success p-2">Read</span>
                                                    @else
                                                        <span class="badge bg-danger p-2">Not read</span>
                                                    @endif
                                                </td>
                                                <td>{{ Helpers::class()->date($alert->created_at) }}</td>
                                                <td>{{ Helpers::class()->date($alert->updated_at) }}</td>
                                                <td>
                                                    <a href="{{ route('panel.alerts.show', ['id' => $alert->id]) }}" class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            {{ $alerts->links() }}
                            <br>
                        @else
                            <br>
                            <br>
                            <p class="text-center">No alerts found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
