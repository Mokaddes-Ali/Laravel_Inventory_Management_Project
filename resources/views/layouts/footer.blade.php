       
</div> <!-- container -->

</div> <!-- content -->

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>document.write(new Date().getFullYear())</script> &copy; Shreyu theme by <a href="#">Coderthemes</a> 
            </div>
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-sm-block">
                    <a href="javascript:void(0);">About Us</a>
                    <a href="javascript:void(0);">Help</a>
                    <a href="javascript:void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
<div data-simplebar class="h-100">

<h6 class="fw-medium px-3 m-0 py-2 text-uppercase bg-light">
    <span class="d-block py-1">Theme Settings</span>
</h6>

<div class="p-3">
    <div class="alert alert-warning" role="alert">
        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
    </div>

    <h6 class="fw-medium mt-4 mb-2 pb-1">Color Scheme</h6>
    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
        <label class="form-check-label" for="light-mode-check">Light Mode</label>
    </div>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
        <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
    </div>

    <!-- Width -->
    <h6 class="fw-medium mt-4 mb-2 pb-1">Width</h6>
    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="width" value="fluid" id="fluid-check" checked />
        <label class="form-check-label" for="fluid-check">Fluid</label>
    </div>
    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="width" value="boxed" id="boxed-check" />
        <label class="form-check-label" for="boxed-check">Boxed</label>
    </div>

    <!-- Menu positions -->
    <h6 class="fw-medium mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="menus-position" value="fixed" id="fixed-check" checked />
        <label class="form-check-label" for="fixed-check">Fixed</label>
    </div>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="menus-position" value="scrollable" id="scrollable-check" />
        <label class="form-check-label" for="scrollable-check">Scrollable</label>
    </div>

    <!-- Left Sidebar-->
    <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Color</h6>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="light" id="light-check" checked />
        <label class="form-check-label" for="light-check">Light</label>
    </div>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="dark" id="dark-check" />
        <label class="form-check-label" for="dark-check">Dark</label>
    </div>

    <!-- size -->
    <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Size</h6>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="default" id="default-size-check" checked />
        <label class="form-check-label" for="default-size-check">Default</label>
    </div>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="condensed" id="condensed-check" />
        <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
    </div>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="compact" id="compact-check" />
        <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
    </div>

    <!-- User info -->
    <h6 class="fw-medium mt-4 mb-2 pb-1">Sidebar User Info</h6>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check" />
        <label class="form-check-label" for="sidebaruser-check">Enable</label>
    </div>


    <!-- Topbar -->
    <h6 class="fw-medium mt-4 mb-2 pb-1">Topbar</h6>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
        <label class="form-check-label" for="darktopbar-check">Dark</label>
    </div>

    <div class="form-switch mb-1">
        <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
        <label class="form-check-label" for="lighttopbar-check">Light</label>
    </div>


    <button class="btn btn-primary w-100 mt-4" id="resetBtn">Reset to Default</button>

    <a href="https://1.envato.market/shreyu_admin" class="btn btn-danger d-block mt-3" target="_blank">
        <i class="mdi mdi-basket me-1"></i> Purchase Now
    </a>

</div>

</div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="{{asset('admin')}}/assets/js/vendor.min.js"></script>

<!-- optional plugins -->
<script src="{{asset('admin')}}/assets/libs/moment/min/moment.min.js"></script>
<script src="{{asset('admin')}}/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="{{asset('admin')}}/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- page js -->
<script src="{{asset('admin')}}/assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="{{asset('admin')}}/assets/js/app.min.js"></script>

</body>

<!-- Mirrored from shreyu.coderthemes.com/layouts-dark-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 13 Dec 2021 13:58:43 GMT -->
</html>