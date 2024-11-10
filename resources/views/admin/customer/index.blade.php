@extends('layouts.master')

@section('content')
<div class="container">
    <div class="">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Customer Details</h3>
            <a href="{{ url('/customer/show') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body text-center">
            <!-- Display Profile Picture at the Top -->
            @if($customer->pic)
                <div class="mb-4">
                    <img src="{{ asset('images/'. $customer->pic) }}" alt="{{ $customer->name }}" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;">
                </div>
            @else
                <p class="text-muted"><strong>Profile Picture:</strong> Not Available</p>
            @endif

            <!-- Customer Name -->
            <h4 class="card-title">{{ $customer->name }}</h4>

            <!-- Customer Information -->
            <div class="mt-3">
                <p class="card-text"><strong>Email:</strong> {{ $customer->email }}</p>
                <p class="card-text"><strong>Number:</strong> {{ $customer->number ?? 'N/A' }}</p>
                <p class="card-text"><strong>Address:</strong> {{ $customer->address ?? 'N/A' }}</p>
                <p class="card-text"><strong>Slug:</strong> {{ $customer->slug ?? 'N/A' }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $customer->status == 1 ? 'Active' : 'Inactive' }}</p>


            </div>
        </div>
    </div>
</div>
@endsection
