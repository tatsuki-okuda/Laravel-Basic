<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         All Category
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

                <div class="card-header">All Category</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">SL No</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">User</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                      <tr>
                        {{-- ページネーションでもカラムの番号が連番になる --}}
                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->user->name}}</td>
                        {{-- query builderだと直接マージされるのでそのままusernameを指定できる。 --}}
                        {{-- <td>{{ $category->name}}</td> --}}
                        <td>
                          @if ($category->created_at === NULL)
                            <span class="text-danger">No Date Set</span>
                          @else
                            {{-- {{ $category->created_at->diffForHumans() }} --}}
                            {{-- query builder --}}
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                          @endif
                        </td>
                        <td>
                          <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                          <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{-- ページネーション --}}
                {{ $categories->links() }}
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">

                  <form action="{{ route('store.category') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1" class="form-label">Category Name</label>
                      <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('category_name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
  
                    <button type="submit" class="btn btn-primary mt-3">Add Category</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>


      {{-- trash --}}
      <div class="container mt-8">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Trash List</div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">SL No</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">User</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($trachCat as $category)
                    <tr>
                      {{-- ページネーションでもカラムの番号が連番になる --}}
                      <th scope="row">{{ $trachCat->firstItem()+$loop->index }}</th>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ $category->user->name}}</td>
                      {{-- query builderだと直接マージされるのでそのままusernameを指定できる。 --}}
                      {{-- <td>{{ $category->name}}</td> --}}
                      <td>
                        @if ($category->created_at === NULL)
                          <span class="text-danger">No Date Set</span>
                        @else
                          {{-- {{ $category->created_at->diffForHumans() }} --}}
                          {{-- query builder --}}
                          {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                        @endif
                      </td>
                      <td>
                        <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">ReStore</a>
                        <a href="{{ url('pdelete/restore/'.$category->id) }}" class="btn btn-danger">P Delete</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{-- ページネーション --}}
              {{ $trachCat->links() }}
            </div>
          </div>
        </div>
      </div>

  </div>
</x-app-layout>
