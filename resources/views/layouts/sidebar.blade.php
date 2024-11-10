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
                                        @can('role-edit')
                                        <li><a href="{{ url('/user') }}">Add New User</a></li>
                                        @endcan
                                        <li><a href="#">User Roles</a></li>
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
                                        {{-- @can('category-create') --}}
                                        <li><a href="/category">Add Categories</a></li>
                                        {{-- @endcan --}}

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
                            </li>
                            @endcan

                            <li class="menu-title mt-2">Expense</li>

                            <li>
                                <a href="#sidebarExpages" data-bs-toggle="collapse">
                                    <i data-feather="file-text"></i>
                                    <span> Pages </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarExpages">
                                    <ul class="nav-second-level">
                                        <li><a href="pages-starter.html">Starter</a></li>
                                        <li><a href="pages-profile.html">Profile</a></li>
                                        <li><a href="pages-activity.html">Activity</a></li>
                                        <li><a href="pages-invoice.html">Invoice</a></li>
                                        <li><a href="pages-pricing.html">Pricing</a></li>
                                        <li><a href="pages-maintenance.html">Maintenance</a></li>
                                        <li><a href="pages-login.html">Login</a></li>
                                        <li><a href="pages-register.html">Register</a></li>
                                        <li><a href="pages-logout.html">Logout</a></li>
                                        <li><a href="pages-recoverpw.html">Recover Password</a></li>
                                        <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                                        <li><a href="pages-confirm-mail.html">Confirm</a></li>
                                        <li><a href="pages-404.html">Error 404</a></li>
                                        <li><a href="pages-500.html">Error 500</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarLayouts" data-bs-toggle="collapse">
                                    <i data-feather="layout"></i>
                                    <span class="badge bg-danger float-end">New</span>
                                    <span> Layouts </span>
                                </a>
                                <div class="collapse" id="sidebarLayouts">
                                    <ul class="nav-second-level">
                                        <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                        <li><a href="layouts-detached.html">Detached</a></li>
                                        <li><a href="layouts-two-column.html">Two Column Menu</a></li>
                                        <li><a href="layouts-preloader.html">Preloader</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-title mt-2">Components</li>

                            <li>
                                <a href="ui-elements.html">
                                    <i data-feather="package"></i>
                                    <span> UI Elements </span>
                                </a>
                            </li>

                            <li>
                                <a href="widgets.html">
                                    <i data-feather="gift"></i>
                                    <span> Widgets </span>
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarIcons" data-bs-toggle="collapse">
                                    <i data-feather="cpu"></i>
                                    <span> Icons </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarIcons">
                                    <ul class="nav-second-level">
                                        <li><a href="icons-unicons.html">Unicons</a></li>
                                        <li><a href="icons-feather.html">Feather</a></li>
                                        <li><a href="icons-bootstrap.html">Bootstrap</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarForms" data-bs-toggle="collapse">
                                    <i data-feather="bookmark"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForms">
                                    <ul class="nav-second-level">
                                        <li><a href="forms-basic.html">Basic Elements</a></li>
                                        <li><a href="forms-advanced.html">Advanced</a></li>
                                        <li><a href="forms-validation.html">Validation</a></li>
                                        <li><a href="forms-wizard.html">Wizard</a></li>
                                        <li><a href="forms-editor.html">Editor</a></li>
                                        <li><a href="forms-file-uploads.html">File Uploads</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="charts.html">
                                    <i data-feather="bar-chart-2"></i>
                                    <span> Charts </span>
                                </a>
                            </li>

                            <li>
                                <a href="#sidebarTables" data-bs-toggle="collapse">
                                    <i data-feather="grid"></i>
                                    <span> Tables </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarTables">
                                    <ul class="nav-second-level">
                                        <li><a href="tables-basic.html">Basic</a></li>
                                        <li><a href="tables-datatables.html">Data Tables</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMaps" data-bs-toggle="collapse">
                                    <i data-feather="map"></i>
                                    <span> Maps </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMaps">
                                    <ul class="nav-second-level">
                                        <li><a href="maps-google.html">Google Maps</a></li>
                                        <li><a href="maps-vector.html">Vector Maps</a></li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMultilevel" data-bs-toggle="collapse">
                                    <i data-feather="share-2"></i>
                                    <span> Multi Level </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                                Second Level <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel2">
                                                <ul class="nav-second-level">
                                                    <li><a href="javascript: void(0);">Item 1</a></li>
                                                    <li><a href="javascript: void(0);">Item 2</a></li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>
                                            <a href="#sidebarMultilevel3" data-bs-toggle="collapse">
                                                Third Level <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel3">
                                                <ul class="nav-second-level">
                                                    <li><a href="javascript: void(0);">Item 1</a></li>
                                                    <li>
                                                        <a href="#sidebarMultilevel4" data-bs-toggle="collapse">
                                                            Item 2 <span class="menu-arrow"></span>
                                                        </a>
                                                        <div class="collapse" id="sidebarMultilevel4">
                                                            <ul class="nav-second-level">
                                                                <li><a href="javascript: void(0);">Item 1</a></li>
                                                                <li><a href="javascript: void(0);">Item 2</a></li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
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
