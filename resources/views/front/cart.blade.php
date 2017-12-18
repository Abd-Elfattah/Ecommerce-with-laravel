@extends('layouts.home')






@section('content')

	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{asset('Eco-home')}}">Home</a> <span class="divider">/</span></li>
		<li class="active"> Shopping Cart</li>
    </ul>
	<h3>Shopping Cart<a href="{{route('homePage')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
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
@if(Session::has('cart'))		
	@if( $cart->totQty > 0)
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Quantity</th>
				  <th>Price (EGP)</th>
                  <th>Discount (EGP)</th>                  
                  <th>After Discount (EGP)</th>
                  <th>Remove</th>
				</tr>
              </thead>
              <tbody>

     	@foreach($cart->items as $product)
     		
                <tr>
                  <td> <a href="{{ route('Eco-home.product',$product['product_id']) }}"><img width="60" src="{{asset(App\Photo::where(['product_id'=>$product['product_id'] ,'color_id'=>$product['color_id']])->first()->path)}}" alt=""/></a></td>
                  <td>{{ App\Product::find($product['product_id'])->name }}<br/>Color : {{ App\Color::find($product['color_id'])->name }}<br> Brand : {{App\Product::find($product['product_id'])->brand->name}}</td>
                  <td>
                  	<select class="form-control" style="width:60px" onchange="location = this.value;">
                  		<!-- <option selected disabled>Qty</option> -->
                  		@if($product['quantity'] == 1)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>1 ])}}" selected>1</option>
                  		@else
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>1 ])}}">1</option>
                  		@endif

                  		@if($product['quantity'] == 2)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>2 ])}}" selected>2</option>
                  		@else
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>2 ])}}">2</option>
                  		@endif


                  		@if($product['quantity'] == 3)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>3 ])}}" selected>3</option>
                  		@else
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>3 ])}}">3</option>
                  		@endif

                  		@if($product['quantity'] == 4)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>4 ])}}" selected>4</option>
                  		@else
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>4 ])}}">4</option>
                  		@endif


                  		@if($product['quantity'] == 5)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>5 ])}}" selected>5</option>
                  		@else
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>5 ])}}">5</option>
                  		@endif
                  	</select>
                  </td>
                  <td>
                  	@if($product['quantity'] > 1)
                  		{{($product['price']+$product['discount'])*$product['quantity']}} <br>
                  		{{ " ( ". ($product['price']+$product['discount']) ." For 1 )" }}

                  	@else
                  		{{($product['price']+$product['discount'])}}
                  	@endif
                  </td>
                  <td>
                  	@if($product['discount'] == 0)
                  		0

                  	@elseif($product['quantity'] > 1)
                  		{{($product['discount']*$product['quantity'])}} <br>
                  		{{ " ( ". ($product['discount']) ." For 1 )" }}
                  	@else
                  		{{($product['discount'])}}
                  	@endif
                  </td>
                  <td>
                  	@if($product['quantity'] > 1)
                  		{{($product['price']*$product['quantity'])}} <br>
                  		{{ " ( ". ($product['price']) ." For 1 )" }}
                  	@else
                  		{{($product['price'])}}
                  	@endif
                  </td>
                  <td><a class="btn btn-danger" href="{{route('product.removeFromCart' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] ] )}}" type="button"><i class="icon-remove icon-white"></i></a> </td>
                </tr>
				
				
                
            
        @endforeach

		</tbody>
	</table>


	<table class="table table-bordered" style="width:40%">
		<tbody>
			<tr>
		      <td style="text-align:left">Total Price	</td>
		      <td style="width:40%">{{ number_format($cart->totPrice+$cart->totDisc ,2) }}</td>
		    </tr>
			 <tr>
		      <td style="text-align:left">Total Discount	</td>
		      <td style="width:40%">{{ number_format($cart->totDisc,2) }}</td>
		    </tr>
		     
		      
			 <tr>
		      <td style="text-align:left"><strong>TOTAL (EGP) </strong></td>
		      <td class="label label-important" style="display:block"> <strong> {{ number_format($cart->totPrice,2) }} </strong></td>
		    </tr>
		</tbody>
	</table>
	
            
			
			
	<!-- <a href="products.html" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a> -->
		<a href="login.html" class="btn btn-large pull-right">Checkout <i class="icon-arrow-right"></i></a>
	@else 
		<h2>Cart is Empty</h2>
	@endif	
	
@else 
	<h2>Cart is Empty</h2>
@endif

</div>

	




@stop


@section('scripts')

<script type="text/javascript">
	function link(x){
		window.location = x;
	}
</script>

@stop