@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Add Project</strong></div>
            <div class="card-body">
            <form method="post" action="{{url('add_project/')}}" id="projectForm">
                @csrf
            <div class="form-group">
                <label>Name<span class="error">*</span></label>
                {!!Form::text('name','',['id'=>'name','class'=>'form-control','placeholder'=>'Name'])!!}
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
            <div class="form-group">
                <label>Description<span class="error">*</span></label>
                {!!Form::text('description','',['id'=>'description','class'=>'form-control','placeholder'=>'Description'])!!}
                <span class="text-danger">{{$errors->first('description')}}</span>                
            </div>
            <div class="form-group">
                <label>Start Date<span class="error">*</span></label>
                {!!Form::date('start_date','',['id'=>'start_date','class'=>'form-control','placeholder'=>'Start Date'])!!}
                <span class="text-danger">{{$errors->first('start_date')}}</span>                
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
    $('#projectForm').validate({
        rules: {
            description: {
                required: true            
            },
            name: {
                required: true,
            },
            start_date: {
                required: true,
            },            
            end_date: {
                required: true
            }
        },
    });
});
</script>
