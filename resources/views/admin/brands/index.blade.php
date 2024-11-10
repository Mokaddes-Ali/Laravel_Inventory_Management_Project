@extends('layouts.master')

@section('content')
<div class="container">
    <div class="">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Brand Details</h3>
            <a href="{{ url('/brands/show') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <!-- Display Brand Image -->
            @if($brand->brandImg)
                <div class="mb-4">
                    <img src="{{ asset('BrandImage/'. $brand->brandImg) }}" alt="{{ $brand->brandName }}" class="img-fluid img-thumbnail" style="max-width: 200px;">
                </div>
            @else
                <p class="text-muted"><strong>Brand Image:</strong> Not Available</p>
            @endif

            <!-- Brand Details -->
            <h4 class="card-title"><strong>Brand Name:</strong>{{ $brand->brandName }}</h4>
            <div class="mt-3">
                <p class="card-text"><strong>Brand ID:</strong> {{ $brand->id }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $brand->created_at ? $brand->created_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
                <p class="card-text"><strong>Updated At:</strong> {{ $brand->updated_at ? $brand->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
