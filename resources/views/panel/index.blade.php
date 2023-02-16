@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Panel') }}
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <a class="btn btn-primary text-center" href="{{ route('panel.users') }}">
                                <span class="fs-1">{{ $totalUsers }}</span>
                                <br>
                                <span class="fs-5">total users</span>
                            </a>
                            <a class="btn @if ($totalTickets > 0) btn-warning @else btn-success @endif text-center" href="{{ route('panel.tickets') }}">
                                <span class="fs-1">{{ $totalTickets }}</span>
                                <br>
                                <span class="fs-5">total tickets</span>
                            </a>
                            <a class="btn btn-primary text-center" href="{{ route('panel.alerts') }}">
                                <span class="fs-1">{{ $totalAlerts }}</span>
                                <br>
                                <span class="fs-5">total alerts</span>
                            </a>
                            <a class="btn  btn-primary  text-center" href="{{ route('panel.news') }}">
                                <span class="fs-1">{{ $totalNews }}</span>
                                <br>
                                <span class="fs-5">total news</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
