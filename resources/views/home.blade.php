@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('New Post') }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Post Title</label>
                          <input type="text" name="title" class="form-control" placeholder="Enter post title" >
                        </div>
                        <div class="form-group mt-3">
                            <label>Post Description</label>
                            <textarea class="form-control" name="description" placeholder="Enter post description" rows="10" ></textarea>
                          </div>
                        <div class="form-group mt-3">
                        <label for="date" class="form-label">Select Thumbnail</label>
                            <input class="form-control" name="thumbnail" type="file">
                        </div>

                        <div class="mb-3 mt-3 form-group" style="">
                        <label for="date" class="form-label">Date</label>
                        <input type="text"  class="form-control" {{ Form::text('date', '', array('id' => 'datepicker')) }}
                        </div>

                        
                        <div class="mb-3 mt-3 form-group" style="">
                            <label for="dept" class="form-label">Department</label>
                            <select style="" name="dept" class="custom-select custom-select-sm form-control"> 
                                <option selected>Select Department</option>
                                @foreach ($titles as $title)
                                <option value="{{ $title->title }} ">{{ $title->title }} </option>
                                <!-- <option value="DEP02">DEP02</option>
                                <option value="DEP03">DEP03</option>
                                <option value="DEP04">DEP04</option> -->
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary mt-3">Post</button>
                       
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
@endsection
