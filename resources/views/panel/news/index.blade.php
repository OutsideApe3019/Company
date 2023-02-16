@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Panel / News') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="d-flex justify-content-around">
                            <div class="btn btn-primary text-center">
                                <span class="fs-1">{{ $totalNews }}</span>
                                <br>
                                <span class="fs-5">total news.</span>
                            </div>
                        </div>
                        <br>
                        <a class="btn btn-primary" href="{{ route('panel.news.create') }}">New new</a>
                        @if (!$news->isEmpty())
                            <br>
                            {{ $news->links() }}
                            <div class="news scroll d-flex justify-content-center align-items-center">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Text</th>
                                            <th scope="col">Likes</th>
                                            <th scope="col">Comments</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Updated at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $new)
                                            <tr>
                                                <th scope="row">{{ $new->id }}</th>
                                                <td>{{ Str::limit($new->title, 25) }}</td>
                                                <td>{{ Str::limit($new->text, 25) }}</td>
                                                <td>{{ NewsLike::where('newId', $new->id)->count() }}</td>
                                                <td>{{ NewsComment::where('newId', $new->id)->count() }}</td>
                                                <td>{{ Helpers::class()->date($new->created_at) }}</td>
                                                <td>{{ Helpers::class()->date($new->updated_at) }}</td>
                                                <td>
                                                    <a href="{{ route('new', ['id' => $new->id]) }}"
                                                        class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            {{ $news->links() }}
                            <br>
                        @else
                            <br>
                            <br>
                            <p class="text-center">No news found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
