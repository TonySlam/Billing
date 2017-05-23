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
            <small>Employees ></small>

        </h1>
        <ol class="breadcrumb">

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

    <!-- Main content =========================-->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Job card - Daily-Monthly Rate Calculator</h3>
                        <h4>{{$employee->name}} {{$employee->surname}} <small>Job Card</small></h4>
                        <hr>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {{ var_dump(old('qty.0')) }}
                        <form action="{{route('post_techDyn')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user_rate" value="{{$employee->rate}}">
                            <input type="hidden" name="user_id" value="{{$employee->id}}">


                            <div class="form-group">
                                <input type="date" name="date" placeholder="yyyy/mm/dd" class="form-control pull-right">
                            </div>
                            <br><br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>


                                <th>Service</th>
                                <th>Number of Service</th>
                                {{--<th>Service Rate</th>
                                <th>Amount</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $key => $p)

                                <tr>


                                    <td>{{$p}}</td>
                                    <td class="service" id="service">

                                        <div class="form-group{{ $errors->has('qty[]') ? ' has-error' : '' }}">



                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa  fa-i-cursor"></i>
                                                    </div>
                              <input type="text" value="{{ old('qty.1')}}" name="qty[]" class="form-control" value="{{ old('qty[]') }}">
                                                </div>
                                                @if ($errors->has('qty[]'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty[]') }}</strong>
                                    </span>
                                                @endif
                                            </div>




                                    </td>


                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <td style="border: none">



                                    <input type="submit" class="btn btn-success" value="Save">
                                </td>
                                <td style="border: none">

                                </td>


                            </tr>
                            </tfoot>


                        </table>
</form>
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
{{--
@extends('script.date')--}}
