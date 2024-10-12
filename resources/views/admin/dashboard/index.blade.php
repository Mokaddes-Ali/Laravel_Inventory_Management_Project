@extends('layouts.master')
@section('content')


<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "dark", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>                      
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
            <div class="page-title-right">
                <form class="float-sm-end mt-3 mt-sm-0">
                    <div class="row g-2">
                        <div class="col-md-auto">
                            <div class="mb-1 mb-sm-0">
                                <input type="text" class="form-control" id="dash-daterange" style="min-width: 210px;" />
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='uil uil-file-alt me-1'></i>Download
                                <i class="icon"><span data-feather="chevron-down"></span></i></button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item notify-item">
                                        <i data-feather="mail" class="icon-dual icon-xs me-2"></i>
                                        <span>Email</span>
                                    </a>
                                    <a href="#" class="dropdown-item notify-item">
                                        <i data-feather="printer" class="icon-dual icon-xs me-2"></i>
                                        <span>Print</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item notify-item">
                                        <i data-feather="file" class="icon-dual icon-xs me-2"></i>
                                        <span>Re-Generate</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>     
<!-- end page title -->  

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">Today Revenue</span>
                        <h3 class="mb-0">$2100</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <div id="today-revenue-chart" class="apex-charts"></div>
                        <span class="text-success fw-bold fs-13">
                            <i class='uil uil-arrow-up'></i> 10.21%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">Product Sold</span>
                        <h3 class="mb-0">558</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <div id="today-product-sold-chart" class="apex-charts"></div>
                        <span class="text-danger fw-bold fs-13">
                            <i class='uil uil-arrow-down'></i> 5.05%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">New Customers</span>
                        <h3 class="mb-0">65</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <div id="today-new-customer-chart" class="apex-charts"></div>
                        <span class="text-success fw-bold fs-13">
                            <i class='uil uil-arrow-up'></i> 25.16%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <span class="text-muted text-uppercase fs-12 fw-bold">NewVisitors</span>
                        <h3 class="mb-0">958</h3>
                    </div>
                    <div class="align-self-center flex-shrink-0">
                        <div id="today-new-visitors-chart" class="apex-charts"></div>
                        <span class="text-danger fw-bold fs-13">
                            <i class='uil uil-arrow-down'></i> 5.05%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection