<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
{{-- 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div id="app" class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
   

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/project.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              {{Auth::user()->name}}
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item active">
                <router-link to="/dashboard"  class="nav-link">
                  <i class="fas fa-tachometer-alt "></i>
                  <p>Dashboard</p>
               </router-link>
              </li>
              

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
              <i class="fas fa-cogs    "></i>
              <p>
                Managment
                  <i class="right fa fa-angle-left"></i>  
              </p>
              
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link  to="/teachers" class="nav-link ">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Teacher</p>
                </router-link>
              </li>
              
               <li class="nav-item">
                <router-link to="/students" class="nav-link " href="#">
                 <i class="fas fa-user"></i>
                  <p>Student</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/courses" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Courses</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/departments" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Department</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a 
                class="nav-link"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"  
            >
              <i class="fas fa-power-off"></i>
              
              <p>
                Logout
              </p>
            </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
             </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header --> 

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{-- Important to add Router View --}}
          <router-view></router-view>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->


</body>
</html>