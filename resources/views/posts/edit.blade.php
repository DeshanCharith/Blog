@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Post Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Enter post title" required value="{{ $post->title }}">
                        </div>
                        <div class="form-group mt-2">
                            <label>Post Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter post description" rows="10" required>{{ $post->description }}</textarea>
                          </div>
                        <div class="form-group mt-2">
                            <input class="form-control" name="thumbnail" type="file">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
