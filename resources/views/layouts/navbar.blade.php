<?php
/**
 * Created by PhpStorm.
 * User: slamtony
 * Date: 2017/04/12
 * Time: 3:33 PM
 */
        ?>

<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/dist/img/user.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                {{Auth::user()->name}} {{Auth::user()->surname}} - {{Auth::user()->company}}
                                <small>
                                    @if(Auth::user()->role==1)
                                        administrator
                                        @elseif(Auth::user()->role==2)
                                        Supervisor
                                        @else
                                        Employee
                                        @endif
                                </small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/user_profile',['id'=>Auth::user()->id])}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<!-- Left side column. contains the logo and sidebar -->
@if(Auth::user()->role==1)
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                {{--Status here--}}
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION Admin</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/home"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    <li class="active"><a href="{{route('employees')}}"><i class="fa fa-circle-o"></i> Employees</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>My Company</span>
            <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('company')}}"><i class="fa fa-circle-o"></i> Add Company</a></li>
                    <li><a href="{{route('create_employee')}}"><i class="fa fa-circle-o"></i> Create Employee</a></li>

                </ul>
            </li>
            <li>
                <a href="{{route('service')}}">
                    <i class="fa fa-th-list"></i> <span>Add Services</span>

                </a>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Company</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('company_list')}}"><i class="fa fa-circle-o"></i> Company List</a></li>

            </li>

        </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>
@elseif(Auth::user()->role==2)
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/dist/img/user.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                    {{--Status here--}}
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION Supervisor</li>
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/home"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                        <li class="active"><a href="{{route('employees')}}"><i class="fa fa-circle-o"></i> Employees</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>My Company</span>
            <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('company')}}"><i class="fa fa-circle-o"></i> Add Company</a></li>
                        <li><a href="{{route('create_employee')}}"><i class="fa fa-circle-o"></i> Create Employee</a></li>

                    </ul>
                </li>




        </section>
        <!-- /.sidebar -->
    </aside>
@else
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/dist/img/user.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                    {{--Status here--}}
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION Employee</li>
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/home"><i class="fa fa-circle-o"></i>Dashboard</a></li>
                        <li class="active"><a href="{{route('view_jobs',['id'=>Auth::user()->id])}}"><i class="fa fa-circle-o"></i> My Job Card</a></li>

                    </ul>
                </li>




        </section>
        <!-- /.sidebar -->
    </aside>
@endif
