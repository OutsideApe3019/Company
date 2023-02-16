@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="align-items-center">
                                {{ __('News / ') }} {{ Str::limit($new->title, 25) }}
                            </div>
                            <div class="align-items-center">
                                @if (NewsLike::where('newId', $new->id)->where('userId', Auth::user()->id)->count() > 0)
                                    <span
                                        class="fs-6 align-items-center">{{ NewsLike::where('newId', $new->id)->count() }}</span>
                                    <button type="submit" class="btn btn-link align-items-center">
                                        <i class="fa-solid fa-thumbs-up fs-5"></i>
                                    </button>
                                @else
                                    <form action="{{ route('new.like', ['id' => $new->id]) }}" method="POST">
                                        @csrf

                                        <span
                                            class="fs-6 align-items-center">{{ NewsLike::where('newId', $new->id)->count() }}</span>
                                        <button type="submit" class="btn btn-link align-items-center">
                                            <i class="fa-regular fa-thumbs-up fs-5"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-break">
                            <h1>{{ $new->title }}</h1>
                            <hr>
                            <p>{!! Str::markdown($new->text) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('News / ') }} {{ Str::limit($new->title, 25) }} / Comments
                    </div>
                    <div class="card-body">
                        <div class="text-break">
                            <h2>Comments</h2>
                            <hr>
                            @if($comments == '[]')
                                No comments.
                            @else
                                @foreach ($comments as $comment)
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <a
                                                href="{{ route('user', ['username' => User::find($comment->userId)->username]) }}">{{ User::find($comment->userId)->username }}</a>
                                        </div>
                                        <div class="card-body text-break">
                                            {!! Str::markdown($comment->text) !!}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                Write a comment
                            </div>
                            <div class="card-body">
                                <form action="{{ route('new.comment', ['id' => $new->id]) }}" method="POST">
                                    @csrf

                                    <textarea name="text" id="text" class="form-control @error('text') is-invalid @enderror"
                                        placeholder="You can use markdown!">{{ old('text') }}</textarea>
                                    <div id="textHelp" class="form-text">Max 500 characters</div>
                                    <div id="textHelp" class="form-text">You can use markdown!</div>
                                    @error('text')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
