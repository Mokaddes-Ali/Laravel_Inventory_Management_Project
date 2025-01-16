@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5 mt-2">
       @can('customer-create')
        <a href="{{ url('/customer') }}" class=""><button type="button" class="btn btn-success display-4">Add Customer</button></a>
        @endcan
    </div>
        <div class="mx-5 mt-2 text-center display-6">
        List of Customer
    </div>
    <a href="{{ url('/customer-export1') }}" class="mx-2 mt-3"><button type="button" class="btn btn-success display-4">Excel</button></a>
            <a href="{{ url('/customer-export2') }}" class="mt-3 mx-2"><button type="button" class="btn btn-success display-4">CSV</button></a>
            <a href="{{ url('/customer-export3') }}" class="mt-3 mx-2"><button type="button" class="btn btn-success display-4">PDF</button></a>
    </div>
<table class="table table-striped table-responsive table-dark">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Number</th>
        <th scope="col">Address</th>
        <th scope="col">Slug</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
      <tr>
        <th scope="row">{{ $row['id'] }}</th>
        <td>
            <img src="{{ asset('images/'.$row['pic']) }}" alt="img" width="50" height="50">
        </td>
        <td>{{ $row['name'] }}</td>
        <td>{{ $row['email'] }}</td>
        <td>{{ $row['number'] }}</td>
        <td>{{ $row['address'] }}</td>
        <td>{{ $row['slug'] }}</td>
        <td>
            @can('customer-edit')
            <!-- Edit Button -->
            <a class="btn btn-primary btn-sm" href="{{ url('/customer/edit', $row->id) }}">
                <i class="fa fa-pencil-alt"></i>
            </a>
            @endcan

            <!-- View Button -->
            <a href="{{ route('customer.dataShow', $row->id) }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye"></i>
            </a>

            @can('customer-delete')

            <!-- Delete Button -->
            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row->id) }}">
                <i class="fa fa-times"></i>
            </a>
            @endcan
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $all->links() }}

@endsection

