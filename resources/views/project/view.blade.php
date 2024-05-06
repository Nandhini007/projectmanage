@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    <h3>Manage Project</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header"><strong>View Project</strong>
                <div class="text-right">
                    <a href="{{url('add_project/')}}" class="btn btn-info">Add Project</a>
                </div>
            </div>
            <div class="card-body">         
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{$dataTable->scripts()}}
@endpush