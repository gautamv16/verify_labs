@extends('labuser.layouts.lab')
@section('maincontent')

<body class="sb-nav-fixed">
    <!--<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- <a class="navbar-brand" href="{{route('lab.dashboard')}}"> <img src="{{ asset('admin/assets/img/logo.png') }}"/> --><!--<span>{{Auth::guard('admins')->user()->office_location->name}} Lab</span>-->
            <!--</a><<!-- button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button> --><!-- Navbar Search-->
     <!--  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!-- <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div> -->
       <!-- </form>
        <!-- Navbar-->
    <!--</nav>-->
    <div id="layoutSidenav" class="d-flex">
        <div id="layoutSidenav_nav">
            <div class="d-flex justify-content-between">
                <a class="navbar-brand" href="{{route('lab.dashboard')}}"> <img src="{{ asset('admin/assets/img/logo-white.png') }}"/></a>
               <!-- <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button> -->
            </div>
            <div class="side-nav__devider my-6"></div>
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                        <a class="nav-link" href="{{route('lab.dashboard')}}">
                            <div class="sb-nav-link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            </div>
                            <span>Summary</span>
                        </a>
                       <!-- 
                        <a class="nav-link" href="{{route('lab.exporters')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div><span>Exporters</span></a> -->
                        <a class="nav-link" href="{{route('lab.shipments')}}">
                        <div class="sb-nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive"><line x1="22" y1="12" x2="2" y2="12"></line><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path><line x1="6" y1="16" x2="6.01" y2="16"></line><line x1="10" y1="16" x2="10.01" y2="16"></line></svg>
                        </div>
                        <span>Shipments</span></a>
                       
                        
                    </div>
                </div>
                <!-- <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div> -->
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
                        <div class="dropdown-toggle image-fit" data-toggle="dropdown">
                            <img alt="" src="{{ asset('admin/assets/img/profile-2.jpg') }}">
                        </div>
                        <div class="dropdown-box w-56 dropdown-menu dropdown-menu-right">
                            <div class="bg-theme-38 border-r-7">
                                <div class="p-2">
                                    <a href="" class="flex items-center p-2"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4 mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile </a>
                                    <a href="" class="flex items-center p-2"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4 mr-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Add Account </a>
                                    <a href="" class="flex items-center p-2"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Reset Password </a>
                                    <a href="" class="flex items-center p-2"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle w-4 h-4 mr-2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> Help </a>

                                    <a class="flex items-center p-2" href="{{route('admin.logout')}}"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right w-4 h-4 mr-2"><rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect><circle cx="16" cy="12" r="3"></circle></svg> Logout </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
            <!-- <div>
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::guard('admins')->user()->first_name}} {{Auth::guard('admins')->user()->last_name}}<i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
                        </div>
                    </li>
                </ul>
            </div> -->
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