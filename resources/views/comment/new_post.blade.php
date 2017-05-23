
@extends('layouts.master')
@extends('head.post')
@section('content')
@include('layouts.navbar')
<!-- Content Wrapper. Contains page content ====================-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            To Do Job card

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

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Supervisor
                            <small>Job allocator</small>
                        </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form action="{{route('createPost')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" value="{{$post->id}}">
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            Assign task to your employee dashboard...
                    </textarea>
                            <br>
                            <div class="group-form">
                                <input type="submit" class="btn btn-success fa fa-paper-plane" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper ===============================-->
@endsection
@extends('script.post')