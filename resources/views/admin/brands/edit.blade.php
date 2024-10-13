@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Brand: {{ $brand->brandName }}</h1>

        <!-- Show Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('brands.update', $brand->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="brandName">Brand Name:</label>
                <input type="text" name="brandName" id="brandName" class="form-control" value="{{ old('brandName', $brand->brandName) }}" required>
            </div>

            <div class="form-group">
                <label for="brandImg">Brand Image URL (Optional):</label>
                <input type="text" name="brandImg" id="brandImg" class="form-control" value="{{ old('brandImg', $brand->brandImg) }}">
            </div>

            <div class="form-group">
                <label for="editor">Editor ID (Optional):</label>
                <input type="number" name="editor" id="editor" class="form-control" value="{{ old('editor', $brand->editor) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Brand</button>
        </form>
    </div>
@endsection
