
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
                        <h4>{{$user->name}}'s <small>Job Card</small></h4>
                        <hr>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                     {{--  <br>
                                <input type="text" style="width: 350px" class="form-control qty" name="qty[]" min="0" max="50">
                        <br>
                                <input type="text" style="width: 350px" class="form-control rate"  name="rate[]">
                        <br>--}}
                        <!-- Date range -->
                        @foreach($jobs as $key => $p)
                        <form action="{{route('get_total',['id'=>$p->user_id])}}" role="search">
                           {{-- {{csrf_field()}}--}}

                            <input type="hidden" class="form-control" value="{{$p->user_id}}" name="user_id">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Date range From:</label>
                            <input type="date" class="form-control" placeholder="yyyy/mm/dd" name="from" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date range To:</label>
                                    <input type="date" class="form-control" placeholder="yyyy/mm/dd" name="to" >
                                </div>
                            </div>

                            <!-- /.input group -->
                            <div class="form-group">
                                <input type="submit"   class="btn btn-success" value="Calculate">

                                </div>

                        <!-- /.form group -->
                        </form>
                    @break
                    @endforeach
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>Date / Day</th>
                                <th>Service</th>
                                <th>Number of Service</th>
                                <th>Tech Rate</th>
                                @if(Auth::user()->role==3)
                                    @else
                                <th class="text-info">No % rate</th>
                                <th>Service Rate</th>
                                <th>Amount</th>
                                @endif
                                <th class="text-blue">With % rate</th>
                                <th>Service Rate</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $key => $p)

                                <tr>

                                    <td>{{$p->date}}</td>
                                    <td>{{$p->description}}</td>
                                    <td >{{$p->num_service}}</td>
                                    <td> {{$p->user_rate}}%</td>
                                    @if(Auth::user()->role==3)
                                    @else
                                    <td class="alert-info"></td>

                                    <td>{{$p->rate}}</td>
                                    <td class="sub_combat">{{$p->amount}}</td>
                                    @endif
                                    <td class="alert-success"></td>

                                    <td > {{$p->rate*$p->user_rate/100}}</td>
                                    <td class="combat">{{$p->amount*$p->user_rate/100}}</td>

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
<script type="text/javascript">


    $('div').delegate('.qty,.rate','keyup',function () {
        var tr = $(this).parent().parent();
        var qty = tr.find('.qty').val();
        var rate = tr.find('.rate').val();

        var amount =(qty * rate);
        tr.find('.amount').val(amount);
        total();

    });

    $('.addRow').on('click',function () {
        addRow();
    });

    function total()
    {
        var total =0;
        $('.amount').each(function (i,e)
        {
            var amount = $(this).val()-0;
            total += amount;
        })
        $('.total').html(total.formatMoney(2,',',',','.')+" zar");
    };





</script>
<script type="text/javascript">
    $('#reservation').daterangepicker();

</script>

@endsection

@extends('script.table_dash')
{{--
@extends('script.date')--}}
