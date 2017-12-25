@extends('layouts.profile')


@section('styles')
	<style type="text/css">
		.profile {
		  margin: 20px 0;
		}

		/* Profile sidebar */
		.profile-sidebar {
		  padding: 20px 0 10px 0;
		  background: #fff;
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
		<hr class="soft"/>
    
			


		<div class="profile-sidebar span2" style="margin-left:2px; width:230px">				
			
			<div class="profile-usermenu">
				<ul class="nav">
					
					<li class="active">
						<a href="#">
						<i class="fa fa-user fa-fw" style="float: left; font-size: 26px;margin-top: 5px"></i>
						<span style="display:block">{{$user->firstname . " " . $user->lastname}}</span>
						<small style="">{{$user->email}}</small>
					</a>
					</li>
					<li>
						<a href="#">
						<i class="fa fa-shopping-cart" style="margin-left:5px ;font-size: 26px;margin-top: 5px"></i>
						My Orders </a>
					</li>
					<li>
						<a href="#" target="_blank">
						<i class="fa fa-map-marker" style="margin-left:10px ;font-size: 26px;margin-top: 5px"></i>
						<span>Addresses</span> 
					</a>
					</li>
					
				</ul>
			</div>
		</div>
		

</div>

	

@stop


@section('scripts')

<script type="text/javascript">
	function link(x){
		window.location = x;
	}
</script>

@stop