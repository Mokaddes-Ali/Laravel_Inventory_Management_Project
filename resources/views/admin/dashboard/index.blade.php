@extends('layouts.master')

@section('content')
<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "dark", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

<!-- Page Title Section -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title">Dashboard</h4>
            <div class="page-title-right">
                <form class="d-flex gap-2 align-items-center">
                    <input type="text" class="form-control" id="dash-daterange" placeholder="Select Date Range" style="min-width: 210px;" />
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='uil uil-file-alt me-1'></i>Download
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item"><i class='uil uil-envelope-alt me-1'></i>Email</a>
                            <a href="#" class="dropdown-item"><i class='uil uil-print me-1'></i>Print</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class='uil uil-file me-1'></i>Re-Generate</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="row">
    <!-- Total Invoices -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Invoices</h6>
                <h3 class="mb-0">{{ $invoices->count() }}</h3>
                <span class="text-success"><i class='uil uil-arrow-up'></i> 10.21%</span>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Products</h6>
                <h3 class="mb-0">{{ $products->count() }}</h3>
                <span class="text-danger"><i class='uil uil-arrow-down'></i> 5.05%</span>
            </div>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Categories</h6>
                <h3 class="mb-0">{{ $categories->count() }}</h3>
                <span class="text-success"><i class='uil uil-arrow-up'></i> 15.34%</span>
            </div>
        </div>
    </div>

    <!-- Total Brands -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Brands</h6>
                <h3 class="mb-0">{{ $brands->count() }}</h3>
                <span class="text-success"><i class='uil uil-arrow-up'></i> 12.67%</span>
            </div>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Customers</h6>
                <h3 class="mb-0">{{ $customers->count() }}</h3>
                <span class="text-success"><i class='uil uil-arrow-up'></i> 25.16%</span>
            </div>
        </div>
    </div>

    <!-- Total Paid Amount -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Paid Amount</h6>
                <h3 class="mb-0">${{ number_format($totalPaidAmount, 2) }}</h3>
                <span class="text-success"><i class='uil uil-arrow-up'></i></span>
            </div>
        </div>
    </div>

    <!-- Total Due Amount -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total Due Amount</h6>
                <h3 class="mb-0">${{ number_format($totalDueAmount, 2) }}</h3>
                <span class="text-danger"><i class='uil uil-arrow-down'></i></span>
            </div>
        </div>
    </div>

    <!-- Total VAT -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h6 class="text-muted fw-bold">Total VAT</h6>
                <h3 class="mb-0">${{ number_format($totalVat, 2) }}</h3>
                <span class="text-danger"><i class='uil uil-arrow-down'></i></span>
            </div>
        </div>
    </div>
</div>
@endsection
