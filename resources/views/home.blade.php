
@extends('layouts.master')
@extends('head.home')
@section('content')
@include('layouts.navbar')
        <!-- Content Wrapper. Contains page content ==================================================-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>

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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4>Company Name</h4>

                        <p>{{Auth::user()->company}}</p>
                    </div>
                    <div class="icon">

                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{--{{$num_user->count()}}--}}5</h3>
                        <p>Employees</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$company->count()/100}}<sup style="font-size: 20px">%</sup></h3>

                        <p>Companies Registered</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$num->count()}}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->


        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

                <!-- Chat box -->
                <div class="box box-success">
                    <div class="box-header">
                        <i class="fa fa-comments-o"></i>

                        <h3 class="box-title">Dashboard Employee Notice Board Chat</h3>

                        <div class=" pull-right" >
                            <div class="btn-group" >
                                @if(Auth::user()->role==1)
                       <a href="{{route('newComment',['id'=>Auth::user()->id])}}" class="btn btn-default btn-sm "><i class="fa fa-2x fa-pencil-square text-green"></i></a>
                                    @elseif(Auth::user()->role==2)
                                    <a href="{{route('newComment',['id'=>Auth::user()->id])}}" class="btn btn-default btn-sm "><i class="fa fa-2x fa-pencil-square text-green"></i></a>
                                    @else
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="box-body chat" id="chat-box">
                        @if($comments != Null)
                        @foreach($comments as $comment)
                        <!-- chat item -->
                        <div class="item">
                            <img src="/dist/img/avatar.png" alt="user image" class="online">

                                <a href="#" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$comment->created_at->diffForHumans() }}</small>

                                </a>

                                    <blockquote class="message">

                                        <h5>{{$comment->superv_name}}<small>Supervisor</small></h5>
                                {!! $comment->content !!}
                                        <br>
                                        <small class="pull-left">{{$comment->getNumCommentsStr()}}</small>
                               </blockquote>


                                    @foreach($comment->comments as $doc)
                            <div class="attachment">
                                <blockquote class="message">

                                <h5>{{$doc->name}}</h5>

                                    <p>{{$doc->content}}</p>
                                <hr>
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$doc->created_at->diffForHumans() }}</small>
                            </blockquote>

                            </div>
                                    @endforeach



                            <!-- /.attachment -->
                        </div>
                        <!-- /.item -->


                    </div>
                    <!-- /.chat -->

                    <div class="box-footer">
                        <form action="{{route('createComment',['id'=>$comment->id])}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="name" value="{{Auth::user()->name}}">
                        <div class="input-group">

                            <input class="form-control" name="content" placeholder="Type message...">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>
                    @endforeach
                    @endif
                    {{$comments->links()}}
                </div>
                <!-- /.box (chat box) -->

                <!-- TO DO List -->
                {{--<div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title">To Do List</h3>

                        <div class="box-tools pull-right">
                            <ul class="pagination pagination-sm inline">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <li>
                                <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <!-- checkbox -->
                                <input type="checkbox" value="">
                                <!-- todo text -->
                                <span class="text">Design a nice theme</span>
                                <!-- Emphasis label -->
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                                <input type="checkbox" value="">
                                <span class="text">Make the theme responsive</span>
                                <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>



                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                        <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                    </div>
                </div>--}}
                <!-- /.box ================-->



            </section>
            <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>

@extends('script.table_dash')
@endsection
