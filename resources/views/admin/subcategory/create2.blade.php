@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-6 col-lg-offset-3" style="padding-left:0">
                            Create Sub-Categories
                            
                        </h1>
                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
    <!-- /.row -->


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            {!! Form::open(['method'=>'POST' , 'action'=>['SubCategoryController@store2' , $sub->id]]) !!}


                @for($i=1;$i<=$count;$i++)
                    <div class="form-group">
                        <label for="option{{$i}}">Option {{$i}}</label>
                        <input type="text" name="option{{$i}}" id="option{{$i}}">
                    </div>
                @endfor
                

                

                
                <div class="form-group">
                    {!! Form::submit('Create Sub-Category' , ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>


@stop
