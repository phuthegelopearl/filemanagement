
@extends('layouts.user_type.auth')
@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <p>Back to: 
                    <a href="{{ route('home') }}"><strong>Admin Dashboard</strong></a>
                </p>

        <div class="card">
            <div class="card-header">User List</div>
            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New user</a>

                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->userType }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn  btn-secondary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a> 
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Delete</button>  
                                </form>
                                
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No user Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  {{ $users->links() }}

            </div>
        </div>
    </div>    
</div>
    
@endsection