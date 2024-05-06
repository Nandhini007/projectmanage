@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Add Task</strong></div>
            <div class="card-body">
            <form method="post" action="{{url('add_task/')}}" id="taskForm">
                @csrf
            <div class="form-group">
                <label>Team Member<span class="error">*</span></label>
                {!! Form::select('team', $user, '', ['class' => 'form-control', 'placeholder' => 'Select']) !!}
                <span class="text-danger">{{$errors->first('team')}}</span>                                
            </div>            
            <div class="form-group">
                <label>Project<span class="error">*</span></label>
                {!! Form::select('project', $project, '', ['class' => 'form-control', 'placeholder' => 'Select']) !!}
                <span class="text-danger">{{$errors->first('project')}}</span>                                
            </div>            
            <div class="form-group">
                <label>End Date<span class="error">*</span></label>
                {!!Form::date('end_date','',['id'=>'end_date','class'=>'form-control','placeholder'=>'End Date'])!!}
                <span class="text-danger">{{$errors->first('end_date')}}</span>                
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>    
<script type="text/javascript">
$(document).ready(function() {
    $('#taskForm').validate({
        rules: {
            team: {
                required: true,
            },
            project: {
                required: true
            },
            end_date: {
                required: true
            }

        },
    });
});
</script>
