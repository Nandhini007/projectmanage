@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Edit User</strong></div>
            <div class="card-body">
            <form method="post" action="{{url('edit_user/'.$result->id)}}" id="userForm">
                @csrf
            <div class="form-group">
                <label>Name <span class="error">*</span></label>
                {!!Form::text('name',$result->name,['id'=>'name','class'=>'form-control','placeholder'=>'Name'])!!}
                <span class="text-danger">{{$errors->first('name')}}</span>                
            </div>
            <div class="form-group">
                <label>Email<span class="error">*</span></label>
                {!!Form::text('email',$result->email,['id'=>'email','class'=>'form-control','placeholder'=>'Email'])!!}
                <span class="text-danger">{{$errors->first('email')}}</span>                
            </div>            
            <div class="form-group">
                <label>Password<span class="error">*</span></label>
                {!!Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Password'])!!}
                <span class="text-danger">{{$errors->first('password')}}</span>                
            </div>            
            <div class="form-group">
                <label>User Type<span class="error">*</span></label>
                {!! Form::select('user_type', ['Admin' => 'Admin', 'Project Manager' => 'Project Manager', 'Team Member' => 'Team Member'], $result->user_type, ['class' => 'form-control', 'placeholder' => 'Select']) !!}
            </div>
            <div class="form-group">
                <label>Status<span class="error">*</span></label>
                {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $result->status, ['class' => 'form-control', 'placeholder' => 'Select']) !!}
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
    $('#userForm').validate({
        rules: {
            name: {
                required: true            
            },
            email: {
                required: true,
            },
            status: {
                required: true
            },
            user_type: {
                required: true
            }            
        },
    });
});
</script>
