


@extends('layouts.master')

@section('content')


    <!-- start page title -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>POS System</title>

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


        #paymentModal .modal-dialog {
        width: 600px;  /* Custom width */
        height: 400px; /* Custom height */
    }

    @media (max-width: 768px) {
        /* Responsive adjustments for smaller screens */
        #paymentModal .modal-dialog {
            width: 90%;   /* Set width to 90% of the screen for smaller devices */
            height: auto; /* Height will adjust dynamically */
        }
    }
    </style>
    </head>
    <body>
        <div class="container">
        @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-error">
        {{ session()->get('error') }}
    </div>
@endif
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

            <!-- Customer Selection -->
            <div class="customer-section">
                <input type="text" id="searchInput" placeholder="Search customers..." oninput="searchCustomers(true)">
                <button onclick="searchCustomers()">Search</button>
                <button onclick="resetSearch()">Reset</button>
                <table class="table table-sm w-100" id="customerTable">
                    <thead class="w-100">
                    <tr class="text-xs text-bold">
                        <td>Customer</td>
                        <td>Pick</td>
                    </tr>
                    </thead>
                    <tbody class="w-100" id="customerList"></tbody>
                </table>
            </div>

            <!-- Product List -->
            <div class="product-list">
                 <!-- Search Input and Buttons -->
     <input type="text" id="productSearchInput" placeholder="Search products..." oninput="searchProducts(true)">
     <button onclick="searchProducts()">Search</button>
     <button onclick="resetProductSearch()">Reset</button>
                <table class="table w-100" id="productTable">
                    <thead class="w-100">
                    <tr class="text-xs text-bold">
                        <td>Product</td>
                        <td>Pick</td>
                    </tr>
                    </thead>
                    <tbody class="w-100" id="productList"></tbody>
                </table>
            </div>
        </div>

        <!-- Payment Modal -->
        <div id="paymentModal" class="modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Complete Payment</h5>
                        <button type="button" class="close text-white" onclick="closePaymentModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Total Amount:</label>
                            <h4>$<span id="modal-total"></span></h4>
                        </div>
                        <div class="form-group">
                            <label>Amount Received</label>
                            <input type="number" class="form-control" id="amountReceived" placeholder="Enter amount received">
                        </div>
                        <div id="paymentResult"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="processPayment()">Paid</button>
                        <button type="button" class="btn btn-danger" onclick="closePaymentModal()">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script for Fetch API -->
        <script>
            let cart = [];
            let subtotal = 0;
            const taxRate = 0.1;
            let selectedCustomer = null;

            // Add product to the cart
            function addToCart(productName, price, productId) {
                const item = cart.find(i => i.name === productName);
                if (item) {
                    item.quantity += 1;
                } else {
                    cart.push({ name: productName, price: price, quantity: 1, product_id: productId });
                }
                updateCart();
            }

            // Update the cart
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

                document.getElementById('subtotal').innerText = subtotal.toFixed(2);
                document.getElementById('taxes').innerText = taxes.toFixed(2);
                document.getElementById('total').innerText = total.toFixed(2);
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

            // Select customer
            function selectCustomer(customerName, address, phone, id) {
                selectedCustomer = { name: customerName, address: address, phone: phone, id: id };
                document.getElementById('cart-customer').innerHTML = `
                    <p>Customer: ${customerName}</p>
                    <p>Address: ${address}</p>
                    <p>Phone: ${phone}</p>
                    <p id="CID">${id}</p>
                `;
                updateCart();
            }

            // Open and close payment modal
            function openPaymentModal() {
                const total = document.getElementById('total').innerText;
                document.getElementById('modal-total').innerText = total;
                document.getElementById('paymentModal').style.display = 'flex';
            }

            function closePaymentModal() {
                document.getElementById('paymentModal').style.display = 'none';
            }

            // Process payment and send data to server
            function processPayment() {
                const total = parseFloat(document.getElementById('modal-total').innerText);
                const amountReceived = parseFloat(document.getElementById('amountReceived').value);
                const paymentResultDiv = document.getElementById('paymentResult');

                if (isNaN(amountReceived) || amountReceived <= 0) {
                    paymentResultDiv.innerText = 'Please enter a valid amount.';
                    return;
                }

                if (amountReceived >= total) {
                    const change = amountReceived - total;
                    paymentResultDiv.innerText = `Payment successful! Change Due: $${change.toFixed(2)}`;
                    submitInvoice();
                } else {
                    const due = total - amountReceived;
                    paymentResultDiv.innerText = `Payment incomplete! Due Amount: $${due.toFixed(2)}`;
                    submitInvoice();
                }
            }

            // Submit invoice to the server
            async function submitInvoice() {
                const total = parseFloat(document.getElementById('total').innerText);
                const paid = parseFloat(document.getElementById('amountReceived').value);
                const taxes = parseFloat(document.getElementById('taxes').innerText) || 0;
                const CID = parseInt(document.getElementById('CID').innerText);
                const due = total - paid;

                if (!selectedCustomer || cart.length === 0) {
                    alert('Please select a customer and add items to the cart.');
                    return;
                }

                const invoiceData = {
                    customer_id: CID,
                    total: total,
                    paid: paid,
                    due: due,
                    vat: taxes,
                    items: cart.map(item => ({
                        product_id: item.product_id,
                        qty: item.quantity,
                        price: item.price
                    }))
                };

                try {
                    let response = await fetch('/invoices', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(invoiceData)
                    });

                    let result = await response.json();
                    if (response.ok) {
                        alert(result.message);
                        cart = [];
                        updateCart();
                        closePaymentModal();
                    } else {
                        alert('Error: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            // Fetch and display customers
            async function Customerlist() {
                let response = await fetch('/customerlist');
                let data = await response.json();
                displayCustomers(data);
            }

            function displayCustomers(data) {
                let customerList = document.getElementById('customerList');
                customerList.innerHTML = '';
                data.forEach(item => {
                    customerList.innerHTML += `
                        <tr>
                            <td>${item.name}</td>
                            <td><button class="btn btn-dark" onclick="selectCustomer('${item.name}', '${item.address}', '${item.number}', '${item.id}')">ADD</button></td>
                        </tr>
                    `;
                });
            }

            async function Productlist() {
                let response = await fetch('/productlist');
                let data = await response.json();
                displayProducts(data);
            }

            function displayProducts(data) {
                let productList = document.getElementById('productList');
                productList.innerHTML = '';
                data.forEach(item => {
                    productList.innerHTML += `
                        <tr>
                            <td>${item.name}</td>
                            <td><button class="btn btn-dark" onclick="addToCart('${item.name}', ${item.price}, ${item.id})">ADD</button></td>
                        </tr>
                    `;
                });
            }

            // Call these functions on page load
            Customerlist();
            Productlist();
        </script>

    </body>
    </html>

    @endsection
