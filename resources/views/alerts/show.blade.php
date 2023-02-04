@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        {{ __('Alert / ') }} {{ Str::limit($alert->title, 25) }}
                    </div>
                    <div class="card-body">
                        <div class="text-break">
                            <h1>{{ $alert->title }}</h1>
                            <hr>
                            <p>{{ $alert->text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
