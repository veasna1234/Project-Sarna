<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{config('app.name','Laravel')}} - @yield('title')</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/logo.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
  @yield('css')
</head>

<body>
    <div id="block-alert" class="d-none" style="position: relative;z-index:100">
    <div style="width:20%;float: right;position:absolute;margin-left:80%;" class="alert alert-success alert-dismissible fade show" role="alert">
         <span id="text-message" class="alert-text"><strong>Success!</strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
   </div>
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
            <img src="../assets/img/brand/logo.png" width="100%" class="navbar-brand-img" style="margin-left: -30px" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : ''}}" href="{{route('home')}}">
                    <span class="iconify mr-2" data-icon="mdi:graph" style="color: #327335;" data-width="17" data-height="17"></span>
                    <span class="nav-link-text">Dashboard</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('icons') ? 'active' : ''}}" href="{{route('admin.icons')}}">
                    <span class="iconify" data-icon="dashicons:products" data-width="17" data-height="17" style="color:blue"></span>
                    <span class="nav-link-text ml-2">Product</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('category') ? 'active' : ''}}" href="{{route('admin.category')}}">
                    <span class="iconify" data-icon="ic:round-category" data-width="17" data-hieght="17" style="color: #11cdef"></span>
                    <span class="nav-link-text ml-2">Category</span>
                </a>
                </li>
                {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('profile') ? 'active' : ''}}" href="{{route('admin.profile')}}">
                    <i class="ni ni-single-02 text-yellow"></i>
                    <span class="nav-link-text">Profile</span>
                </a>
                </li> --}}
                <li class="nav-item">
                <a class="nav-link {{ Request::is('brands') ? 'active' : ''}}" href="{{route('admin.brand')}}">
                    <span class="iconify" data-icon="tabler:brand-windows" data-width="17" data-height="17" style="color: #fb7657"></span>
                    <span class="nav-link-text ml-2">Brands</span>
                </a>
                </li>

                <li class="nav-item dropdown" style="margin-left:-5px">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="iconify mr-2" data-icon="fluent:desktop-32-filled" style="color: #9826ab;margin-left:5px;" data-width="17" data-height="17"></span>Component
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item {{ Request::is('ram') ? 'bg-warning' : ''}}" href="{{route('component.ram')}}"><span class="iconify" data-icon="gg:smartphone-ram"></span>RAM</a>
                      <a class="dropdown-item {{ Request::is('processor') ? 'bg-warning' : ''}}" href="{{route('component.processor')}}"><span class="iconify" data-icon="uil:processor"></span>Processor</a>
                      <a class="dropdown-item {{ Request::is('os') ? 'bg-warning' : ''}}" href="{{route('component.os')}}"><span class="iconify" data-icon="ant-design:windows-filled"></span>OS</a>
                      <a class="dropdown-item {{ Request::is('graphic_card') ? 'bg-warning' : ''}}" href="{{route('component.graphic_card')}}"><span class="iconify" data-icon="whh:graphicscard"></span>Graphic Card</a>
                      <a class="dropdown-item {{ Request::is('storage') ? 'bg-warning' : ''}}" href="{{route('component.storage')}}" ><span class="iconify" data-icon="ri:hard-drive-2-fill"></span>Storage</a>
                      <a class="dropdown-item {{ Request::is('storage_type') ? 'bg-warning' : ''}}" href="{{route('component.storage_type')}}" href="#"><span class="iconify" data-icon="mdi:format-list-bulleted-type"></span>Storage Type</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown" style="margin-left:-5px">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="iconify mr-2" data-icon="fluent:desktop-32-filled" style="color: #9826ab;margin-left:5px;" data-width="17" data-height="17"></span>More
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item {{ Request::is('discount') ? 'bg-warning' : ''}}" href="{{route('discount_product')}}"><span class="iconify" data-icon="tabler:shopping-cart-discount"></span>Discount</a>
                      <a class="dropdown-item"><span class="iconify" data-icon="tabler:shopping-cart-discount"></span>item</a>
                      <a class="dropdown-item"><span class="iconify" data-icon="gg:smartphone-ram"></span>item</a>
                      <a class="dropdown-item"><span class="iconify" data-icon="gg:smartphone-ram"></span>item</a>
                    </div>
                  </li>

                <li class="nav-item" style="margin-top: 0">
                <a class="nav-link {{ Request::is('login') ? 'active' : ''}}" href="{{route('admin.login')}}">
                    <i class="ni ni-key-25 text-info"></i>
                    <span class="nav-link-text">Login</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('register') ? 'active' : ''}}" href="{{route('admin.register')}}">
                    <i class="ni ni-circle-08 text-pink"></i>
                    <span class="nav-link-text">Register</span>
                </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('index') ? 'active' : ''}}" href="{{route('website.home')}}">
                        <span class="nav-link-text"><span class="iconify" data-icon="whh:website"style="margin-right:13px"></span> Website</span>
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading p-0 text-muted">
                <span class="docs-normal">Documentation</span>
            </h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
                    <i class="ni ni-spaceship"></i>
                    <span class="nav-link-text">Getting started</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
                    <i class="ni ni-palette"></i>
                    <span class="nav-link-text">Foundation</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
                    <i class="ni ni-ui-04"></i>
                    <span class="nav-link-text">Components</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                    <i class="ni ni-chart-pie-35"></i>
                    <span class="nav-link-text">Plugins</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link active-pro" href="upgrade.html">
                    <i class="ni ni-send text-dark"></i>
                    <span class="nav-link-text">Upgrade to PRO</span>
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" placeholder="Search" type="text">
                </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </form>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                <!-- Sidenav toggler -->
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
                </li>
                <li class="nav-item d-sm-none">
                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                    <i class="ni ni-zoom-split-in"></i>
                </a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                    <!-- Dropdown header -->
                    <div class="px-3 py-3">
                    <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
                    </div>
                    <!-- List group -->
                    <div class="list-group list-group-flush">
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">@if(Session::get('LoggedUser')){{{Session::get('LoggedUser')}}} @endif</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>2 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-2.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>3 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-3.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>5 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">Your posts have been liked a lot.</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-4.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>2 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                        </div>
                        </div>
                    </a>
                    <a href="#!" class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <img alt="Image placeholder" src="../assets/img/theme/team-5.jpg" class="avatar rounded-circle">
                        </div>
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0 text-sm">John Snow</h4>
                            </div>
                            <div class="text-right text-muted">
                                <small>3 hrs ago</small>
                            </div>
                            </div>
                            <p class="text-sm mb-0">A new issue has been reported for Argon.</p>
                        </div>
                        </div>
                    </a>
                    </div>
                    <!-- View all -->
                    <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                </div>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-ungroup"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                    <div class="row shortcuts px-4">
                    <a href="#!" class="col-4 shortcut-item">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                        <i class="ni ni-calendar-grid-58"></i>
                        </span>
                        <small>Calendar</small>
                    </a>
                    <a href="#!" class="col-4 shortcut-item">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                        <i class="ni ni-email-83"></i>
                        </span>
                        <small>Email</small>
                    </a>
                    <a href="#!" class="col-4 shortcut-item">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                        <i class="ni ni-credit-card"></i>
                        </span>
                        <small>Payments</small>
                    </a>
                    <a href="#!" class="col-4 shortcut-item">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                        <i class="ni ni-books"></i>
                        </span>
                        <small>Reports</small>
                    </a>
                    <a href="#!" class="col-4 shortcut-item">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                        <i class="ni ni-pin-3"></i>
                        </span>
                        <small>Maps</small>
                    </a>
                    <a href="#!" class="col-4 shortcut-item">
                        <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                        <i class="ni ni-basket"></i>
                        </span>
                        <small>Shop</small>
                    </a>
                    </div>
                </div>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{url('/assets/img/upload/admin_image')}}/{{Session::get('LoggedUser')->user_image}}">
                    </span>
                    <div class="media-body  ml-2  d-none d-lg-block">
                        <span class="mb-0 text-sm  font-weight-bold">@if(Session::get('LoggedUser')){{{Session::get('LoggedUser')->user_name}}} @endif</span>
                    </div>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
                    <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <a href="#!" class="dropdown-item">
                    <i class="ni ni-single-02"></i>
                    <span>My profile</span>
                    </a>
                    <a href="#!" class="dropdown-item">
                    <i class="ni ni-settings-gear-65"></i>
                    <span>Settings</span>
                    </a>
                    <a href="#!" class="dropdown-item">
                    <i class="ni ni-calendar-grid-58"></i>
                    <span>Activity</span>
                    </a>
                    <a href="#!" class="dropdown-item">
                    <i class="ni ni-support-16"></i>
                    <span>Support</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#!" class="dropdown-item">
                    <i class="ni ni-user-run"></i>
                    <a href="{{route('logout')}}">Logout</a>
                    </a>
                </div>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <div class="container" style="max-width: 1440px;">
            @yield('content')
        </div>
    
  <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>      
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
  <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/1.11.3/dataRender/ellipsis.js"></script>
  @stack('scripts')
</body>
</html>