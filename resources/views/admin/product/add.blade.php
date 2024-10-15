@extends('layouts.master')


@section('content')
<div class="container">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select name="brand_id" class="form-control" required>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="text" name="cost" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="unit">Unit</label>
            <input type="text" name="unit" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="img_url">Image URL</label>
            <input type="text" name="img_url" class="form-control">
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create Product</button>
    </form>
</div>
@endsection
