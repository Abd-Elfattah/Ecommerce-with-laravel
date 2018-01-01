@extends('layouts.profile')


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

	<div class="span11" style="margin-left: 75px;">
	    <ul class="breadcrumb">
			<li><a href="{{asset('Eco-home')}}">Home</a> <span class="divider">/</span></li>
			<li class="active"> {{$user->firstname . " " .$user->lastname}} <!-- <span class="divider">/</span> --></li>
	    </ul>
		<hr class="soft"/>
    
			


		<div class="profile-sidebar span3" style="margin-left:2px; width:240px">				
			
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
						<a href="{{route('user.orders' , Auth::user()->id)}}">
						<i class="fa fa-shopping-cart" style="margin-left:5px ;font-size: 26px;margin-top: 5px"></i>
						<span style="margin-left:7px">My Orders</span> 
					</a>
					</li>
					
					
				</ul>
			</div>
		</div>

		
		<div class="span7" style="width:798px">
			<h3 style="margin:0;float:left">Shipping Addresses</h3>	
			<a href="{{ route('user.create.address' , $user->id) }}" class="btn" style="font-weight: bold;float:right;margin-top:5px">Create Address</a>			
		</div>


		<div class="span7" style="background-color:#fafafa ;color:#5a647c;margin-top:20px;">
			<div class="addresses" style="margin-left: 30px;margin-top:20px;padding-bottom: 30px">
				@if( $user->addresses->count() > 0 )
					<?php $i=1; ?>
					@foreach( $user->addresses as $address )
						@if($address == $user->addresses()->first())
							<p style="margin: 0; margin-bottom: -10px;font-size: 18px;font-weight:bold">Address <?php echo $i; ?></p> <br>
							<span style="font-size: 15px">{{ $address->city . ", " . $address->area . " ." }}</span> <br>
							<span style="font-size: 14px;font-weight: bold">{{ $address->mobile }}</span>
							<!-- <span> verified or not</span> -->
						@endif
						@if($user->addresses()->count() > 1 && $address != $user->addresses()->first())
							<hr class="soft" style="width:50%" />
							<h4 style="margin: 0; margin-bottom: -10px">Address <?php echo $i; ?></h4> <br>
							<span style="font-size: 15px">{{ $address->city . ", " . $address->area . " ." }}</span> <br>
							<span style="font-size: 14px;font-weight: bold">{{ $address->mobile }}</span>
							<!-- <span> verified or not</span> -->

						@endif
						<?php $i++; ?>
					@endforeach
				@else 
					<p style="font-size: 23px">You haven't any address</p>
				@endif
			</div>
		</div>

		

</div>

	

@stop


