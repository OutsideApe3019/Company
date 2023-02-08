@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Alerts') }}
                    </div>
                    <div class="card-body">
                        @isset($alerts)
                            @foreach ($alerts as $alert)
                                <div class="d-flex justify-content-between rounded-2 bg-light p-3 align-items-center mt-2 border border-1 @if ($alert->read == false) border-danger @else border-success @endif">
                                    <h4>{{ Str::limit($alert->title, 50) }}</h4>
                                    <div>
                                        <a href="{{ route('user.alerts.show', ['id' => $alert->id]) }}" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                        @empty($alerts)
                            No new alerts.
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
