

@extends('layouts.master')
@extends('head.profile')
@section('content')
@include('layouts.navbar')
<meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
        <!-- Content Wrapper. Contains page content ===========================================-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Technician Job Card
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

    <!-- Main content ======================-->
    <section class="content">




        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/dist/img/user.png" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$employee->name}} {{$employee->surname}}</h3>

                        <p class="text-muted text-center">{{$employee->company}}</p>



                        <a href="{{route('view_jobs',['id'=>$employee->id])}}" class="btn btn-primary btn-block"><b>View Jobcard</b></a>

                        <br>

                        <a href="{{route('newComment',['id'=>$employee->id])}}" class="btn btn-primary btn-block"><b>Job Assign</b></a>
                        <br>
                       {{-- @if(Auth::user()->role==3)--}}
                        <a href="{{route('user_profile',['id'=>$employee->id])}}" class="btn btn-primary btn-block"><b>User Role</b></a>
                           {{-- @endif--}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->

                <div class="col-md-9">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Services Jobcard</h3>
                            <a href="{{route('jobcard_dynamic',['id'=>$employee->id])}}" class="btn btn-info">Dynamic Template</a>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data Table With Full Features</h3>
                                </div>
                                <!-- /.box-header -->

                                    <form action="{{route('post_tech')}}" class="ajax" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="user_rate" value="{{$employee->rate}}">
                                        <input type="hidden" name="user_id" value="{{$employee->id}}">
                                        <div class="form-group">
                                        <input type="date" name="date" required="required" placeholder="yyyy/mm/dd" class="form-control pull-right">
                                        </div>
                                        <br><br>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Number of Service</th>
                                            {{--<th>Rate</th>
                                            <th>Amount</th>--}}
                                            <th><a href="#" id="addRow"  class="btn btn-info addRow"><i class="fa  fa-plus-square"></i></a></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                              <select class="form-control productName" name="productName[]" id="productName">
                      <option selected="true" value="0" disabled="true">Select Product</option>
                                  @foreach($services as $key => $p)
                        <option id="{{$p}}" value="{!! $key !!}" @if(old('productName')==$p)selected="selected" @endif>
                            {!! $p  !!}
                        </option>
                                    @endforeach
                              </select>


                                            </td>

                                            <td>
                   <input type="text" value="{{ old('qty.0')}}" class="form-control qty" name="qty[]" min="0" max="50">
                                            </td>
                                            {{--<td>
                                                <input type="text" class="form-control rate" id="rate" value=""  name="rate[]">
                                            </td>
                                            <td>
                                          <input type="text"  name="amount[]" readonly="true" class="form-control amount" >
                                            </td>--}}
                                            <td>
                                                <a href=""  class="btn btn-danger remove"><i class="fa fa-times"></i></a>
                                            </td>


                                        </tr>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td style="border: none"></td>
                                            <td style="border: none"></td>
                                          {{--  <td style="border: none"></td>--}}
                                            <td ></td>
                                            {{--<td ><b class="total"></b></td>--}}

                                        </tr>
                                        </tfoot>

                                    </table>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" value="Save">
                                        </div>
                            </div>
                            <!-- /.box -->
                            </div>
                            </div>
                        </form>
                        </div>


                        <!-- /.box-body -->
                    </div>


    </section>
    <!-- /.content ================-->
</div>
<!-- /.content-wrapper ==================================================-->
<script type="text/javascript">


    $('tbody').delegate('.productName','change',function () {
        var tr=$(this).parent().parent();
        var id = tr.find('.productName').val();
        var dataId = {'id':id};

        var request = $.ajax({
            type : 'GET',
            url : '{!! URL::route('post_tech') !!}',
            dataType : 'json',
            data : dataId,
            success:function (data) {
                tr.find('rate').val(data.rate);
            }
        });

        request.done(function( msg ) {
            var response = JSON.parse(msg);
            console.log(response.msg);
        });

        request.fail(function( jqXHR, textStatus ) {
            console.log( "Request failed: " + textStatus );
        });
        return false;
    });

   $('tbody').delegate('.productName','change',function () {
     var tr =$(this).parent().parent();
       tr.find('.qty').focus();
   });

    $('tbody').delegate('.qty,.rate,.productName','keyup',function () {
    var tr = $(this).parent().parent();
    var qty = tr.find('.qty').val();
    var rate = tr.find('.rate').val();
    var amount =(qty * rate);
    tr.find('.amount').val(amount);
    total();

});

   /* var mytextbox = document.getElementById('rate');
    var mydropdown = document.getElementById('productName');

   mydropdown.onchange = function(){
        mytextbox.value = mytextbox.value  + this.value; //to appened
        //mytextbox.innerHTML = this.value;
    }*/

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
  function addRow()
    {
        var tr='<tr>'+
        '<td>'+
        '<select class="form-control productName" name="productName[]" id="">'+
        '<option selected="true" value="0" disabled="true">Select Product</option>'+
        '@foreach($services as $key => $p)'+
        '<option value="{!! $key !!}">{!! $p !!} </option>'+
        '@endforeach'+
        '</select>'+

        '</td>'+

        '<td><input type="text" value="{{ old('qty.0')}}" class="form-control qty" name="qty[]" min="0" max="50"></td>'+
        /* '<td><input type="text" class="form-control rate" name="rate[]"> </td>'+
         '<td><input type="text"  name="amount[]" readonly="true" class="form-control amount"></td>'+*/
        '<td><a href=""  class="btn btn-danger remove"><i class="fa fa-times"></i></a></td>'+
         '</tr>';
        $('tbody').append(tr);
    };

    $('.remove').live('click',function () {
        var l=$('tbody tr').length;
        if(l==1)
        {
            alert('You can not remove last one');
        }else{
            $(this).parent().parent().remove();
            total();
        }

    });

</script>
@endsection
@extends('script.form')