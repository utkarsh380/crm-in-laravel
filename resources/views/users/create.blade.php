@extends('layouts.master')

@section('title', '| Add User')

@section('content')
<div>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class='fa fa-user-plus'></i> Add User</a></li>
    <li class="breadcrumb-item active" aria-current="page">Leads</li>
  </ol>
</nav> 
   </div>

<ol class="breadcrumb p-3 border bg-light">

<li> <a href="{{url('users/create/')}}" class="btn btn-info mb-2" id="create-new-lead">Add User</a></li>
<li><a href="{{url('users')}}" class="btn btn-secondary mb-2" id="create-new-lead">All Users</a></li>

</ol>

<div class="container">
<div class='col-lg-4 col-lg-offset-4'>

    
    

    {{ Form::open(array('url' => 'users')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>

    <div class='form-group'>
    <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    User Type
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    
    @foreach ($roles as $role)
    <a class="dropdown-item" href="#" id="{{$role->id}}">{{ ucfirst($role->name) }}</a>
           
        @endforeach
  </div>
</div>
      
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
</div>
@endsection