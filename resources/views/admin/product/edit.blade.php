@extends('layouts.master')

@section('content')
<div class="container mt-2">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white" style="height:30px">
            <h3>Edit Product</h3>
        </div>
        <div class="card-body p-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/products/update/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Product Name -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brand -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" class="form-control" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brandName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Price -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>

                    <!-- Cost -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="cost">Cost</label>
                        <input type="text" name="cost" class="form-control" value="{{ $product->cost }}" required>
                    </div>

                    <!-- Code -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control" value="{{ $product->code }}" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Units -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="unit">Units</label>
                        <input type="text" name="unit" class="form-control" value="{{ $product->unit }}" required>
                    </div>

                    <!-- Product Image with Preview -->
                    <div class="form-group col-md-4 mb-2 d-flex align-items-center">
                        @if($product->img_url)
                            <div class="mr-3">
                                <img src="{{ asset('productImage/' . $product->img_url) }}" alt="{{ $product->name }}" width="60" height="60">
                            </div>
                        @endif
                        <div>
                            <label for="img_url">Product Image</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group col-md-4 mb-2">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- Details -->
                    <div class="form-group col-md-12 mb-2">
                        <label for="details">Details</label>
                        <textarea name="details" class="form-control">{{ $product->details }}</textarea>
                    </div>
                </div>


                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
