@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Panel / Tickets
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-around">
                            <div
                                class="btn @if ($totalTickets > 0) btn-warning @else btn-success @endif text-center">
                                <span class="fs-1">{{ $totalTickets }}</span>
                                <br>
                                <span class="fs-5">total tickets.</span>
                            </div>
                            <div class="btn btn-primary text-center">
                                <span class="fs-1">{{ $totalClosedTickets }}</span>
                                <br>
                                <span class="fs-5">total closed tickets.</span>
                            </div>
                        </div>
                        @if (!$tickets->isEmpty())
                            <br>
                            {{ $tickets->links() }}
                            <div class="tickets scroll d-flex justify-content-center align-items-center">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Reason</th>
                                            <th scope="col">Sender</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Updated at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            @php
                                                $user = User::find($ticket->senderId);
                                            @endphp

                                            <tr>
                                                <th scope="row">{{ $ticket->id }}</th>
                                                <td>{{ $ticket->reason }}</td>
                                                <td><a
                                                        href="{{ route('user', ['username' => $user->username]) }}">{{ $user->username }}</a>
                                                </td>
                                                <td>
                                                    @if ($ticket->status == 'open')
                                                        <span class="badge bg-success p-2">Open</span>
                                                    @else
                                                        <span class="badge bg-danger p-2">Closed</span>
                                                    @endif
                                                </td>
                                                <td>{{ Helpers::class()->date($ticket->created_at) }}</td>
                                                <td>{{ Helpers::class()->date($ticket->updated_at) }}</td>
                                                <td><a href="{{ route('panel.tickets.see', ['id' => $ticket->id]) }}"
                                                        class="btn btn-primary">View</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            {{ $tickets->links() }}
                            <br>
                        @else
                            <br>
                            <br>
                            <p class="text-center">No tickets found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
