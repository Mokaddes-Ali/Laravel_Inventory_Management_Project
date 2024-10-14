@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-center">Add New Product</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Product Name -->
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       id="name" placeholder="Enter Product Name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Product Code -->
            <div class="form-group mt-3">
                <label for="code">Product Code</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                       id="code" placeholder="Enter Product Code (optional)" value="{{ old('code') }}">
                @error('code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Product Price -->
            <div class="form-group mt-3">
                <label for="price">Price</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                       id="price" placeholder="Enter Product Price" value="{{ old('price') }}">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category -->
            <div class="form-group mt-3">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Product Image -->
            <div class="form-group mt-3">
                <label for="img_url">Product Image</label>
                <input type="file" name="img_url" class="form-control @error('img_url') is-invalid @enderror" id="img_url">
                @error('img_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-4">Add Product</button>
        </form>
    </div>
</div>
@endsection
