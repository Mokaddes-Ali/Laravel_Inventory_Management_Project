@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex w-36 h-11 ">
            <div class="mx-5 mt-2">
                @can('product-create')

            <a href="{{ url('/products/create') }}" class=""><button type="button" class="btn btn-success display-4">Add Product</button></a>
            @endcan
        </div>
            <div class="mx-5 mt-2 text-center display-6">
            Product List
        </div>
        <a href="{{ url('/product-export1') }}" class="mx-2 mt-3"><button type="button" class="btn btn-success display-4">Excel</button></a>
                <a href="{{ url('/product-export2') }}" class="mt-3 mx-2"><button type="button" class="btn btn-success display-4">CSV</button></a>
                <a href="{{ url('/product-export3') }}" class="mt-3 mx-2"><button type="button" class="btn btn-success display-4">PDF</button></a>
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
                                <th>Pro. Image</th>
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
                                    @can('product-edit')
                                    <!-- Edit Button with Icon -->
                                    <a href="{{ url('/products/edit/' . $product->id) }}" class="btn btn-primary btn-sm me-2">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    @endcan

                                    <!-- View Button with Icon -->
                                    <a href="{{ route('product.dataShow', $product->id) }}" class="btn btn-info btn-sm me-2">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @can('product-delete')

                                    <!-- Delete Button with Icon -->
                                    <form action="{{ url('/products/delete/' . $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
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
