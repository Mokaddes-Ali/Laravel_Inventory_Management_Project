{{-- @extends('layouts.master')

@section('content')
<div class="">
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
<table class="table  table-responsive">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Number</th>
        <th scope="col">Address</th>
        <th scope="col">Slug</th>
        <th scope="col">Status</th>
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
            <span style="color: {{ $row['status'] == 0 ? '#38a169' : '#e53e3e' }}; background-color: {{ $row['status'] == 0 ? '#c6f6d5' : '#fed7d7' }};">
                {{ $row['status'] == 0 ? 'Active' : 'Inactive' }}
            </span>
        </td>


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

@endsection --}}


@extends('layouts.master')

@section('content')
<div class="container mt-2">
    <!-- Header Section with Buttons -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            @can('customer-create')
                <a href="{{ url('/customer') }}">
                    <button type="button" class="btn btn-success btn-lg">Add Customer</button>
                </a>
            @endcan
        </div>
        <div class="text-center display-6 font-weight-bold">
            List of Customers
        </div>
        <div class="d-flex space-x-3">
            <a href="{{ url('/customer-export1') }}">
                <button type="button" class="btn btn-success btn-lg">Excel</button>
            </a>
            <a href="{{ url('/customer-export2') }}">
                <button type="button" class="btn btn-success btn-lg">CSV</button>
            </a>
            <a href="{{ url('/customer-export3') }}">
                <button type="button" class="btn btn-success btn-lg">PDF</button>
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-responsive ">
        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all as $row)
                <tr>
                    <th scope="row">{{ $row['id'] }}</th>
                    <td>
                        <img src="{{ asset('images/'.$row['pic']) }}" alt="img" class="img-fluid rounded-circle" width="50" height="50">
                    </td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['email'] }}</td>
                    <td>{{ $row['number'] }}</td>
                    <td>{{ $row['address'] }}</td>
                    <td>{{ $row['slug'] }}</td>
                    <td>
                        <span class="status-badge {{ $row['status'] == 0 ? 'active' : 'inactive' }}">
                            {{ $row['status'] == 0 ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="d-flex justify-content-center align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-cogs"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">
                                @can('customer-edit')
                                    <li><a class="dropdown-item" href="{{ url('/customer/edit', $row->id) }}"><i class="fa fa-pencil-alt"></i> Edit</a></li>
                                @endcan
                                <li><a class="dropdown-item" href="{{ route('customer.dataShow', $row->id) }}"><i class="bi bi-eye"></i> View</a></li>
                                @can('customer-delete')
                                    <li><a class="dropdown-item" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row->id) }}"><i class="fa fa-times"></i> Delete</a></li>
                                @endcan
                            </ul>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $all->links() }}
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Custom Status Badge Styles */
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: bold;
        color: #fff;
        text-align: center;
    }

    /* Ensure dropdown appears below the button */
.dropdown-menu {
    left: 0 !important;
    right: auto !important;
    top: 100% !important;
}
    .status-badge.active {
        background-color: #28a745;
    }

    .status-badge.inactive {
        background-color: #dc3545;
    }

    /* Custom Table Styling */
    table th, table td {
        text-align: center;
        vertical-align: middle;
    }

    table td img {
        object-fit: cover;
    }

    table td, table th {
        padding: 10px;
    }

    /* Custom Buttons */
    .btn {
        font-size: 14px;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-sm {
        padding: 5px 12px;
    }
</style>
@endpush
