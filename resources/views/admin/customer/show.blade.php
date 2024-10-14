@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
        <a href="{{ url('/customer') }}" class=""><button type="button" class="btn btn-success display-4">Add Customer</button></a>
      </div>
        <div class="mx-5 mt-2 text-center display-6">
        List of Customer
    </div>
    </div>
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
            <a class="btn btn-primary btn-sm," href="{{ url('/customer/edit' , $row -> id) }}"><i class="fa fa-pencil-alt"></i></a>
            <a class="btn btn-danger btn-lg" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row -> id)}}"><i class="fa fa-times"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $all->links() }}

@endsection

