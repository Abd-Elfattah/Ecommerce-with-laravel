@extends('layouts.admin')

@section('content')

    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Categories

                        </h1>
                        
                    </div>
                </div>
    <!-- /.row -->


    <!-- row -->

        <!-- <div class="row"> -->
                    <div class="col-lg-4 col-lg-offset-1">

                        @if(Session::has('emptyCategory'))
                                <ol class="breadcrumb">
                                    <li class="active">
                                        <i class="fa fa-user"></i> 
                                        <span class="text-danger">{{ session('emptyCategory') }}</span>
                                    </li>
                                </ol>

                        @endif

                        <h2>Edit Category</h2>

                            {!! Form::model($category ,[ 'method'=>'PATCH' , 'action'=>['CategoryController@update' , $category->id]]) !!}

                                <div class="form-group">
                                    {!! Form::label('name','Name :') !!}
                                    {!! Form::text('name' , null , ['class'=>'form-control']) !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::submit('Edit Category' , ['class' => 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                    </div>
        <!-- </div> -->

    <!-- row -->




    <!-- row -->
        <!-- <div class="row"> -->

                <!-- pagination -->


            </div>
        <!-- </div> -->
    <!-- row -->


@stop

