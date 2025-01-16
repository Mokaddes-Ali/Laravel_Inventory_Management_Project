@extends('layouts.master')

@section('content')
<div class="card mx-auto shadow-sm border-0" style="max-height: 480px; max-width: 950px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-1">
        <h5 class="mb-0">Add Customer</h5>
        <a href="{{ url('/customer/show') }}" class="btn btn-outline-light btn-sm">View Customers</a>
    </div>

    <div class="card-body px-4 py-3">
        <form id="customerForm" method="POST" action="{{ url('/customer/submit') }}" enctype="multipart/form-data">
            @csrf
        <div class="d-flex flex-wrap">
            <!-- Name Input -->
            <div class="form-group mb-1">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control form-control-light @error('name') is-invalid @enderror"
                       id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
              <!-- Status -->
              <div class="form-group col-md-6 mb-2">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

            <!-- Email Input -->
            <div class="form-group mb-1">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control form-control-light @error('email') is-invalid @enderror"
                       id="email" placeholder="email@example.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Mobile Number Input -->
            <div class="form-group mb-1">
                <label for="number" class="form-label">Mobile</label>
                <input type="text" name="number" class="form-control form-control-light @error('number') is-invalid @enderror"
                       id="number" placeholder="Mobile Number" value="{{ old('number') }}" required>
                @error('number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Address Input -->
            <div class="form-group mb-1">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control form-control-light @error('address') is-invalid @enderror"
                       id="address" placeholder="Address City" value="{{ old('address') }}" required>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Image Input -->
            <div class="form-group mb-1">
                <label for="pic" class="form-label">Profile Image</label>
                <input type="file" name="pic" class="form-control form-control-light @error('pic') is-invalid @enderror"
                       id="pic" required>
                @error('pic')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success px-4">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
