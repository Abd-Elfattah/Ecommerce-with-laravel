@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-6 col-lg-offset-3" style="padding-left:0">
                            Edit Sub-Categories
                            
                        </h1>

                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                @if(Session::has('editSub'))
                                    <ol class="breadcrumb">
                                        <li class="active">
                                            <i class="fa fa-user"></i> 
                                            <span class="text-success text-center">{{ session('editSub') }}</span>
                                        </li>
                                    </ol>

                                @endif
                            </div>
                        </div>

                    </div>
                </div>
    <!-- /.row -->


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            {!! Form::model($sub , ['method'=>'PATCH' , 'action'=>['SubCategoryController@update' , $sub->id] ]) !!}


                <div class="form-group">
                    {!! Form::label('category_id','Category :') !!}
                    {!! Form::select('category_id' , $categories , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name','Name :') !!}
                    {!! Form::text('name' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attr1','Attribute 1 :') !!}
                    {!! Form::text('attr1' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attr2','Attribute 2 :') !!}
                    {!! Form::text('attr2' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attr3','Attribute 3 :') !!}
                    {!! Form::text('attr3' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attr4','Attribute 4 :') !!}
                    {!! Form::text('attr4' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('attr5','Attribute 5 :') !!}
                    {!! Form::text('attr5' , null , ['class'=>'form-control']) !!}
                </div>

                
                <div class="form-group">
                    {!! Form::submit('Edit Sub-Category' , ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}

            <!-- DELETE FORM -->
            {!! Form::model($sub , ['method'=>'DELETE' , 'action'=>['SubCategoryController@destroy' , $sub->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete Sub-Category' , ['class' => 'btn btn-danger']) !!}
                </div>
            {!! Form::close() !!}
            <!-- DELETE FORM -->


        </div>
    </div>


@stop
