@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4 px-4 p-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>All Files</h6>
                    </div>
                    <div class="row">
                    <div class="col-10">
                            
                        </div>
                        <div class="col-2">
                            <a class="btn btn-sm btn-secondary" href="{{ route('file.create') }}">Create File</a>
                        </div>
                    </div>
                    <li class="nav-item pb-2">
    <a class="nav-link {{ (Request::is('users.index') ? 'active' : '') }}" href="{{ route('users.index') }}">
        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center text-dark {{ (Request::is('users.index') ? 'text-white' : 'text-dark') }}" aria-hidden="true"></i>
        </div>
        <span class="nav-link-text ms-1">User Management</span>
    </a>
</li>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0" id="example"  class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Client name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Plot Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Place of allocation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($files as $file)
                                    <tr>
                                        <td>{{  $file->file_number }}</td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{  $file->client_name }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">{{  $file->plot_number }}</div>
                                        </td>
                                        <td class="align-middle">{{  $file->category }}</td>
                                        <td class="align-middle">{{  $file->place_of_allocation }}</td>
                                        <td>
                                            <a href="{{ route('file.show', $file->id) }}" class="btn btn-sm btn-info">Open</a>
                                            <a href="{{ route('file.edit', $file->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                           
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirmation dialog -->
    <div id="confirmation-dialog" title="Confirmation">
        <p>Are you sure you want to delete this record?</p>
    </div>

@endsection