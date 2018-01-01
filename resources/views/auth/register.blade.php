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

                    <form class="form-horizontal" id="form" role="form" method="POST" action="{{ url('Eco-home/register') }}">
                        {{ csrf_field() }}

                        <div class="control-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name </label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

                                <span class="fail" style="display:none;color:#b94a48;margin-left: 20px;font-size: 15px;font-weight: bold">
                                <i class="fa fa-times-circle"></i><span></span>
                                </span>
                                <span class="success" style="display:none;color:#3c763d;;margin-left: 20px;font-size: 15px;font-weight: bold">
                                <i class="fa fa-check-circle"></i><span></span>
                                </span>

                                @if ($errors->has('firstname'))
                                    <span class="help-block" style="color:#b94a48;margin-left: 190px;">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="control-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name </label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
                                <span class="fail" style="display:none;color:#b94a48;margin-left: 20px;font-size: 15px;font-weight: bold">
                                <i class="fa fa-times-circle"></i><span></span>
                                </span>
                                <span class="success" style="display:none;color:#3c763d;;margin-left: 20px;font-size: 15px;font-weight: bold">
                                <i class="fa fa-check-circle"></i><span></span>
                                </span>
                                

                                @if ($errors->has('lastname'))
                                    <span class="help-block" style="color:#b94a48;margin-left: 190px;">
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
                                    <span class="help-block" style="color:#b94a48;margin-left: 190px;">
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
                                    <span class="help-block" style="color:#b94a48;margin-left: 190px;">
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

@section('scripts')
    <script type="text/javascript">
        // $(document).ready(function(){
        //     $('#firstname').keyup(function(){
        //         var value = $(this).val();
        //         if(value.length < 4){
        //             $(this).parent().find('.success').hide();
        //             $(this).parent().find('.fail').show();
        //             $(this).parent().find('.fail').find('span').text(' First Name at least 4');
                    

        //             $('#form').submit(function(evt){
        //                 evt.preventDefault();
        //             });
                    
        //         }else{
        //             $(this).parent().find('.success').show();
        //             $(this).parent().find('.fail').hide();
        //             $(this).parent().find('.success').find('span').text(' Success');
        //             var firstname = true;
        //             $( "#target" ).submit();

        //         }
        //     });


        //     $('#lastname').keyup(function(){
        //         var value = $(this).val();
        //         if(value.length < 4){
        //             $(this).parent().find('.success').hide();
        //             $(this).parent().find('.fail').show();
        //             $(this).parent().find('.fail').find('span').text(' First Name at least 4');
        //         }else{
        //             $(this).parent().find('.success').show();
        //             $(this).parent().find('.fail').hide();
        //             $(this).parent().find('.success').find('span').text(' Success');
        //         }
        //     });

            
        // });

    </script>
@stop