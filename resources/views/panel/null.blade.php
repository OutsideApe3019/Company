@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $title }}
                    </div>
                    <div class="card-body">
                        <p>{{ $body }}</p>
                        <br>
                        <a href="{{ route('panel.users') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
