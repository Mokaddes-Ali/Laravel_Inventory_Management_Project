{{-- @extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
        @can('role-edit')
            <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Add New User</a>
            @endcan
        </div>
    </div>
</div>

@session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       @can('role-edit')
       <th width="280px">Action</th>
       @endcan
   </tr>
   @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            {{-- //not empty --}}
       {{-- @if (!empty($user->getRoleNames()))
       @foreach ($user->getRoleNames() as $role)
       {{ $role}}
       @endforeach

       @endif
        </td>
        <td>
            @can('role-edit')
             <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                @endcan
           @can('role-edit')
             <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             @endcan
              <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')
                  @can('role-edit')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                  @endcan
              </form>
        </td>
    </tr>
 @endforeach
</table>
{{ $user->links() }}

@endsection --}}

@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            @can('role-edit')
                <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Add New User</a>
            @endcan
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
   <tr>
       <th>No</th>
       <th>Name</th>
       <th>Email</th>
       <th>Roles</th>
       @can('role-edit')
           <th width="280px">Action</th>
       @endcan
   </tr>
   @foreach ($data as $key => $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if (!empty($user->getRoleNames()))
                @foreach ($user->getRoleNames() as $role)
                    {{ $role }}
                @endforeach
            @endif
        </td>
        <td>
            @can('role-edit')
                <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form>
            @endcan
        </td>
    </tr>
   @endforeach
</table>

<!-- Use $data for pagination links -->
{{ $data->links() }}

@endsection

