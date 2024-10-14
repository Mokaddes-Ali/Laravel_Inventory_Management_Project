@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Category</h1>

        <div class="row">
            <div class="col-md-8">
                <form action="{{ route('categories.update') }}" method="POST">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remarks Field -->
                    <div class="form-group mb-3">
                        <label for="remarks">Remarks:</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks" id="remarks">{{ old('remarks', $category->remarks) }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
