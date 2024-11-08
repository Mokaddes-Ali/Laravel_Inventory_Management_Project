@extends('layouts.master')
@section('content')
<div class="container">
    <h2>Invoice List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>VAT</th>
                <th> Payable</th>
                <th>Paid</th>
                <th>Due</th>
               <th>Products</th>
                <th>Operation</th>

            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->customer->name }}</td>

                    <td>{{ $invoice->vat }}</td>
                    <td>{{ $invoice->payable }}</td>
                    <td>{{ $invoice->paid }}</td>
                    <td>{{ $invoice->due }}</td>
                    <td>
                        <ul style="list-style-type: none; padding: 0;">
                            @foreach ($invoice->products as $index => $product)
                                <li style="margin-bottom: 8px; border-bottom: 1px solid #ddd; padding-bottom: 4px;">
                                    <strong>{{ $index + 1 }}.</strong>
                                    <span style="font-weight: bold; color: #333;">{{ $product->product->name ?? 'Product not found' }}</span>
                                    <br>
                                    <span style="color: #555;">Quantity:</span> {{ $product->qty }} &nbsp; | &nbsp;
                                    <span style="color: #555;">Price:</span> ${{ $product->sale_price }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                    <a class="btn btn-success btn-sm" href="{{ url('/view/salelist',$invoice->id ) }}">View</a>
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')" href="{{ url('/delete/invoice',$invoice->id ) }}">Delete</a>
                   </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
