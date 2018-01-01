@extends('layouts.home')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('Eco-home')}}">Home</a> <span class="divider">/</span></li>
        <li class="active"> Sign-In</li>
    </ul>
<div id="sidebar" class="centered span6">
<table class="table table-bordered">
        <tr><th> I AM ALREADY REGISTERED  </th></tr>
         <tr> 
         <td>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('Eco-home/login') }}">
                 {{ csrf_field() }}
                <div class="control-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="control-label" for="email" >E-mail</label>
                  <div class="controls">
                    <input type="email" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block" style="color:#b94a48">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>



                <div class="control-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="control-label" for="password">Password</label>
                  <div class="controls">
                    <input type="password" id="password" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block" style="color:#b94a48">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="control-group" style="margin-left:180px">
                    
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                            </label>
                        </div> 
                </div>




                <div class="control-group">
                  <div class="controls">
                        <button type="submit" class="btn btn-primary" style="margin-right:6px">Login</button>OR <a href="{{url('Eco-home/register')}}" class="btn">Register Now!</a>
                  </div>
                </div>


               <!--  <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">

                    </div>
                </div> -->
                <!-- <div class="control-group">
                    <div class="controls">
                      <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
                    </div>
                </div>  -->         
            </form>


            <!-- <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
 -->
                        <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
 -->
                                <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a> -->
                           <!--  </div>
                        </div> -->
                    <!-- </form> -->
          </td>
          </tr>
</table>

</div>
</div>

@endsection
