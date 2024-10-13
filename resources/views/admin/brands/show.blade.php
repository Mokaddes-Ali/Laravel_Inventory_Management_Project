@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Brand Details</h1>

        <!-- Brand Details Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Field</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Brand Name:</strong></td>
                    <td>{{ $brand->brandName }}</td>
                </tr>
                <tr>
                    <td><strong>Brand Image URL:</strong></td>
                    <td>{{ $brand->brandImg ?? 'No Image' }}</td>
                </tr>
                <tr>
                    <td><strong>Creator ID:</strong></td>
                    <td>{{ $brand->creator }}</td>
                </tr>
                <tr>
                    <td><strong>Editor ID:</strong></td>
                    <td>{{ $brand->editor ?? 'Not Edited Yet' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Action Buttons -->
        <div class="mt-3">
            <!-- Edit Button -->
            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning" style="color: white;">
                Edit Brand
            </a>

            <!-- Delete Button with Confirmation -->
            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this brand?')">
                    Delete Brand
                </button>
            </form>

            <!-- Back to List Button -->
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                Back to Brands List
            </a>
        </div>
    </div>
@endsection
