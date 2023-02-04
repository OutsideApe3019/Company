@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Contact us') }}
                    </div>
                    <div class="card-body">
                        <p>Email: <b>support@company.com</b>.</p>
                        <p>Or contact us <b><a href="{{ route('support') }}">here</a></b>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
