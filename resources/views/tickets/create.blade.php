@extends('layouts.app')

@section('content')
    @php
        use App\Models\Ticket;
        $a = Auth::user()->id;
        $tickets = Ticket::where('senderId', '=', $a)->get();
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('New ticket') }}
                    </div>
                    <div class="card-body">
                        <h4>New ticket</h4>
                        <form action="{{ route('ticket.create') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason</label>
                                <input type="text" name="reason" id="reason" class="form-control @error('reason') is-invalid @enderror" value="{{ old('reason') }}">
                                <div id="textHelp" class="form-text">Max 50 characters</div>
                                @error('reason')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="text" class="form-label">Explain your problem</label>
                                <textarea name="text" id="text" class="form-control @error('text') is-invalid @enderror">{{ old('text') }}</textarea>
                                <div id="textHelp" class="form-text">Max 500 characters</div>
                                @error('text')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('support') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
