@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Edit Product</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/products/update/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" class="form-control" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>

                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="text" name="cost" class="form-control" value="{{ $product->cost }}" required>
                </div>

                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" name="code" class="form-control" value="{{ $product->code }}" required>
                </div>

                <div class="form-group">
                    <label for="unit">Units</label>
                    <input type="text" name="unit" class="form-control" value="{{ $product->unit }}" required>
                </div>

                <div class="form-group">
                    <label for="img_url">Product Image</label>
                    <input type="file" name="img_url" class="form-control">
                    @if($product->img_url)
                        <img src="{{ asset('productImage/' . $product->img_url) }}" alt="{{ $product->name }}" width="100" height="100" class="mt-2">
                    @endif
                </div>

                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea name="details" class="form-control">{{ $product->details }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Product</button>
            </form>
        </div>
    </div>
</div>
@endsection
