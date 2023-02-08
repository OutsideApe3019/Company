@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-15">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ __('Ticket - ') }} {{ $ticket->reason }}</span>
                            @if ($ticket->status !== 'closed')
                                <form action="{{ route('panel.tickets.close', ['id' => $ticket->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Close ticket</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @foreach ($ticketMsgs as $ticketMsg)
                            @if ($ticketMsg->senderId == $ticket->senderId)
                                @php
                                    $user = User::find($ticketMsg->senderId);
                                    $user = $user->username;
                                @endphp
                                <div class="d-flex justify-content-start mb-5">
                                    <div class="text-break">
                                        <div class="card text-break">
                                            <div class="card-header bg-secondary">
                                                <span class="text-white">{{ $user }}</span>
                                            </div>
                                            <div class="card-body text-break ">
                                                {{ $ticketMsg->text }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex justify-content-end mb-5">
                                    <div class="text-break">
                                        <div class="card text-break">
                                            <div class="card-header bg-primary">
                                                <span class="text-white">{{ __('You') }}</span>
                                            </div>
                                            <div class="card-body text-break ">
                                                {{ $ticketMsg->text }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <form action="{{ route('panel.tickets.edit', ['id' => $ticket->id]) }}" method="POST">
                            @csrf

                            <div class="input-group">
                                <textarea name="text" id="text" class="form-control @error('text') is-invalid @enderror" placeholder="Message"
                                    @if ($ticket->status == 'closed') disabled @endif>{{ old('text') }}</textarea>

                                <button type="submit" class="btn btn-primary input-group-text"
                                    @if ($ticket->status == 'closed') disabled @endif>
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>

                                @error('text')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div id="textHelp" class="form-text">Max 500 characters</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
