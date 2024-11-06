@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Invoices</h1>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Add New Invoice</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Discount</th>
                <th>VAT</th>
                <th>Payable</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->discount }}</td>
                <td>{{ $invoice->vat }}</td>
                <td>{{ $invoice->payable }}</td>
                <td>{{ $invoice->paid }}</td>
                <td>{{ $invoice->due }}</td>
                <td>
                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
