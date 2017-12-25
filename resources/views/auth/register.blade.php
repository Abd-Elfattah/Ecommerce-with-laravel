@extends('layouts.home')

@section('styles')
    <style type="text/css">
        label{
            margin-right: 30px;
        }
    </style>

@stop

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('/Eco-home')}}">Home</a> <span class="divider">/</span></li>
        <li class="active">Registeration</li>
    </ul>
    <h3> Sign-Up</h3>   
    <div class="well" style="width:80%">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('Eco-home/register') }}">
                        {{ csrf_field() }}

                        <div class="control-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name </label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

                                @if ($errors->has('firstname'))
                                    <span class="help-block pull-right">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="control-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name </label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                                @if ($errors->has('lastname'))
                                    <span class="help-block pull-right">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

                                @if ($errors->has('email'))
                                    <span class="help-block pull-right">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block pull-right">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                
                                <input class="btn btn-success" type="submit" value="Register" style="margin-left:50px ;margin-top: 10px" />
                            </div>
                        </div>
                    </form>
</div>

@endsection

