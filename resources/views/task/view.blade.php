@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    <h3>Manage Task</h3>
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header"><strong>View Task</strong>
                <div class="text-right">
                    <a href="{{url('add_task/')}}" class="btn btn-info">Assign Task</a>
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
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("change", ".completed-checkbox", function() {
            var taskId = $(this).data("id");
            var isChecked = $(this).is(":checked");

            // Perform AJAX request
            $.ajax({
                url: "{{ url('update_task_status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    task_id: taskId,
                    is_completed: isChecked ? 1 : 0
                },
                success: function(response) {
                    $('#success-alert').html(response.message).show();
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                }
            });
        });
    });
</script>
@endpush