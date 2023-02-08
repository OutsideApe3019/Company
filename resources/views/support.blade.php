@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Support') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @foreach ($tickets as $ticket)
                            <div
                                class="d-flex justify-content-between rounded-2 bg-light p-3 align-items-center mt-2 border border-1 @if ($ticket->status == 'open') border-success @else border-danger @endif">
                                <h4>{{ $ticket->reason }}</h4>
                                <div>
                                    <span
                                        class="p-2 badge @if ($ticket->status == 'open') bg-success @else bg-danger @endif">
                                        @if ($ticket->status == 'open')
                                            Open
                                        @else
                                            Closed
                                        @endif
                                    </span>

                                    <a href="{{ route('ticket.see', ['id' => $ticket->id]) }}" class="btn btn-primary">View</a>

                                    @if ($ticket->status == 'closed')
                                        <a href="{{ route('ticket.delete', ['id' => $ticket->id]) }}" class="btn btn-warning">Delete</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if ($tickets == '[]')
                            <h4>No tickets.</p>
                        @endif
                        <a href="{{ route('ticket.create') }}" class="btn btn-primary mt-3">New ticket</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
