@extends('layouts.master')


@section('content')
<div class="container">
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Cost</th>
                <th>Unit</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->brand->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->cost }}</td>
                <td>{{ $product->unit }}</td>
                <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
