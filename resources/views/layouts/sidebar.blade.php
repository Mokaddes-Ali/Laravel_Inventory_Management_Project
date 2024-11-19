            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                    <div class="user-box text-center">
                        <img src="{{asset('admin')}}/assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">Nik Patel</a>
                            <div class="dropdown-menu user-pro-dropdown">

                                <a href="pages-profile.html" class="dropdown-item notify-item">
                                    <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                                </a>

                            </div>
                        </div>
                        <p class="text-muted">Admin Head</p>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <!-- <li class="menu-title">Navigation</li> -->
                            <li>
                                <a href="/dashboard">
                                    <i data-feather="message-square"></i>
                                    <span> Dashboard</span>
                                </a>
                            </li>

                            <li class="menu-title mt-2">Apps</li>

                            <li>
                                <a href="#sidebarUsers" data-bs-toggle="collapse">
                                    <i data-feather="user"></i>
                                    <span> Users </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarUsers">
                                    <ul class="nav-second-level">
                                        <li><a href="{{ url('/show') }}">All Users</a></li>

                                        <li><a href="{{ url('/user') }}">Add New User</a></li>
                                     
                                        <li><a href="{{ url('/role') }}">Add New Roles</a></li>
                                        <li><a href={{ route('roles.index') }}>Roles List</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCustomer" data-bs-toggle="collapse">
                                    <i data-feather="mail"></i>
                                    <span> Customer </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCustomer">
                                    <ul class="nav-second-level">
                                        @can('customer-create')
                                        <li><a href="/customer">Add Customer</a></li>
                                        @endcan
                                        <li><a href="/customer/show">List Customer</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarCategories" data-bs-toggle="collapse">
                                    <i data-feather="mail"></i>
                                    <span> Categories </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCategories">
                                    <ul class="nav-second-level">
                                        @can('category-create')
                                        <li><a href="/category">Add Categories</a></li>
                                        @endcan

                                        <li><a href="/category/show">List Categories</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarBrands" data-bs-toggle="collapse">
                                    <i data-feather="tag"></i> <!-- Icon for Brands -->
                                    <span> Brands </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarBrands">
                                    <ul class="nav-second-level">
                                        @can('brand-create')
                                        <li><a href="/brands">Add Brands</a></li>
                                        @endcan
                                        <li><a href="/brands/show">List Brands</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Products Section -->
                            <li>
                                <a href="#sidebarProducts" data-bs-toggle="collapse">
                                    <i data-feather="package"></i> <!-- Icon for Products -->
                                    <span> Products </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarProducts">
                                    <ul class="nav-second-level">
                                        @can('product-create')
                                        <li><a href="/products/create">Add Products</a></li>
                                        @endcan
                                        <li><a href="/products">List Products</a></li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                <a href="#sidebarSale" data-bs-toggle="collapse">
                                    <i data-feather="clipboard"></i>
                                    <span> Sale </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSale"> <!-- Changed id here -->
                                    <ul class="nav-second-level">
                                        @can('sale-create')
                                        <li><a href="{{url('/sale')}}">Sale</a></a></li>
                                        @endcan
                                        <li><a href="/invoices/show">List Sale</a></li>
                                    </ul>
                                </div>
                            </li>


                            <li>
                                @can('setting')
                                <a href="/settings">
                                    <i data-feather="file-plus"></i>
                                    <span> Settings </span>
                                </a>
                                @endcan


                                @can('databasebackup')

                                <a href="/backup">
                                    <i data-feather="file-plus"></i>
                                    <span>Database Backup</span>
                                </a>
                                <a href="{{ route('logout') }}" class="notify-item" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endcan

                            <li class="menu-title mt-2">Expense</li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
