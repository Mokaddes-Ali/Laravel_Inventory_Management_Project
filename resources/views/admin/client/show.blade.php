@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Show Client
</div>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
<table class="table table-striped table-responsive table-dark">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Number</th>
        <th scope="col">Address</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
      <tr>
        <th scope="row">{{ $row['id'] }}</th>
        <td>{{ $row['name'] }}</td>
        <td>{{ $row['email'] }}</td>
        <td>{{ $row['number'] }}</td>
        <td>{{ $row['address'] }}</td>
        <td>
            <img src="{{ asset('images/'.$row['pic']) }}" alt="img" width="50" height="50">
        </td>
        <td>
            <a class="btn btn-primary btn-sm," href="{{ url('/edit/client' , $row -> id) }}">edit</a>
            <a class="btn btn-danger btn-lg" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row -> id)}}">delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection

