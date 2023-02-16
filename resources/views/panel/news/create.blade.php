@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        {{ __('New new') }}
                    </div>
                    <div class="card-body">
                        <div class="text-break">
                            <form action="{{ route('panel.news.create') }}" method="POST">
                                @csrf
                                <div class=" mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}">
                                        <div id="titleHelp" class="form-text">Max 100 characters</div>
                                    @error('title')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class=" mb-3">
                                    <label for="text" class="form-label">Text</label>
                                    <textarea type="text" class="form-control @error('text') is-invalid @enderror" id="text" name="text" value="{{ old('text') }}" placeholder="You can use markdown!"></textarea>
                                    <div id="textHelp" class="form-text">You can use markdown!</div>
                                    @error('text')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('panel.alerts') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
