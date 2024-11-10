@extends('layouts.master')

@section('content')
<div class="container">
    <div class="">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Product Details</h3>
            <a href="{{ url('/products') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body text-center">
            <!-- Product Image Display -->
            @if($product->img_url)
                <div class="mb-4">
                    <img src="{{ asset('productImage/' . $product->img_url) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 150px; height: 150px;">
                </div>
            @else
                <p class="text-muted"><strong>Product Image:</strong> Not Available</p>
            @endif

            <!-- Product Details -->
            <h4 class="card-title">{{ $product->name }}</h4>
            <div class="row mt-3 text-left">
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Code:</strong> {{ $product->code }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Cost:</strong> ${{ number_format($product->cost, 2) }}</p>
                </div>

                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Unit:</strong> {{ $product->unit }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Details:</strong> {{ $product->details ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Slug:</strong> {{ $product->slug ?? 'N/A' }}</p>
                </div>

                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Status:</strong> {{ $product->status == 1 ? 'Active' : 'Inactive' }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Category:</strong> {{ $product->category ? $product->category->name : 'N/A' }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Brand:</strong> {{ $product->brand ? $product->brand->name : 'N/A' }}</p>
                </div>

                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Created By:</strong> {{ $product->creatorUser ? $product->creatorUser->name : 'N/A' }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Edited By:</strong> {{ $product->editorUser ? $product->editorUser->name : 'N/A' }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Created At:</strong> {{ $product->created_at ? $product->created_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
                </div>

                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Updated At:</strong> {{ $product->updated_at ? $product->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
