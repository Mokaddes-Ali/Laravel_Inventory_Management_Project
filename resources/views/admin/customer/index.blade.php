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
        <div class="card-body">
            <!-- Display Profile Picture at the Top -->
            @if($customer->pic)
                <div class="mb-4 text-center">
                    <img src="{{ asset('images/'. $customer->pic) }}" alt="{{ $customer->name }}" class="rounded-circle img-thumbnail" style="width: 200px; height: 200px;">
                </div>
            @else
                <p class="text-muted"><strong>Profile Picture:</strong> Not Available</p>
            @endif

            <!-- Customer Name -->
            <h4 class="card-title text-center mb-4">{{ $customer->name }}</h4>

            <!-- Customer Information in Two Columns -->
            <div class="row">
                <div class="col-md-6">
                    <p class="card-text"><strong>Email:</strong> {{ $customer->email }}</p>
                    <p class="card-text"><strong>Number:</strong> {{ $customer->number ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $customer->status == 1 ? 'Active' : 'Inactive' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="card-text"><strong>Address:</strong> {{ $customer->address ?? 'N/A' }}</p>
                    <p class="card-text"><strong>Slug:</strong> {{ $customer->slug ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

