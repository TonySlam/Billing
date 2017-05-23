@extends('head.form')
@extends('layouts.master')

@section('content')
@include('layouts.navbar')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add
            <small>Service</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
        <div class="alert-warning">
            @foreach( $errors->all() as $error )

                <br> {{ $error }}
            @endforeach
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Service Table</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Service Number</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                            @if($services != null)
                                @foreach($services as $service)
                            <tr>
                                <td>{{$service->service_no}}</td>
                                <td>{{$service->description}}</td>
                                <td>{{$service->unit}}</td>
                                <td>R{{$service->rate}}</td>
                                <td>
                                    @if(Auth::user()->role==2)
                                        <p>No Action</p>
                                        @elseif(Auth::user()->role==3)
                                        No Action
                                        @else

                                    <a href="/service/{{ $service->id }}" class="btn btn-danger">Remove <i class="fa fa-close"></i></a>
                                        <a href="{{route('service_edit',['id'=>$service->id])}}" class="btn btn-info">Edit <i class="fa fa-1x fa-pencil-square"></i></a>
                                        @endif
                                </td>
                            </tr>
                                @endforeach
                                @endif

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
@if(Auth::user()->role==2)

    @elseif(Auth::user()->role==3)

    @else
        <div class="row">
            <div class="col-md-12">
                <!-- Your Page Content Here -->
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Service</h3>
                    </div>
                    <div class="box-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/post_service') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('service_no') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Service Number</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-gears"></i>
                                        </div>
                                        <input  type="text" class="form-control" name="service_no" value="{{ old('service_no') }}">
                                    </div>
                                    @if ($errors->has('service_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('service_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </div>
                                        <input  type="text" class="form-control" name="description" value="{{ old('description') }}">
                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Unit</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <input  type="text" class="form-control" name="unit" value="{{ old('unit') }}">
                                    </div>
                                    @if ($errors->has('unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Rate</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa  fa fa-money"></i>
                                        </div>
                                        <input  type="text" class="form-control" name="rate" value="{{ old('rate') }}">
                                    </div>
                                    @if ($errors->has('rate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Add Service
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Rate Table</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Title</th>
                                    <th>Rate</th>
                                    <td>Action</td>

                                </tr>
                                @if($rates != null)
                                    @foreach($rates as $rate)
                                        <tr>
                                            <td>{{$rate->title}}</td>
                                            <td>{{$rate->rate}}%</td>

                                            <td>
                                                @if(Auth::user()->role==2)
                                                    <p>No Action</p>
                                                @elseif(Auth::user()->role==3)
                                                    No Action
                                                @else
                           <a href="/rate/{{ $rate->id }}" class="btn btn-danger">Remove <i class="fa fa-close"></i></a>
                                                    <a href="{{route('rate_edit',['id'=>$rate->id])}}" class="btn btn-info">Edit <i class="fa fa-1x fa-pencil-square"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Your Page Content Here -->
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Employee Rate</h3>
                    </div>
                    <div class="box-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/createRate') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <input  type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    </div>
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Rate</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa  fa fa-money"></i>
                                        </div>
                                        <input  type="text" class="form-control" name="rate" value="{{ old('rate') }}">
                                    </div>
                                    @if ($errors->has('rate'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Add Rate
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </section>
    <!-- /.content -->
</div>
@extends('script.form')
@endsection