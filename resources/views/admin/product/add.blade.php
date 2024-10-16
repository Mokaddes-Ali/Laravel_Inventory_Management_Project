
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
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
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter product name" required>
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
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" id="price" placeholder="Enter product price" required>
            </div>

            <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" name="cost" class="form-control" id="cost" placeholder="Enter product cost" required>
            </div>

            <div class="form-group">
                <label for="code">Product Code</label>
                <input type="text" name="code" class="form-control" id="code" placeholder="Enter product code" required>
            </div>

            <div class="form-group">
                <label for="unit">Units</label>
                <input type="number" name="unit" class="form-control" id="unit" placeholder="Enter available units" required>
            </div>

            <div class="form-group">
                <label for="details">Details</label>
                <textarea name="details" class="form-control" id="details" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="img_url">Product Image</label>
                <input type="file" name="img_url" class="form-control-file" id="img_url">
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

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
@endsection
