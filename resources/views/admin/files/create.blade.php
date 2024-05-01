@extends('layouts.user_type.auth')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Customer File
                </div>
                <div class="float-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('file.store') }}">
                @csrf
                    <div class="form-group">
                        <input type="text" name="file_number" class="form-control" id="exampleFormControlInput1" placeholder="File number">
                    </div>
                    <div class="form-group">
                        <input type="text" name="client_name" placeholder="Client name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            <input class="form-control" name="omang_no" placeholder="Omang Number" type="text">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                </form>
            </div>
        </div>
    </div>    
</div>
@endsection