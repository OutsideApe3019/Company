@extends('layouts.app')

@section('content')
    @include('panel.layouts.nav')
    @php
        use App\Models\User;
        use App\Models\Ticket;

        // Ticket::factory()->count(50)->make();
    @endphp
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Tickets
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
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
                                                $user = $user->username;
                                            @endphp

                                            <tr>
                                                <th scope="row">{{ $ticket->id }}</th>
                                                <td>{{ $ticket->reason }}</td>
                                                <td>{{ $user }}</td>
                                                <td>
                                                    @if ($ticket->status == 'open')
                                                        <span class="badge bg-success p-2">Open</span>
                                                    @else
                                                        <span class="badge bg-danger p-2">Closed</span>
                                                    @endif
                                                </td>
                                                <td>{{ $ticket->created_at }}</td>
                                                <td>{{ $ticket->updated_at }}</td>
                                                <td><a href="{{ route('panel.tickets.see', ['id' => $ticket->id]) }}" class="btn btn-primary">View</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            {{ $tickets->links() }}
                            <br>
                        @else
                            No tickets found.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
