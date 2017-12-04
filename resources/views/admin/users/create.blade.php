@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-6 col-lg-offset-3" style="padding-left:0">
                            Create Users
                            
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
            {!! Form::open(['method'=>'POST' , 'action'=>'AdminUsersController@store']) !!}

                <div class="form-group">
                    {!! Form::label('firstname','First Name :') !!}
                    {!! Form::text('firstname' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('lastname','Last Name :') !!}
                    {!! Form::text('lastname' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email','E-mail :') !!}
                    {!! Form::email('email' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password','Password :') !!}
                    {!! Form::password('password' , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('is_admin','Role :') !!}
                    {!! Form::select('is_admin' , array(1 =>'Adminstrator' , 0 =>'Client'), null , ['class'=>'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::submit('Create User' , ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>


@stop
