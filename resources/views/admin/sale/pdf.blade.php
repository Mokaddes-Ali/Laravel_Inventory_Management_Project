
@extends('layouts.master')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice {
            width: 800px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-image: url('{{ asset('bgimge.jpg') }}'); /* Replace with your image path */
            background-size: cover;
            background-repeat: no-repeat;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            display: flex;
        }

        .invoice-details .left,
        .invoice-details .right {
            width: 50%;
        }

        .invoice-details .right {
            text-align: right;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">

            <p>Invoice No: 12345</p>
            <p>Invoice Date: 20 May, 2024</p>
            <p>Due Date: 20 June, 2024</p>
        </div>

        <div class="invoice-details">
            <div class="left">
                <h4>Invoice To</h4>
                <p>Roger Y. Will</p>
                <p>XYZ Company</p>
                <p>info@xyzcompany.com</p>
                <p>123 Main Street</p>
            </div>
            <div class="right">
                <h4>Invoice From</h4>
                <p>William Peter</p>
                <p>ABC Company</p>
                <p>info@abccompany.com</p>
                <p>456 Main Street</p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>VAT (15%)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>


            @foreach ($invoice->products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product->name ?? 'Product not found' }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>$105.00</td>
                    <td>{{ $product->sale_price * $product->qty}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right" style=" text-align: right;">Subtotal:</td>
                    <td class="text-right">$2875.00</td>
                </tr>
                <tr>
                    <td colspan="5" style=" text-align: right;">VAT:</td>
                    <td class="text-right">${{$invoice->vat}}</td>
                </tr>
                <tr>
                    <td colspan="5" style=" text-align: right;">Total:</td>
                    <td class="text-right">${{$invoice->payable}}</td>
                </tr>
                <tr>
                    <td colspan="5" style=" text-align: right;">Paid:</td>
                    <td class="text-right">${{$invoice->paid}}</td>
                </tr>
                <tr>
                    <td colspan="5" style=" text-align: right;">Due:</td>
                    <td class="text-right">${{$invoice->due}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

@endsection
