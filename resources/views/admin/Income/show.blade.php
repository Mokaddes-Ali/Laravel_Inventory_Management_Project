@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Show All Project List
</div>

<form method="GET" action="/invoice/filter">



	<div class="row mb-3">
           	<div class="col-md-4">
           		<div class="form-group">
                    <label> Start Date</label>
                    <input type="date" name="start_date" class="form-control" required autocomplete="off"
                    value="{{ old('start_date', request('start_date')) }}">
                </div>
           	</div>
           	<div class="col-md-8">

           		<div class="row">
           			<div class="col-md-6">
           				<div class="form-group">
                    <label> End Date</label>
                    <input type="date" name="end_date" class="form-control" required autocomplete="off"
                     value="{{ old('end_date', request('end_date')) }}">
                </div>
           			</div>
           			<div class="col-md-6  mt-1">
           				<div class="row">
           					<div class="col-md-2">
           						<div class="form-group pt-2">

                    <button type="submit" class="btn btn-outline-primary ">Filter</button>
                </div>
           					</div>
                <div class="col-md-2">
                	<div class="form-group pt-2">


                    <a href="{{url('/show/income')}}" type="submit" class="btn btn-outline-primary ">Reset</a>
                </div>
                </div>
           				</div>
           			</div>
           		</div>
           	</div>

           </div>
</form>

<!-- Search Form -->
{{-- <form method="GET" action="/invoice/search" class="mb-3">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label> Search</label>
                <input type="text" name="search" class="form-control" placeholder="Enter project name or note"
                value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-4 mt-1">
            <div class="form-group">
                <label> </label>
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </div>
        </div>
    </div>
</form> --}}



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
            <th scope="col">Income/Paid Amount</th>
            <th scope="col">Note</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
        <tr>
            <th scope="row">{{ $row->id }}</th>
            <td>{{$row['income']['project_name']}}</td>
            <td>{{ $row->date }}</td>
            <td>{{ $row->income_amount }}</td>
            <td>{{ $row->note }}</td>
            <td>
                <a class="btn btn-primary btn-sm me-2 d-inline-block" href="{{ url('/income/edit', $row->id) }}">Edit</a>
                <a class="btn btn-primary btn-sm me-2 d-inline-block" href="{{ url('/invoice/create', $row->project_id) }}">Invoice</a>
                <form action="{{ route('income.delete', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');" class="d-inline-block me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <a class="btn btn-secondary btn-sm d-inline-block" href="{{ url('/invoice/pdf', $row->project_id) }}">PDF</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection



