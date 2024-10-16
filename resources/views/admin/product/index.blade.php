@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center"  style="height:60px">
            <h3>All Products</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->isEmpty())
                <p class="text-muted">No products available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Product Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Cost</th>
                                <th>Code</th>
                                <th>Units</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->img_url)
                                        <img src="{{ asset('productImage/' . $product->img_url) }}" alt="{{ $product->name }}" class="img-thumbnail" width="70" height="70">
                                    @else
                                        <img src="{{ asset('default.jpg') }}" alt="No Image" class="img-thumbnail" width="70" height="70">
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->brand->brandName}}</td>
                                <td>${{ $product->price }}</td>
                                <td>${{ $product->cost }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ url('/products/edit/' . $product->id) }}" class="btn btn-primary btn-sm me-2">Edit</a>
                                    <form action="{{ url('/products/delete/' . $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
