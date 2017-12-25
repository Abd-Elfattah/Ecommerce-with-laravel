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

		table tbody tr td{
			text-align: center !important;
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
					<li>
						<a href="{{route('user.address' , $user->id)}}">
						<i class="fa fa-map-marker" style="margin-left:10px ;font-size: 26px;margin-top: 5px"></i>
						<span style="margin-left:7px">Addresses</span> 
					</a>
					</li>
					<li class="active">
						<a href="{{route('user.orders' , Auth::user()->id)}}">
						<i class="fa fa-shopping-cart" style="margin-left:5px ;font-size: 26px;margin-top: 5px"></i>
						<span style="margin-left:7px">My Orders</span> 
					</a>
					</li>
					
					
				</ul>
			</div>
		</div>


		<div class="span7" style="width:795px">
			<h3 style="margin:0;float:left">My Orders</h3>	
			<a href="{{ route('user.create.address' , $user->id) }}" class="btn" style="font-weight: bold;float:right;margin-top:5px">Sort By</a>			
		</div>


		
	
<div class="span7" style="width:740px;padding-top: 15px">
	@if( count($payments) > 0 )
		@foreach( $payments as $payment)
		<div class="span7" style="background-color:#fafafa;padding-left:5%;margin-bottom: 30px;margin-left:0px;
		width:757px">
			<div style="margin-top:20px">
				<div>
					
					<h5>
						<span>Date : </span> 
						<span style="margin-left: 15%">Time : </span> 
						<span style="margin-left: 15%">Status : 
							@if($payment->is_delivered == 0)
								{{ "Processing" }}
							@else
								{{ "Delivered" }}
							@endif
						</span>
					</h5>
					
				</div>
				<table class="table table-bordered" style="width:90%;">
					<tbody>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Payment Num</td>
							<td class="techSpecTD2">Number of Products</td>
							<td class="techSpecTD2">Totall-Price (EGP)</td>
							<td class="techSpecTD2">totall-Discount (EGP)</td>
							<td class="techSpecTD2">After-Discount (EGP)</td>
						</tr>
						<tr>
							<td class="techSpecTD1">{{ $payment->id }}</td>
							<td class="techSpecTD1">{{ $payment->orders->count() }}</td>
							<td class="techSpecTD1">{{ $payment->totall_before_discount }}</td>
							<td class="techSpecTD1">{{ $payment->totall_discount }}</td>
							<td class="techSpecTD1">{{ $payment->totall_price }}</td>
						</tr>
						
					</tbody>
				</table>
				<p style="font-weight: bold;margin-bottom: 0px">More Details :</p>
				<table class="table table-bordered" style="width:90%">
					<tbody>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Product</td>
							<td class="techSpecTD2">Color</td>
							<td class="techSpecTD2">Quantity</td>
							<td class="techSpecTD2">Before-discount (EGP)</td>
							<td class="techSpecTD2">Discount (EGP)</td>
							<td class="techSpecTD2">Price (EGP)</td>
						</tr>
						@foreach($payment->orders as $order)
						<?php $product = App\Product::findOrFail($order->product_id);  ?>
						<?php $color = App\Color::findOrFail($order->color_id) ;?>

						<tr class="techSpecRow">
							<td class="techSpecTD1">{{ $product->name }}</td>
							<td class="techSpecTD2">{{ $color->name }}</td>
							<td class="techSpecTD2">{{ $order->quantity }}</td>
							<td class="techSpecTD2">
								@if($order->quantity == 1)
									{{ $order->price_before_discount }}
								@else
									{{ $order->price_before_discount*$order->quantity . 
										" (" . $order->price_before_discount . " For 1)" }}
								@endif
							</td>
							<td class="techSpecTD2">
								@if($order->quantity == 1)
									{{ $order->discount }}
								@else
									@if($order->discount != 0)
										{{ $order->discount*$order->quantity . 
											" (" . $order->discount . " For 1)" }}
									@elseif($order->discount == 0)
										{{ $order->discount }}
									@endif
								@endif
							</td>
							<td class="techSpecTD2">
								@if($order->quantity == 1)
									{{ $order->price }}
								@else
									{{ $order->price*$order->quantity . 
										" (" . $order->price . " For 1)" }}
								@endif
							</td>
							
						</tr>

						@endforeach

						

						
					</tbody>
				</table>
			</div>


		</div>

		@endforeach
	@else
		<h3>You haven't any Orders</h3>
	@endif



	<!-- Pagination -->
<div class="span7 pagination text-center" style="margin-top:-10px;width:740px;margin-left: 270px">
    @if($payments)
        {{$payments->render()}}
    @endif
</div>
		<!-- Pagination -->


</div>

		
		


</div>

	

@stop

