@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Edit About</h2>
    </div>
    <div class="card-body">
      <form action="{{ url('/update/homeabout/'.$about->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="exampleFormControlInput1">About Title</label>
          <input type="text" name="title" value="{{ $about->title }}" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Short Descriptiona</label>
          <textarea name="short_dis"  class="form-control" id="exampleFormControlTextarea1" rows="3">
            {{ $about->short_dis }}
          </textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Long Descriptiona</label>
          <textarea name="long_dis" class="form-control" id="exampleFormControlTextarea1" rows="3">
            {{ $about->long_dis }}
          </textarea>
        </div>

        <div class="form-footer pt-4 pt-5 mt-4 border-top">
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>




</div>
  
@endsection