@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create Invoice</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Discount</label>
            <input type="text" name="discount" class="form-control" required>
        </div>

        <div class="form-group">
            <label>VAT</label>
            <input type="text" name="vat" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Payable</label>
            <input type="text" name="payable" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Paid</label>
            <input type="text" name="paid" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Due</label>
            <input type="text" name="due" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Customer ID</label>
            <input type="text" name="customer_id" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Invoice</button>
    </form>
</div>
@endsection
