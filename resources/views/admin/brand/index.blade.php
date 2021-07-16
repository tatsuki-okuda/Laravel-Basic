<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         All Brand
      </h2>
  </x-slot>

  <div class="py-12">
   
    <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="card">

                 {{-- message --}}
                 @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                 @endif

                <div class="card-header">All Brand</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">SL No</th>
                      <th scope="col">Brandy Name</th>
                      <th scope="col">Brand Image</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($brands as $brand)
                      <tr>
                        {{-- ページネーションでもカラムの番号が連番になる --}}
                        <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                          <img src="" alt="">
                        </td>
                        <td>
                          @if ($brand->created_at === NULL)
                            <span class="text-danger">No Date Set</span>
                          @else
                            {{-- {{ $brand->created_at->diffForHumans() }} --}}
                            {{-- query builder --}}
                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                          <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- ページネーション --}}
                {{ $brands->links() }}
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-header">Add Brand</div>
                <div class="card-body">

                  <form action="{{ route('store.category') }}" method="POST">
                    @csrf

                    <div class="form-group">
                      <label for="brand_name" class="form-label">Brand Name</label>
                      <input type="text" class="form-control" name="brand_name" id="brand_name" aria-describedby="emailHelp">
                      @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="brand_image" class="form-label">Brand Image</label>
                      <input type="file" class="form-control" name="brand_image" id="brand_image" aria-describedby="emailHelp">
                      @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
  
                    <button type="submit" class="btn btn-primary mt-3">Add Brand</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>

  </div>
</x-app-layout>
