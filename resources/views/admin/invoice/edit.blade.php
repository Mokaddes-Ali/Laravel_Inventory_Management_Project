@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Invoice</h1>

    <form action="{{ route('invoices.update', $invoice) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Discount</label>
            <input type="text" name="discount" value="{{ $invoice->discount }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>VAT</label>
            <input type="text" name="vat" value="{{ $invoice->vat }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Payable</label>
            <input type="text" name="payable" value="{{ $invoice->payable }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Paid</label>
            <input type="text" name="paid" value="{{ $invoice->paid }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Due</label>
            <input type="text" name="due" value="{{ $invoice->due }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Customer ID</label>
            <input type="text" name="customer_id" value="{{ $invoice->customer_id }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Invoice</button>
    </form>
</div>
@endsection
