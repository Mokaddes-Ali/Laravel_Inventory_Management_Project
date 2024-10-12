@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Show All Expense List
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
        <th scope="col">Date</th>
        <th scope="col">ExpenseAmount</th>
        <th scope="col">Note</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
      <tr>
        <th scope="row">{{ $row['id'] }}</th>
        <td>{{$row['expense']['project_name']}}</td>
        <td>{{$row['date']}}</td>
        <td>{{$row['expense_amount']}}</td>
        <td>{{$row['note']}}</td>

        <td>
            <a class="btn btn-primary btn-sm," href="{{ url('/expense/edit' , $row -> id) }}">edit</a>
            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row -> id)}}">delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection



