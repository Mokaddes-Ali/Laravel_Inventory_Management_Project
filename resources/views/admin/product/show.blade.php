@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Show All Project List
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
        <th scope="col">Project Name</th>
        <th scope="col">Client Name</th>
        <th scope="col">project value</th>
        <th scope="col">Paid Amount</th>
        <th scope="col">Due Amount</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
      <tr>
        <th scope="row">{{ $row['id'] }}</th>
        <td>{{ $row['project_name'] }}</td>
        <td>{{ $row->client->name }}</td>
        <td>{{ $row['project_value'] }}</td>
        <td>{{ $row['paid_amount'] }}</td>
        <td>{{ $row['due_amount'] }}</td>
        <td>
            <a class="btn btn-primary btn-sm," href="{{ url('/edit/project' , $row -> id) }}">edit</a>
            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row -> id)}}">delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
