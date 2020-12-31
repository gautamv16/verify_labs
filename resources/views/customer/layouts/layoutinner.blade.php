@extends('customer.layouts.lab')
@section('maincontent')

<body class="sb-nav-fixed">
    <div class="d-lg-none">
        <div class="d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{route('lab.dashboard')}}"> <img src="{{ asset('admin/assets/img/logo-white.png') }}"/></a>
            <a id="sidebarToggle" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2 w-8 h-8 text-white transform rotate-90"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></a>
        </div>
        <div class="side-nav__devider my-6"></div>
    </div> 
    <div id="layoutSidenav" class="d-flex">
        <div id="layoutSidenav_nav" class="d-lg-block">
            <div class="d-flex justify-content-between">
                <a class="navbar-brand mobile" href="{{route('customer.dashboard')}}"> <img src="{{ asset('admin/assets/img/logo-white.png') }}"/></a>
           </div>
            <div class="side-nav__devider my-6"></div>
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                        <a class="nav-link" href="{{route('customer.dashboard')}}">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            </div>
                            <span>Summary</span>
                        </a>
                       
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShipmentLayouts" aria-expanded="false">
                            <div class="sb-nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive"><line x1="22" y1="12" x2="2" y2="12"></line><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path><line x1="6" y1="16" x2="6.01" y2="16"></line><line x1="10" y1="16" x2="10.01" y2="16"></line></svg>
                            </div>
                            <span>Inspections</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                         </a>
                         <div class="collapse" id="collapseShipmentLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                 <a class="nav-link" href="{{route('customer.pending_shipments')}}"><div class="sb-nav-link-icon"></div>Pending</a>
                                <a class="nav-link" href="{{route('customer.shipments')}}"><div class="sb-nav-link-icon"></div>Passed</a>
                                <a class="nav-link" href="{{route('customer.failed_shipments')}}"><div class="sb-nav-link-icon"></div>Failed</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="{{route('customer.revisions')}}">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                            </div>
                            <span>Revisions</span></a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="breadcrumb mr-auto"> <span>Application</span> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right breadcrumb__icon"><polyline points="9 18 15 12 9 6"></polyline></svg> 
                        <a href="" class="breadcrumb-item active">Dashboard</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="intro-x relative">
                        <div class="search">
                            <input type="text" class="search__input input" placeholder="Search...">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search search__icon dark:text-gray-300"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> 
                        </div>
                    </div>
                    <!-- END: Search -->
                    <!-- BEGIN: Account Menu -->
                    <div class="dropdown account">
                        <div class="dropdown-toggle image-fit d-flex align-items-center" data-toggle="dropdown">
                        <span class="userName">{{Auth::guard('admins')->user()->first_name}} {{Auth::guard('admins')->user()->last_name}}</span>
                            <!-- <img alt="" src="{{ asset('admin/assets/img/profile-2.jpg') }}"> -->
                        </div>
                        <div class="dropdown-box w-56 dropdown-menu dropdown-menu-right">
                            <div class="bg-theme-38 border-r-7">
                                <div class="p-2">
                                        <a class="flex items-center p-2" href="{{route('admin.logout')}}"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right w-4 h-4 mr-2"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg> Logout </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
            <main>
                @yield('content')
            </main>

        </div>
    </div>
</body>

@stop

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="/admin/js/scripts.js"></script>
@stop