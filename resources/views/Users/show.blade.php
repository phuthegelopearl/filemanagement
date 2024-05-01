@extends('layouts.user_type.auth')
@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    User Information
                </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="row">
                    <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="row">
                    <label for="usertype" class="col-md-4 col-form-label text-md-end text-start"><strong>User Type:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ ucfirst($user->userType) }}
                    </div>
                </div>

                <div class="row">
                    <label for="password" class="col-md-4 col-form-label text-md-end text-start"><strong>Password:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        *****
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
