@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="post" action="{{ route('posts.search') }}">
             @csrf
            <div class="form-group">
              <label>Search</label>
              <input type="text" name="title" style="max-width:240px;" class="form-control" placeholder="Enter post title" >
            <button type="submit" class="btn btn-outline-dark" style="margin-left:260px;margin-top:-60px;" >Search</button>
            </form>


            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($posts as $post)
                  <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td style="max-width:500px">{{ $post->description }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>          
              <div style="float:right;">
                  {{ $posts->links() }}
              </div>

        </div>
    </div>
</div>
@endsection
