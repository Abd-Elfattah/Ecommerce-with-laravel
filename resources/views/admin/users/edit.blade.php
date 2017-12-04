@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-6 col-lg-offset-3" style="padding-left:0">
                            Edit User
                            
                        </h1>
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                @if(Session::has('editUser'))
                                    <ol class="breadcrumb">
                                        <li class="active">
                                            <i class="fa fa-user"></i> 
                                            <span class="text-success text-center">{{ session('editUser') }}</span>
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
            {!! Form::model( $user , ['method'=>'PATCH' , 'action'=>['AdminUsersController@update' , $user->id]]) !!}

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
                    {!! Form::select('is_admin' , array(1 => 'Adminstrator' , 0 => 'Client'), null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group pull-left">
                
                    {!! Form::submit('Edit User' , ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}


            <!-- DELETE FORM -->
            {!! Form::model($user , ['method'=>'DELETE' , 'action'=>['AdminUsersController@destroy' , $user->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete User' , ['class' => 'btn btn-danger' , 'style'=>'margin-left:10px']) !!}
                </div>
            {!! Form::close() !!}
            <!-- DELETE FORM -->
        </div>
    </div>

            
            
    </div>

    


@stop
