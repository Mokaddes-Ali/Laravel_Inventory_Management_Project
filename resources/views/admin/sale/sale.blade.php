@extends('layouts.master')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System </title>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;

        }
        .container {
            display: flex;
            width: 100%;
            padding: 20px;
        }
        .cart-summary {
            width: 50%;
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        .product-list{
            width: 25%;
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        .product-details {
            width: 25%;
            padding: 10px;
            border: 1px solid #ddd;
        }
        h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .item, .cart-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .item button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .cart-summary button, .cart-item .qty-controls {
            display: flex;
            gap: 5px;
        }
        .qty-controls button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
        }
        .cart-item button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
        }
        .summary {
            padding: 10px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .summary span {
            font-size: 1.2em;
        }
        .customer-section {
            width: 25%;

           padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        #cart-customer {
            font-size: 1.2em;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        #cart-customer p {
            margin: 0;
        }
        /* Payment Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        .modal-content input {
            margin: 10px 0;
            padding: 5px;
            width: 100%;
        }
        .modal-content button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .modal-content .close {
            background-color: #dc3545;
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">

      <!-- Cart Summary -->
        <div class="cart-summary">
            <h2>Cart</h2>

            <!-- Cart Customer Header -->
            <div id="cart-customer">
                <p>No customer selected for this cart.</p>
            </div>

            <!-- Cart Items -->
            <div id="cart-items"></div>
            <div class="summary">
                <span>Subtotal: $<span id="subtotal">0</span></span><br>
                <span>Taxes: $<span id="taxes">0</span></span><br>
                <strong>Total: $<span id="total">0</span></strong><br><br>
                <button onclick="openPaymentModal()">Proceed to Payment</button>
            </div>
        </div>

        <!-- Product Details -->


<!-- Customer Selection -->

<script>
    Customertlist();

    async function Customertlist() {

            let response = await fetch('/customerlist');
            let data = await response.json();
            let customerList=$("#customerList");
            customerList.empty();
             data.forEach(function(item,index) {

             let row=`
             <tr>
             <td>${item.name}</td>
              <td> <a class="btn btn-dark" onclick="addToCart('${item.name}')">ADD</a></td>
             </tr>
             `;
             customerList.append(row);

             });

    }

   </script>

<div class="customer-section">
<table class="table table-sm w-100" id="customerTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Customer</td>

                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="customerList">

                        </tbody>
                    </table>
</div>

        <!-- Product List -->

        <script>
            Productlist();

            async function Productlist() {

                    let response = await fetch('/productlist');
                    let data = await response.json();
                    let productList=$("#productList");
                     productList.empty();
                     data.forEach(function(item,index) {

                     let row=`
                     <tr>
                     <td>${item.name}</td>
                      <td> <a class="btn btn-dark" onclick="addToCart('${item.name}', ${item.price})">ADD</a></td>
                     </tr>
                     `;
                     productList.append(row);

                     });

            }

           </script>


<div class="product-list">
    <table class="table w-100" id="productTable">
        <thead class="w-100">
            <tr class="text-xs text-bold">
                <td>Product</td>
                <td>Pick</td>
            </tr>
        </thead>
        <tbody class="w-100" id="productList">


        </tbody>
    </table>
</div>


    <!-- Payment Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <h3>Payment</h3>
            <label>Total Amount: $<span id="modal-total"></span></label>
            <input type="number" id="amountReceived" placeholder="Amount Received">
            <div id="paymentResult"></div>
            <button onclick="processPayment()">Complete Payment</button>
            <button class="close" onclick="closePaymentModal()">Close</button>
        </div>
    </div>

    <script>
        let cart = [];
        let subtotal = 0;
        const taxRate = 0.1;
        let selectedCustomer = null;

        function addToCart(productName, price) {
            const item = cart.find(i => i.name === productName);
            if (item) {
                item.quantity += 1;
            } else {
                cart.push({ name: productName, price: price, quantity: 1 });
            }
            updateCart();
        }

        function updateCart() {
            const cartItemsDiv = document.getElementById('cart-items');
            cartItemsDiv.innerHTML = '';
            subtotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                cartItemsDiv.innerHTML += `
                    <div class="cart-item">
                        <span>${item.name} - $${item.price}</span>
                        <div class="qty-controls">
                            <button onclick="updateQuantity('${item.name}', -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="updateQuantity('${item.name}', 1)">+</button>
                        </div>
                        <button onclick="removeFromCart('${item.name}')">Remove</button>
                    </div>
                `;
            });

            const taxes = subtotal * taxRate;
            const total = subtotal + taxes;

            document.getElementById('subtotal').innerText = subtotal.toFixed(3);
            document.getElementById('taxes').innerText = taxes.toFixed(3);
            document.getElementById('total').innerText = total.toFixed(4);
        }

        function updateQuantity(productName, change) {
            const item = cart.find(i => i.name === productName);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    removeFromCart(productName);
                } else {
                    updateCart();
                }
            }
        }

        function removeFromCart(productName) {
            cart = cart.filter(i => i.name !== productName);
            updateCart();
        }

        function selectCustomer(customerName, address, phone,id) {
            selectedCustomer = { name: customerName, address: address, phone: phone,id: id };

            document.getElementById('cart-customer').innerHTML = `
                <p>Customer: ${customerName}</p>
                <p>Address: ${address}</p>
                <p>Phone: ${phone}</p>
                <p>ID: ${id}</p>
            `;
            updateCart();
        }

        // Payment Modal Functions
        function openPaymentModal() {
            const total = document.getElementById('total').innerText;
            document.getElementById('modal-total').innerText = total;
            document.getElementById('paymentModal').style.display = 'flex';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        function processPayment() {
            const total = parseFloat(document.getElementById('modal-total').innerText);
            const amountReceived = parseFloat(document.getElementById('amountReceived').value);
            const paymentResultDiv = document.getElementById('paymentResult');

            if (isNaN(amountReceived)) {
                paymentResultDiv.innerText = 'Please enter a valid amount.';
                return;
            }

            if (amountReceived >= total) {
                const change = amountReceived - total;
                paymentResultDiv.innerText = `Payment successful! Change Due: $${change.toFixed(2)}`;
            } else {
                const due = total - amountReceived;
                paymentResultDiv.innerText = `Payment incomplete! Due Amount: $${due.toFixed(2)}`;
            }
        }

    </script>

</body>
</html>





@endsection
