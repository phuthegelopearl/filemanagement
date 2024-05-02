
@extends('layouts.user_type.auth')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h3>File Audits</h3>
                </div>
                <div class="float-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                 <div class="container">
                     <table class="table table-striped" style="width:100%" id="example">
                        <thead>
                            <tr>
                                <th>File ID</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Old Values</th>
                                <th>New Values</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($audits as $audit)
                                <tr>
                                    <td>{{ $audit->auditable_id }}</td>
                                    <td>{{ $audit->user->name }}</td>
                                    <td>
                                        @if($audit->event == 'updated')
                                              <span class="badge bg-gradient-warning">{{ $audit->event }}</span>
                                        @elseif($audit->event == 'deleted')
                                            <span class="badge bg-gradient-danger">{{ $audit->event }}</span>
                                        @else
                                            <span class="badge bg-gradient-info">{{ $audit->event }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($audit->old_values as $attribute => $value)
                                            <p><strong>{{ $attribute }}:</strong> {{ $value }}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($audit->new_values as $attribute => $value)
                                            <p><strong>{{ $attribute }}:</strong> {{ $value }}</p>
                                        @endforeach
                                    </td>
                                    <td>{{ $audit->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection