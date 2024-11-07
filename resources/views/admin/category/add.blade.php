@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Create Category</h1>

        <row class="col-md-8">
        <form action="{{ route('category.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf


            <!-- Name Field -->
            <div class="form-group mb-3 col-md-6">
                <label for="name">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <div class="valid-feedback">Looks good!</div>
                @enderror
            </div>

            <!-- Remarks Field -->
            <div class="form-group mb-3 col-md-6">
                <label for="remarks">Remarks:</label>
                <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks"  id="remarks">{{ old('remarks') }}</textarea>
                @error('remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>

        </form>
    </row>
    </div>
@endsection

