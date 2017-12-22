@extends('layouts.home')


@section('styles')
	<style type="text/css">
		.profile {
		  margin: 20px 0;
		}

		/* Profile sidebar */
		.profile-sidebar {
			margin-top: -30px;		  
		}

		.profile-userpic img {
		  float: none;
		  margin: 0 auto;
		  width: 50%;
		  height: 50%;
		  -webkit-border-radius: 50% !important;
		  -moz-border-radius: 50% !important;
		  border-radius: 50% !important;
		}

		.profile-usertitle {
		  text-align: center;
		  margin-top: 20px;
		}

		.profile-usertitle-name {
		  color: #5a7391;
		  font-size: 16px;
		  font-weight: 600;
		  margin-bottom: 7px;
		}

		.profile-usertitle-job {
		  text-transform: uppercase;
		  color: #5b9bd1;
		  font-size: 12px;
		  font-weight: 600;
		  margin-bottom: 15px;
		}

		.profile-userbuttons {
		  text-align: center;
		  margin-top: 10px;
		}

		.profile-userbuttons .btn {
		  text-transform: uppercase;
		  font-size: 11px;
		  font-weight: 600;
		  padding: 6px 15px;
		  margin-right: 5px;
		}

		.profile-userbuttons .btn:last-child {
		  margin-right: 0px;
		}
		    
		.profile-usermenu {
		  margin-top: 30px;
		}

		.profile-usermenu ul li {
		  border-bottom: 1px solid #f0f4f7;
		}

		.profile-usermenu ul li:last-child {
		  border-bottom: none;
		}

		.profile-usermenu ul li a {
		  color: #93a3b5;
		  font-size: 14px;
		  font-weight: 400;
		}

		.profile-usermenu ul li a i {
		  margin-right: 8px;
		  font-size: 14px;
		}

		.profile-usermenu ul li a:hover {
		  background-color: #fafcfd;
		  color: #5b9bd1;
		}

		.profile-usermenu ul li.active {
		  border-bottom: none;
		}

		.profile-usermenu ul li.active a {
		  color: #5b9bd1;
		  background-color: #f6f9fb;
		  border-left: 2px solid #5b9bd1;
		  margin-left: -2px;
		}

		/* Profile Content */
		.profile-content {
		  background: #fff;
		  min-height: 460px;
		}

		.nav>li>a{
			position: relative;
    		display: block;
    		padding: 10px 15px;
		}
	</style>


@stop


@section('content')

	<div class="span9">
	    <ul class="breadcrumb">
			<li><a href="{{asset('Eco-home')}}">Home</a> <span class="divider">/</span></li>
			<li class="active"> User Profile <!-- <span class="divider">/</span> --></li>
	    </ul>
    
			


		<div class="profile-sidebar span2" style="margin-left:2px; width:230px">				
			
			<div class="profile-usermenu">
				<ul class="nav">
					
					<li >
						<a href="#">
						<i class="fa fa-user fa-fw" style="float: left; font-size: 26px;margin-top: 5px"></i>
						<span style="display:block">{{$user->firstname . " " . $user->lastname}}</span>
						<small style="">{{$user->email}}</small>
					</a>
					</li>
					<li class="active">
						<a href="{{route('user.address' , $user->id)}}">
						<i class="fa fa-map-marker" style="margin-left:10px ;font-size: 26px;margin-top: 5px"></i>
						<span style="margin-left:7px">Addresses</span> 
					</a>
					</li>
					<li>
						<a href="#">
						<i class="fa fa-shopping-cart" style="margin-left:5px ;font-size: 26px;margin-top: 5px"></i>
						<span style="margin-left:7px">My Orders</span> 
					</a>
					</li>
					
					
				</ul>
			</div>
		</div>
		<div class="span6" style="width:608px">
			<h3 style="margin:0;float:left">Create Address</h3>	
						
		</div>
		<div class="span6" style="background-color:#fafafa ;color:#5a647c;margin-top:20px;width:608px">
			<div style="margin-top:20px;margin-left: 30px">
				<h5 style="margin-bottom: 10px">Country : Egypt</h5>
				
				 {!! Form::open(['method'=>'POST' , 'action'=>['ProfileController@storeAddress' , $user->id] , 'style'=>'margin-bottom:30px']) !!}
				 	{{csrf_field()}}

					<div class="form-group">
						<label for="city" style="margin-right: 20px">City </label>
						<input type="text" name="city" id="city" style="width:260px">
						@if ($errors->has('city'))
                            <span class="help-block alert-danger">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
						<label for="area" style="margin-right: 20px">Area </label>
						<input type="text" name="area" id="area" style="width:260px">
						@if ($errors->has('area'))
                            <span class="help-block alert-danger">
                                <strong>{{ $errors->first('area') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
						<label for="Location" style="margin-right: 20px">Location Type </label>
						<select id="Location" name="location_type">
							<option selected disabled>Select</option>
							<option value="Home">Home</option>
							<option value="Business">Business</option>
						</select>
						@if ($errors->has('location_type'))
                            <span class="help-block alert-danger">
                                <strong>{{ $errors->first('location_type') }}</strong>
                            </span>
                        @endif	
					</div>

					<div class="form-group" style="margin-top:15px">
						<label for="mobile" style="margin-right: 20px">Mobile </label>
						<input type="text" name="mobile" id="mobile" class="form-control">
						@if ($errors->has('mobile'))
                            <span class="help-block alert-danger">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" style="font-weight: bold;margin-top:20px;">Create Address</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
		



	

@stop

