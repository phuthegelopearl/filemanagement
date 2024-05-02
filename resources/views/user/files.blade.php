@extends('layouts.app')

@section('auth')
    @if(\Request::is('static-sign-up')) 
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')
    
    @elseif (\Request::is('static-sign-in')) 
        @include('layouts.navbars.guest.nav')
            @yield('content')
        @include('layouts.footers.guest.footer')
    
    @else
        @if (\Request::is('profile'))  
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('layouts.navbars.auth.nav')
            </div>
        @else
            @include('layouts.navbars.auth.user-sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.nav')
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header pb-0">
                                    <h6>All Customer Files</h6>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center justify-content-center mb-0" id="example"  class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">File number</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Client</th>
                                                 <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Assigned</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Barcode</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($files as $file)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">{{ $file->file_number }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">{{ $file->client_name }}</p>
                                                </td>
                                                 <td>
                                                    <p class="text-sm font-weight-bold mb-0">{{ $file->user ? $file->user->name : 'Not assigned' }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                    {!! DNS1D::getBarcodeSVG($file->file_number, "C39", 1, 25, '#2A3239') !!}
                                                    </div>
                                                </td>
                                               
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                         <a href="{{ route('file.show', $file->id) }}" class="btn btn-sm btn-info custom-btn">
                                                            <span class="btn-inner--icon"><i class="fa fa-folder-open" style="font-size: 10px;"></i></span>
                                                        </a>
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
                @include('layouts.footers.auth.footer')
            </main>
        @endif
        @include('components.fixed-plugin')
    @endif
@endsection