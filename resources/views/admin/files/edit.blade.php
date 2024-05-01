@extends('layouts.app')

@section('auth')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
        @include('layouts.navbars.auth.nav')
        <div class="container-fluid py-4">
            <div class="row">
            <form method="POST" action="{{ route('file.update', [$file->id]) }}" class="col-md-8 mx-auto">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="file_number" class="form-control" id="exampleFormControlInput1" placeholder="File number">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="client_name" placeholder="Client name" class="form-control" />
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            <input class="form-control" name="plot_number" placeholder="Plot number" type="text">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-4">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                        <input class="form-control" name="place_of_allocation" placeholder="Place of allocation" type="text">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="category" placeholder="Category" class="form-control" />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="barcode" placeholder="Barcode" class="form-control" value="" />
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </main>
@endsection