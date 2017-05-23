
@extends('layouts.master')
@extends('head.table')
@section('content')
@include('layouts.navbar')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{Auth::user()->company}}
            <small>Employees</small>
        </h1>
        <ol class="breadcrumb">

        </ol>
    </section>

    <!-- Main content =========================-->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Employees Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>

                                <td>
                                    {{$employee->name}}
                                </td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td> {{$employee->company}}</td>
                                    <td>
                                        @if($employee->role==1)
                                            Admin
                                            @elseif($employee->role==2)
                                          <i class="fa fa-user-secret"></i>  <strong>Supervisor</strong>
                                        @else
                                            Employee
                                        @endif
                                    </td>
                                <td><a href="{{route('jobcard',['id'=>$employee->id])}}" class="btn btn-default">explore</a> </td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@extends('script.table_dash')