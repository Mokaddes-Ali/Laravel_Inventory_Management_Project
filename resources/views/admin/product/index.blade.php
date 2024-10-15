@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>All Products</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->isEmpty())
                <p>No products available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
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
                                    <img src="{{ asset('productImage/' . $product->img_url) }}" alt="{{ $product->name }}" width="70" height="70">
                                @else
                                    <img src="{{ asset('default.jpg') }}" alt="No Image" width="70" height="70">
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
                                    <span class="badge" style="background-color: #28a745; color: #fff;">Active</span> <!-- Custom Green -->
                                @else
                                    <span class="badge" style="background-color: #dc3545; color: #fff;">Inactive</span> <!-- Custom Red -->
                                @endif
                            </td>

                            <td class="d-flex justify-content-start">
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

                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }} <!-- Pagination -->
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
