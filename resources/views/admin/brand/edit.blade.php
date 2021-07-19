@extends('admin.admin_master')

@section('admin')

  <div class="py-12">   
      {{-- message --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success') }}</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Edit Brand</div>
                <div class="card-body">
                  <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">

                    <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Update Brand Name</label>
                      <input 
                        type="text" 
                        class="form-control" 
                        name="brand_name" 
                        id="exampleInputEmail1" 
                        aria-describedby="emailHelp"
                        value="{{  $brand->brand_name  }}"
                      >
                      @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Update Brand Image</label>
                      <input 
                        type="file"
                        class="form-control" 
                        name="brand_image" 
                        id="exampleInputEmail1" 
                        aria-describedby="emailHelp"
                        value="{{  $brand->brand_image  }}"
                      >
                      @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group mt-4">
                      <img src="{{ asset($brand->brand_image) }}" style="height: auth; width: 400px;" alt="{{  $brand->brand_name  }}">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Brand</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
  
@endsection