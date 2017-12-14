@extends('layouts.home')


@section('content')



<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{url('/Eco-home')}}">Home</a> <span class="divider">/</span></li>
		<li class="active">Registeration</li>
    </ul>
	<h3> Sign-Up</h3>	
	<div class="well">
	<!--
	<div class="alert alert-info fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	<div class="alert fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	 <div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div> -->
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
		{{ csrf_field() }}
		<h4>Your personal information</h4>
		
		<div class="control-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
			<label class="control-label" for="firstname">First name <sup>:</sup></label>
			<div class="controls">
			  <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required autofocus>

			  	@if ($errors->has('firstname'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('firstname') }}</strong>
	                </span>
            	@endif
			</div>
		 </div>



		 <div class="control-group">
			<label class="control-label" for="inputLnam">Last name <sup>:</sup></label>
			<div class="controls">
			  <input type="text" id="inputLnam" placeholder="Last Name">
			</div>
		 </div>




		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>:</sup></label>
		<div class="controls">
		  <input type="text" id="input_email" placeholder="Email">
		</div>
	  </div>	  
	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>:</sup></label>
		<div class="controls">
		  <input type="password" id="inputPassword1" placeholder="Password">
		</div>
	  </div>


	  <div class="control-group">
		<label class="control-label" for="inputPassword1">Confirm Password <sup>:</sup></label>
		<div class="controls">
		  <input type="password" id="inputPassword1" placeholder="Password">
		</div>
	  </div>	  
		
		
	
		<div class="control-group">
			<div class="controls">
				
				<input class="btn btn-success" type="submit" value="Register" />
			</div>
		</div>



				
	</form>
</div>


@stop