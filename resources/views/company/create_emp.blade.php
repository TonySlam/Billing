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
            <small>Employee Registration</small>
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
                <h3 class="box-title">Employee Registration</h3>
            </div>
            <div class="box-body">

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/post_employee') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
</div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Surname</label>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                    <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}">
</div>
                    @if ($errors->has('surname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
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

           {{-- <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Company</label>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-suitcase"></i>
                        </div>
                    <input id="company" type="text" class="form-control" name="company" value="{{Auth::user()->company}}">
</div>
                    @if ($errors->has('company'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>--}}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa  fa fa-envelope"></i>
                        </div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
</div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </div>
                    <input id="password" type="password" class="form-control" name="password">
</div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
</div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
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