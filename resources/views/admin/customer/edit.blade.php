@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ url('/customer/show') }}">
                <button type="button" class="btn btn-secondary">Back To List</button>
            </a>
        </div>
        <h3 class="text-center">Customer Edit</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('/customer/update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $record->id }}" name="id">

            <!-- Name Input -->
            <div class="form-group">
                <label for="name" class="mb-1">Name</label>
                <input type="text" value="{{ $record->name }}" name="name" class="form-control" id="name" placeholder="Enter Name" required>
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email" class="mb-1 mt-2">Email</label>
                <input type="email" value="{{ $record->email }}" name="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>

            <!-- Mobile Number Input -->
            <div class="form-group">
                <label for="number" class="mb-1 mt-2">Mobile</label>
                <input type="number" value="{{ $record->number }}" name="number" class="form-control" id="number" placeholder="Enter Mobile Number" required>
            </div>

            <!-- Address Input -->
            <div class="form-group">
                <label for="address" class="mb-1 mt-2">Address</label>
                <input type="text" value="{{ $record->address }}" name="address" class="form-control" id="address" placeholder="Enter Address" required>
            </div>

            <!-- Image Input -->
            <div class="form-group">
                <label for="pic" class="mb-1 mt-2">Image</label>
                <input type="file" name="pic" class="form-control-file" id="pic">
                <div class="mt-2">
                    <img src="{{ asset('images/' . $record->pic) }}" alt="Customer Image" width="30" height="40" class="img-thumbnail">
                </div>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-1">Update</button>
        </form>
    </div>
</div>
@endsection
