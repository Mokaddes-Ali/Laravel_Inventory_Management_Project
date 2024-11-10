@extends('layouts.master')
@section('content')
<div class="container">
    <<div class="card-header d-flex w-36 h-11 ">
        <div class="mx-5">
            @can('sale-create')

        <a href="{{ url('/sale') }}" class=""><button type="button" class="btn btn-success display-4">Sale Add</button></a>
        @endcan
      </div>
        <div class="mx-5  text-center display-6">
        Invoice List
    </div>
    <a href="{{ url('/sale-export1') }}" class="mx-2 mt-1"><button type="button" class="btn btn-success display-4">Excel</button></a>
            <a href="{{ url('/sale-export2') }}" class="mt-1 mx-2"><button type="button" class="btn btn-success display-4">CSV</button></a>
            <a href="{{ url('/sale-export3') }}" class="mt-1 mx-2"><button type="button" class="btn btn-success display-4">PDF</button></a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Products</th>
                <th>VAT</th>
                <th> Payable</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Operation</th>

            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->customer->name }}</td>
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
                    <td>{{ $invoice->vat }}</td>
                    <td>{{ $invoice->payable }}</td>
                    <td>{{ $invoice->paid }}</td>
                    <td>{{ $invoice->due }}</td>

                    <td>
                    <a class="btn btn-success btn-sm" href="{{ url('/view/salelist',$invoice->id ) }}">View</a>
                    <a class="btn btn-success btn-sm" href="{{ url('/view/salelist/pdf',$invoice->id ) }}">pdf</a>
                    @can('sale-delete')
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')" href="{{ url('/delete/invoice',$invoice->id ) }}">Delete</a>
                    @endcan
                   </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
