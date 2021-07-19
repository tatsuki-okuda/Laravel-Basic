@extends('admin.admin_master')

@section('admin')

  <div class="py-12">
   
    <div class="container">
          <div class="row">
            <h4>Home Slider</h4>
            <a href="{{ route('add.slider') }}">
              <button class="btn btn-info">Add Slider</button>
            </a>
            <div class="col-md-12">
              <div class="card">

                 {{-- message --}}
                 @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                 @endif

                <div class="card-header">All Slider</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" width="5%">SL</th>
                      <th scope="col" width="15%">Slider Title</th>
                      <th scope="col" width="25%">Description</th>
                      <th scope="col" width="15%">Slider Image</th>
                      <th scope="col" width="15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sliders as $slide)
                      <tr>
                        <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->description }}</td>
                        <td>
                          <img src="{{ asset($slide->image) }}" style="height: 40px; width: 40px;" alt="{{ $slide->title }}">
                        </td>
                        <td>
                          <a href="{{ url('slider/edit/'.$slide->id) }}" class="btn btn-info">Edit</a>
                          <a 
                            href="{{ url('slider/delete/'.$slide->id) }}" 
                            class="btn btn-danger"
                            onclick="return confirm(' Are You Sure to Delete?')"
                          >Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $sliders->links() }}
              </div>
            </div>

          </div>
      </div>

  </div>

@endsection
