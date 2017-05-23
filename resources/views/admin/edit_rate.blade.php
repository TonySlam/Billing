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
        <div class="row">
            <div class="col-md-12">
                <!-- Your Page Content Here -->
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Employee Rate</h3>
                    </div>
                    <div class="box-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/rate/rate',$rate->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                          <input  type="text" class="form-control" name="title" value="{{ $rate->title }}">
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
                 <input  type="text" class="form-control" name="rate" value="{{ $rate->rate }}">
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
                                        <i class="fa fa-btn fa-user"></i> Edit Rate
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@extends('script.form')
@endsection