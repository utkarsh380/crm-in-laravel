@extends('layouts.master')

@section('title', '| Users')

@section('content')
<div>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-users"></i> User Administration </li>
  </ol>
</nav> 
   </div>
<ol class="breadcrumb p-3 border bg-light">

<li> <a href="{{url('users/create/')}}" class="btn btn-info mb-2" id="create-new-lead">Add User</a></li>
<li><a href="{{url('users')}}" class="btn btn-secondary mb-2" id="create-new-lead">All Users</a></li>

</ol>
<div class="container">

<div class="col-lg-10 col-lg-offset-1">
    <h1><a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped data-table">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Roles</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
    
                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a> -->

</div>
</div>

@endsection


@push('script')

<script type="text/javascript">
  $(function () { 
    var table = $('.data-table').DataTable(); 
  });
</script>
@endpush