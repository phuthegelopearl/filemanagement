@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a href="{{ route('user.create user') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <!-- Form for creating a new user -->
    
<form method="POST" action="{{ route('user.create user') }}">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="userType" class="form-control" placeholder="userType">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Phone">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="location" class="form-control" placeholder="Location">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
            </div>
        </div>
    </div>
</form>
<!-- End of form -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
