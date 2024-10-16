@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Add New Product</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/products/store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Product Name -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="name">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter product name" value="{{ old('name') }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control select2" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Brand -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="brand_id">Brand <span class="text-danger">*</span></label>
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

                    <!-- Price -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="price">Price <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter product price" value="{{ old('price') }}" required>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Cost -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="cost">Cost <span class="text-danger">*</span></label>
                        <input type="number" name="cost" class="form-control" id="cost" placeholder="Enter product cost" value="{{ old('cost') }}" required>
                        @error('cost')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Product Code -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="code">Product Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="Enter product code" value="{{ old('code') }}" required>
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Units -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="unit">Units <span class="text-danger">*</span></label>
                        <input type="number" name="unit" class="form-control" id="unit" placeholder="Enter available units" value="{{ old('unit') }}" required>
                        @error('unit')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Details -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="details">Details</label>
                        <textarea name="details" class="form-control" id="details" rows="3">{{ old('details') }}</textarea>
                        @error('details')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Product Image -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="img_url">Product Image</label>
                        <input type="file" name="img_url" class="form-control-file" id="img_url">
                        @error('img_url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group col-md-6 mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
