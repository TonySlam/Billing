
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
                        <h3 class="box-title">Job card Daily-Monthly Rate Calculator<small> Results</small></h3>
                        <h4><strong>{{$user->name}} {{$user->surname}}</strong> <small>Job Card > Net Profit</small></h4>
                        <hr>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

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
                            @foreach($search  as $p)

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
                            <tfoot>
                            <td style="border: none">
                                @if(Auth::user()->role==3)

                                    @else
                                <strong style="color: red;font-weight: bolder"></strong>
                                    @endif
                            </td>
                            @if(Auth::user()->role==3)
                                @else
                            <td style="border: none"></td>
                            <td style="border: none"></td>
                            <td style="border: none"></td>
@endif
                            <td style="border: none"></td>

                            @if(Auth::user()->role==3)
                                <td style="border: none"></td>
                            @else
                            <td>
                                <strong>Sub Total</strong>
                            </td>
                            @endif
                            @if(Auth::user()->role==3)
                                <td style="border: none"></td>
                            @else
                            <td class="sub-combat" style="color: red;font-weight: bolder"><b></b></td>

                            </td>
                            @endif
                            <td style="border: none"></td>
                            <td><strong>Total</strong></td>
                            <td class="total-combat" style="color: red;font-weight: bolder"><b></b></td>
                            </tfoot>

                        </table>

{{--<table>
                                @foreach($search  as $total)
<tr>
    <td class="combat">
                            {{ $total->amount}}
                                @endforeach
    </td>
</tr>
                                    <tr>
                                        <td class="total-combat">

                                        </td>
                                    </tr>
</table>--}}
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

<script>
    $(document).ready(function () {
        //iterate through each row in the table
        $('tr').each(function () {
            //the value of sum needs to be reset for each row, so it has to be set inside the row loop
            var sum = 0;
            //find the combat elements in the current row and sum it
            $('.combat').closest('tr').find('.combat').each(function () {
                var combat = $(this).text();
                if (!isNaN(combat) && combat.length !== 0) {
                    sum += parseFloat(combat);
                }
            });
            //set the value of currents rows sum to the total-combat element in the current row
            $('.total-combat', this).html("Zar "+sum.formatMoney('decPlaces'));

        });
    });

//first before deduction
    $(document).ready(function () {
        //iterate through each row in the table
        $('tr').each(function () {
            //the value of sum needs to be reset for each row, so it has to be set inside the row loop
            var sum = 0;
            //find the combat elements in the current row and sum it
            $('.sub_combat').closest('tr').find('.sub_combat').each(function () {
                var combat = $(this).text();
                if (!isNaN(combat) && combat.length !== 0) {
                    sum += parseFloat(combat);
                }
            });
            //set the value of currents rows sum to the total-combat element in the current row
            $('.sub-combat', this).html("Zar "+sum.formatMoney('decPlaces'));

        });
    });

    /*format number*/
    Number.prototype.formatMoney = function (decPlaces,thouSeparator,decSeparator) {
        var n = this,
                decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 :  decPlaces,
                decSeparator = decSeparator ==undefined ? "." :  decSeparator,
                thouSeparator = thouSeparator ==undefined ? "," :  thouSeparator,
                sign = n < 0 ? "-" : "",
                i = parseInt(n =  Math.abs(+n || 0).toFixed(decPlaces)) + "",
                j = (j = i.length) > 3 ? j % 3:0;
        return sign + (j ? i.substr(0,j) + thouSeparator : "")
                + i.substr(j).replace(/(\d{3})(?=\d)/g,"$1"+ thouSeparator)
                + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
    };
</script>
@endsection

@extends('script.form')
{{--
@extends('script.date')--}}