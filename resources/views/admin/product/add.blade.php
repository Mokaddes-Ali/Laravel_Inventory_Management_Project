@extends('layouts.master')

@section('content')
<div class="container">
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter product name" value="{{ old('name') }}" required>
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control select2" required>
                <option value="" disabled selected>Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" data-icon="fa fa-{{ $category->icon_class }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="brand_id">Brand</label>
            <select name="brand_id" class="form-control" required>
                <option value="" disabled selected>Select a brand</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->brandName }}
                </option>
                @endforeach
            </select>
            @error('brand_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" name="code" class="form-control" placeholder="Enter product code" value="{{ old('code') }}" required>
            @error('code')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" placeholder="Enter price" value="{{ old('price') }}" required>
            @error('price')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="text" name="cost" class="form-control" placeholder="Enter cost" value="{{ old('cost') }}" required>
            @error('cost')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="unit">Unit</label>
            <input type="number" name="unit" id="unit" class="form-control text-center" placeholder="Enter unit" value="{{ old('unit', 0) }}" min="0" required>
            @error('unit')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="img_url" class="mb-1 mt-2">Image</label>
            <input type="file" name="img_url" class="form-control-file @error('img_url') is-invalid @enderror"
                   id="img_url" required>
            
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" class="form-control" placeholder="Enter product details">{{ old('details') }}</textarea>
            @error('details')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Product</button>
    </form>
</div>
@endsection
