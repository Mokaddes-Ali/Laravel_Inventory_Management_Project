{{-- @extends('layouts.master')

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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background-color: #f9f9f9;
        }
        .container {
            display: flex;
            width: 100%;
            justify-content:space-between;
            padding: 5px;
            margin-top: 10px;
        }
        .cart-summary, .product-list, .customer-section {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        .cart-summary {
            width: 40%;
        }
        .product-list {
            width: 30%;
        }
        .customer-section {
            width: 25%;
        }
        h2, .summary {
            font-size: 1em;
            margin-bottom: 15px;
            color: #333;
        }
        .item, .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f8f8;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .item button, .cart-item button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .item button {
            background-color: #28a745;
        }
        .cart-item button {
            background-color: #dc3545;
        }
        .cart-item .qty-controls button {
            background-color: #007bff;
        }
        .qty-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .cart-item button:hover, .item button:hover, .qty-controls button:hover {
            opacity: 0.8;
        }
        .summary span {
            font-size: 1.2em;
            color: #555;
        }
        .customer-section input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
        }
        .table {
            width: 100%;
            margin-top: 10px;
        }
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
            background-color: #ffdcdc;
            padding: 20px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
        }
        .modal-content input {
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #069afc;
            border-radius: 4px;
        }
        .modal-content button {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            margin: 10px 5px;
        }
        .modal-content .close {
            background-color: #01a9f7;
            padding: 10px 15px;
        }

        .heading-cart{
            font-size: 1.2em;
            color: #f80b0b;
        }


        .invalid-amount {
    color: red;
}

.success-payment {
    color: rgb(5, 253, 5);
}

