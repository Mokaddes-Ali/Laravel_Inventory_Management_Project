@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ url('/customer/show') }}">
                <button type="button" class="btn btn-info">Go To List</button>
            </a>
        </div>
        <h3 class="text-center">Add Customer</h3>
    </div>

    <div class="card-body">
        <form id="customerForm" method="POST" action="{{ url('/customer/submit') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name Input -->
            <div class="form-group">
                <label for="name" class="mb-1">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       id="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email" class="mb-1 mt-2">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Mobile Number Input -->
            <div class="form-group">
                <label for="number" class="mb-1 mt-2">Mobile</label>
                <input type="number" name="number" class="form-control @error('number') is-invalid @enderror"
                       id="number" placeholder="Enter Mobile Number" value="{{ old('number') }}" required>
                @error('number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Address Input -->
            <div class="form-group">
                <label for="address" class="mb-1 mt-2">Address</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                       id="address" placeholder="Enter Address" value="{{ old('address') }}" required>
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Image Input -->
            <div class="form-group">
                <label for="pic" class="mb-1 mt-2">Image</label>
                <input type="file" name="pic" class="form-control-file @error('pic') is-invalid @enderror"
                       id="pic" required>
                @error('pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>
</div>

<!-- Client-side Validation Script -->
<script>
    document.getElementById('customerForm').addEventListener('submit', function(event) {
        // Get all form inputs
        var form = event.target;
        var inputs = form.querySelectorAll('input[required]');

        // Iterate over inputs and check if any are empty
        inputs.forEach(function(input) {
            if (!input.value) {
                input.classList.add('is-invalid');
                input.nextElementSibling?.classList.add('d-block'); // Ensure error messages are visible
                event.preventDefault(); // Stop form submission
            } else {
                input.classList.remove('is-invalid');
            }
        });
    });
</script>
@endsection
