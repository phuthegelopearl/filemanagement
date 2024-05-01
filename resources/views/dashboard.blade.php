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

                    <div class="card-body px-2">
                        <div class="table-responsive ">
                            <table class="table display" id="example">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Client name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Assigned</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Barcode</th>
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
                                            <td>
                                                {{ $file->user ? $file->user->name : 'Not assigned' }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        {!! '<img src="data:image/jpeg;base64,' . DNS1D::getBarcodeJPG($file->file_number, 'C39+') . '" alt="barcode" />' !!}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="display: flex; align-items: center;">
                                                <a href="{{ route('file.show', $file->id) }}" class="btn btn-sm btn-info custom-btn">
                                                   <span class="btn-inner--icon"><i class="fa fa-folder-open" style="font-size: 10px;"></i></span>
                                                </a>
                                                <a href="{{ route('file.edit', $file->id) }}" class="btn btn-sm btn-warning custom-btn">
                                                     <span class="btn-inner--icon"><i class="fa fa-pencil" style="font-size: 10px;"></i></span>
                                                </a>
                                            
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-sm bg-gradient-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                                        <span class="btn-inner--icon"><i class="fa fa-user-plus" style="font-size: 10px;"></i></span> Assign
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                        @foreach($users as $user)
                                                            <li>
                                                                <a class="dropdown-item assign-user" href="#" data-user-id="{{ $user->id }}" data-file-id="{{ $file->id }}">
                                                                     {{ $user->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            
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