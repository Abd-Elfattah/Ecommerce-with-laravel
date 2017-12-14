@extends('layouts.home')






@section('content')

	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{asset('Eco-home')}}">Home</a> <span class="divider">/</span></li>
		<li class="active"> Shopping Cart</li>
    </ul>
	<h3>  Shopping Cart <a href="{{url('/Eco-home')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
	<!-- <table class="table table-bordered">
		<tr><th> I AM ALREADY REGISTERED  </th></tr>
		 <tr> 
		 <td>
			<form class="form-horizontal">
				<div class="control-group">
				  <label class="control-label" for="inputUsername">Username</label>
				  <div class="controls">
					<input type="text" id="inputUsername" placeholder="Username">
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="inputPassword1">Password</label>
				  <div class="controls">
					<input type="password" id="inputPassword1" placeholder="Password">
				  </div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn">Sign in</button> OR <a href="register.html" class="btn">Register Now!</a>
				  </div>
				</div>
				<div class="control-group">
					<div class="controls">
					  <a href="forgetpass.html" style="text-decoration:underline">Forgot password ?</a>
					</div>
				</div>
			</form>
		  </td>
		  </tr>
	</table> -->		
	@if(count(Session::get('cart_id')))
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  
				  <th>Price (EGP)</th>
                  <th>Discount (EGP)</th>                  
                  <th>After Discount (EGP)</th>
                  <th></th>
				</tr>
              </thead>
              <tbody>

     	@foreach(Session::get('cart') as $product)
     		
                <tr>
                  <td> <a href="{!! url('Eco-home/product',$product->id)!!}"><img width="60" src="{{asset($product->photos()->first()->path)}}" alt=""/></a></td>
                  <td>{{ $product->name }}<br/>Color : black, Brand : {{$product->brand->name}}</td>
				  
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->offer_price == 0 ? "0" : ($product->price - $product->offer_price)  }}</td>
                  <td>{{ $product->offer_price == 0 ? $product->price : $product->offer_price }}</td>
                  <td><a class="btn btn-danger" href="{{url('deleteFromCart', $product->id)}}" type="button"><i class="icon-remove icon-white"></i></a> </td>
                </tr>
				
				
                
            
        @endforeach

		</tbody>
	</table>


	<table class="table table-bordered" style="width:40%">
		<tbody>
			<tr>
		      <td style="text-align:left">Total Price:	</td>
		      <td style="width:40%">{{ Session::get('totall_without_discount') }}</td>
		    </tr>
			 <tr>
		      <td style="text-align:left">Total Discount:	</td>
		      <td style="width:40%">{{ Session::get('totall_discount') }}</td>
		    </tr>
		     
		      
			 <tr>
		      <td style="text-align:left"><strong>TOTAL  </strong></td>
		      <td class="label label-important" style="display:block"> <strong> {{ Session::get('totall_price') }} (EGP)</strong></td>
		    </tr>
		</tbody>
	</table>
	
            
			
			
	<!-- <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a> -->
		<a href="login.html" class="btn btn-large pull-right">Checkout <i class="icon-arrow-right"></i></a>
	@else 

		<h2>Cart is Empty</h2>
	@endif	

</div>

	




@stop



