@extends('head.form')
@extends('layouts.master')

@section('content')
@include('layouts.navbar')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{Auth::user()->company}}
            <small>Add Company</small>
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
                        <h3 class="box-title">Company Registration</h3>
                    </div>
                    <div class="box-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/post_company') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Company Name</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-suitcase"></i>
                                        </div>
                                        <input id="company" type="text" class="form-control" name="company" value="{{ old('name') }}">
                                    </div>
                                    @if ($errors->has('company'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-map"></i>
                                        </div>
                                        <textarea type="text" class="form-control" name="address" value="{{ old('address') }}"></textarea>
                                    </div>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input id="phone" type="text" data-inputmask='"mask": "(999) 999-9999"' data-mask class="form-control" name="phone" value="{{ old('phone') }}">
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Website</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa  fa fa-envelope"></i>
                                        </div>
                                        <input id="website" type="url" class="form-control" name="website" value="{{ old('website') }}">
                                    </div>
                                    @if ($errors->has('website'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>





                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
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