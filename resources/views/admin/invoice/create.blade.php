@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create Invoice</h1>

    {{-- Display success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Display error messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Discount</label>
            <input type="text" name="discount" class="form-control" value="{{ old('discount') }}" required>
            @error('discount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>VAT</label>
            <input type="text" name="vat" class="form-control" value="{{ old('vat') }}" required>
            @error('vat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Payable</label>
            <input type="text" name="payable" class="form-control" value="{{ old('payable') }}" required>
            @error('payable')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Paid</label>
            <input type="text" name="paid" class="form-control" value="{{ old('paid') }}" required>
            @error('paid')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Due</label>
            <input type="text" name="due" class="form-control" value="{{ old('due') }}" required>
            @error('due')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Customer ID</label>
            <input type="text" name="customer_id" class="form-control" value="{{ old('customer_id') }}" required>
            @error('customer_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Invoice</button>
    </form>
</div>
@endsection
