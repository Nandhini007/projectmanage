@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Add User</strong></div>
            <div class="card-body">
            <form method="post" action="{{url('add_user/')}}" id="userForm">
                @csrf
            <div class="form-group">
                <label>Name <span class="error">*</span></label>
                {!!Form::text('name','',['id'=>'name','class'=>'form-control','placeholder'=>'Name'])!!}
                <span class="text-danger">{{$errors->first('name')}}</span>                
            </div>
            <div class="form-group">
                <label>Email<span class="error">*</span></label>
                {!!Form::text('email','',['id'=>'email','class'=>'form-control','placeholder'=>'Email'])!!}
                <span class="text-danger">{{$errors->first('email')}}</span>                
            </div>            
            <div class="form-group">
                <label>Password<span class="error">*</span></label>
                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) !!}
                <span class="text-danger">{{$errors->first('password')}}</span>                
            </div>            
            <div class="form-group">
                <label>User Type<span class="error">*</span></label>
                {!! Form::select('user_type', ['Admin' => 'Admin', 'Project Manager' => 'Project Manager', 'Team Member' => 'Team Member'], '', ['class' => 'form-control', 'placeholder' => 'Select']) !!}
                <span class="text-danger">{{$errors->first('user_type')}}</span>                                
            </div>
            <div class="form-group">
                <label>Status<span class="error">*</span></label>
                {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], '', ['class' => 'form-control', 'placeholder' => 'Select']) !!}
                <span class="text-danger">{{$errors->first('status')}}</span>
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
            password: {
                required: true,
            },            
            status: {
                required: true
            },
            user_type: {
                required: true
            }            
        },
        messages: {
            name: {
                required: 'Name field is required',            
            },
            email: {
                required: 'Email is required',
            },
            password: {
                required: 'Password is required',
            },            
            status: {
                required: 'Status is required'
            },
            user_type: {
                required: 'User type is required'
            }                        
        }
    });
});
</script>
