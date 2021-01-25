@extends('layouts.master')

@section('title', '| Edit User')

@section('content')
<div>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class='fa fa-user-plus'></i> Edit {{$user->name}}</a></li>
 
  </ol>
</nav> 
   </div>

<ol class="breadcrumb p-3 border bg-light">

<li> <a href="{{url('users/create/')}}" class="btn btn-info mb-2" id="create-new-lead">Add User</a></li>
<li><a href="{{url('users')}}" class="btn btn-secondary mb-2" id="create-new-lead">All Users</a></li>

</ol>
<div class='col-lg-4 col-lg-offset-4'>


    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Give Role</b></h5>

 
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

@endsection