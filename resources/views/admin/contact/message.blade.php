@extends('admin.admin_master')

@section('admin')

  <div class="py-12">
   
    <div class="container">
          <div class="row">
            <h4>Admin Message</h4>
            <div class="col-md-12">
              <div class="card"> 
                <div class="card-header">All Contact Data</div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" width="5%">SL</th>
                      <th scope="col" width="15%">Message Name</th>
                      <th scope="col" width="25%">Email</th>
                      <th scope="col" width="25%">Subject</th>
                      <th scope="col" width="15%">Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($messages as $message)
                      <tr>
                        <th scope="row">{{ $messages->firstItem()+$loop->index }}</th>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->message }}</td>
                        <td>
                          <a 
                            href="{{ url('message/delete/'.$message->id) }}" 
                            class="btn btn-danger"
                            onclick="return confirm(' Are You Sure to Delete?')"
                          >Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $messages->links() }}
              </div>
            </div>

          </div>
      </div>

  </div>

@endsection
