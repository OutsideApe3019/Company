@extends('layouts.app')

@section('content')
    @php
        // News::factory()->create();
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Home') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @auth
                            Welcome, {{ Auth::user()->username }}!
                        @else
                            {{ __('You are not logged in.') }}
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-15">
                <div class="card mt-3">
                    <div class="card-header">
                        {{ __('News') }}
                    </div>
                    <div class="card-body">
                        @if (count($news) > 0)
                            {{ $news->links() }}
                            @foreach ($news as $new)
                                @php
                                    $totalComments = NewsComment::where('newId', $new->id)->count();
                                @endphp

                                <div class="card mb-3">
                                    <div class="card-header">
                                        {{ Str::limit($new->title, 100) }}
                                    </div>
                                    <div class="card-body">
                                        {!! Str::limit(Str::markdown($new->text), 1000) !!}
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if ($totalComments > 0)
                                                {{ $totalComments }} comments.
                                            @else
                                                No comments.
                                            @endif
                                            <a href="{{ route('new', ['id' => $new->id]) }}" class="btn btn-primary">Read
                                                more...</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $news->links() }}
                        @else
                            No news found.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