.incomplete-payment {
    color: rgb(255, 0, 0);
}

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }
            .cart-summary, .product-list, .customer-section {
                width: 100%;
                margin-bottom: 20px;
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
                <p class="heading-cart">No customer selected for this cart.</p>
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
            <table class="table" id="customerTable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Pick</th>
                    </tr>
                </thead>
                <tbody id="customerList"></tbody>
            </table>
        </div>

        <!-- Product List -->
        <div class="product-list">
            <table class="table" id="productTable">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Pick</th>
                    </tr>
                </thead>
                <tbody id="productList"></tbody>
            </table>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Please Receive Payment</h5>
                <button type="button" class="close" onclick="closePaymentModal()">&times;</button>
            </div>
            <div class="modal-body">
                <label class="font-weight-bold">Total Amount:</label>
                <h4>$<span id="modal-total"></span></h4>
                <input type="number" id="amountReceived" placeholder="Enter amount received">
                <div id="paymentResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="processPayment()">Paid</button>
                <button type="button" onclick="closePaymentModal()">Close</button>
            </div>
        </div>
    </div>

    </body>
    </html>

    @endsection --}}


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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            padding: 5px;
            margin-top: 10px;
        }
        .style-card{
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        .shop-card {
            width: 100%;
        }

        .customer-section {
            width: 50%;
        }
        h2 {
            font-size: 1.2em;
            color: #333;
        }
        .summary {
            font-size: 1.1em;
            margin-top: 15px;
            color: #555;
        }
        .summary span {
            font-size: 1.2em;
            font-weight: bold;
        }

        .item, .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f8f8f8;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .item button, .cart-item button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .item button {
            background-color: #28a745;
        }

        .cart-item button {
            background-color: #dc3545;
        }

        .cart-item button:hover, .item button:hover {
            opacity: 0.8;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
        }

        .table {
            width: 100%;
            margin-top: 10px;
        }

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
            background-color: #ffdcdc;
            padding: 20px;
            border-radius: 8px;
            width: 350px;
            text-align: center;
        }

        .modal-content input {
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #069afc;
            border-radius: 4px;
        }

        .modal-content button {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            margin: 10px 5px;
        }

        .modal-content .close {
            background-color: #01a9f7;
            padding: 10px 15px;
        }

        /* Cart Heading Color */
        .heading-cart {
            font-size: 1.2em;
            color: #f80b0b;
        }

        .invalid-amount {
            color: red;
        }

        .success-payment {
            color: rgb(5, 253, 5);
        }

        .incomplete-payment {
            color: rgb(255, 0, 0);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }
            .cart-summary, .product-list, .customer-section, .product-summary {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
        <div class="row justify-content-between">
            <!-- Customer Information -->
            <div class="col-md-6">
                <div class="style-card border-primary ">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Customer Information</h5>
                    </div>
                    <div class="card-body">
                        <div id="cart-customer">
                            <p class="text-danger">No customer selected for this cart.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="col-md-6">
                <div class="card border-success shadow">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div id="cart-product">
                            <p class="text-muted">No Product Selected for this Cart.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


{{-- // shop card --}}

<div id="cart-items"></div>

<div class="shop-card">

     <!-- Cart Items -->

    <span>Subtotal: $<span id="subtotal">0</span></span><br>
    <span>Taxes: $<span id="taxes">0</span></span><br>
    <strong>Total: $<span id="total">0</span></strong><br><br>
    <button onclick="openPaymentModal()">Proceed to Payment</button>

</div>


<div class=""> <!-- Customer Section -->
    <div class="customer-section">
        <h3>Select Customer</h3>
        <table class="table" id="customerTable">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Pick</th>
                </tr>
            </thead>
            <tbody id="customerList"></tbody>
        </table>
    </div>
</div>

  <!-- Product List -->
  <div class="product-list">
    <h3>Select Product</h3>
    <table class="table" id="productTable">
        <thead>
            <tr>
                <th>Product</th>
                <th>Pick</th>
            </tr>
        </thead>
        <tbody id="productList"></tbody>
    </table>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Please Receive Payment</h5>
            <button type="button" class="close" onclick="closePaymentModal()">&times;</button>
        </div>
        <div class="modal-body">
            <label class="font-weight-bold">Total Amount:</label>
            <h4>$<span id="modal-total"></span></h4>
            <input type="number" id="amountReceived" placeholder="Enter amount received">
            <div id="paymentResult"></div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="processPayment()">Paid</button>
            <button type="button" onclick="closePaymentModal()">Close</button>
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

    function selectCustomer(customerName, address, phone, id, email, slug, status, image) {
    const imageUrl = `/images/${image}`;
    const statusText = status === '0' ? 'Active' : 'Inactive';

    selectedCustomer = {
        name: customerName,
        address: address,
        phone: phone,
        id: id,
        email: email,
        slug: slug,
        status: statusText,
        image: imageUrl
    };

    document.getElementById('cart-customer').innerHTML = `
        <div class="container">
            <!-- Row 1 -->
            <div class="row g-3">
                <div class="col-md-6"><div>Customer: ${customerName}</div></div>
                 <div class="col-md-6"><div>Customer Id: ${id}</div></div>
            </div>

            <!-- Row 2 -->
            <div class="row g-3 mt-1">
                <div class="col-md-6"><div>Slug: ${slug}</div></div>
                <div class="col-md-6"><div>Status: ${statusText}</div></div>
            </div>

            <!-- Row 3 -->
            <div class="row g-3 mt-1">
                <div class="col-md-6"><div>Address: ${address}</div></div>
                <div class="col-md-6"><div>Phone: ${phone}</div></div>
            </div>

            <!-- Row 4 -->
            <div class="row g-3 mt-1">
                    <div class="col-md-6"><div>Email: ${email}</div></div>
                <div class="col-md-6">
                    <div>Image: <img src="${imageUrl}" alt="${customerName}" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;"></div>
                </div>
            </div>
        </div>
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
paymentResultDiv.classList.add('invalid-amount'); // Custom red text class
paymentResultDiv.classList.remove('success-payment', 'incomplete-payment');
return;
}

if (amountReceived >= total) {
const change = amountReceived - total;
paymentResultDiv.innerText = `Payment successful! Change Due: $${change.toFixed(2)}`;
paymentResultDiv.classList.add('success-payment'); // Custom green text class
paymentResultDiv.classList.remove('invalid-amount', 'incomplete-payment');
submitInvoice();
} else {
const due = total - amountReceived;
paymentResultDiv.innerText = `Payment incomplete! Due Amount: $${due.toFixed(2)}`;
paymentResultDiv.classList.add('incomplete-payment');
paymentResultDiv.classList.remove('invalid-amount', 'success-payment');
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
const imageUrl = `/images/${item.pic}`;
const statusText = item.status === '0' ? 'Active' : 'Inactive';

customerList.innerHTML += `
    <tr>
        <td>${item.name}</td>
        <td><button class="btn btn-dark" onclick="selectCustomer('${item.name}', '${item.address}', '${item.number}', '${item.id}', '${item.email}', '${item.slug}', '${item.status}', '${item.pic}')">ADD</button></td>
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


    Customerlist();
    Productlist();
</script>

</body>
</html>

@endsection
