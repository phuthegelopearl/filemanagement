@extends('layouts.app')

@section('auth')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
        @include('layouts.navbars.auth.nav')
        <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card card-frame">
            <div class="card-body">
                <h6>Client Name: {{ $file->client_name }} Documents</h6>
                <a class="badge bg-gradient-secondary float-end mt-4 mx-2" href="{{ route('home') }}">Back</a>
            </div>
        </div>
           @if(auth()->user()->userType == 'admin')
                <!-- Button trigger modal -->
                <button type="button" class="btn bg-gradient-secondary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Upload new document
                </button>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload New Document</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('upload-document') }}" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="container-fluid mt-0">
                                    @csrf
                                    <input type="hidden" class="form-control" value="{{ $file->id }}" name="file_id">
                                    <div class="mb-3">
                                        <label for="document" class="form-label">Document name:</label>
                                        <input type="text" class="form-control" id="document" name="document_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Select file:</label>
                                        <input type="file" class="form-control" id="file" name="attachment">
                                    </div>
                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn bg-gradient-info"  value="Save">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
           
            <div class="card">
                
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Document ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Document Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Attachment</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs text-secondary mb-0">{{ $document->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $document->document_name }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <a href="{{ route('download', $document->id) }}">{{ $document->attachment }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </main>
@endsection