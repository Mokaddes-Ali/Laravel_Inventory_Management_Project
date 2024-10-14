{{-- @extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-center">Product List</h4>
        <a href="{{ route('product.add') }}" class="btn btn-success float-right">Add New Product</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td><img src="{{ asset('storage/' . $product->img_url) }}" alt="Product Image" width="50"></td>
                    <td>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection --}}
