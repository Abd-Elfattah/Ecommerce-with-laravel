@extends('layouts.home')






@section('content')

	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{asset('Eco-home')}}">Home</a> <span class="divider">/</span></li>
		<li class="active"> Shopping Cart</li>
    </ul>
	<h3>Shopping Cart<a href="{{route('homePage')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
	
@if(Session::has('cart'))		
	@if( $cart->totQty > 0)
	<table class="table table-bordered" style="margin-bottom: 40px">
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
                  <td> <a href="{{ route('product.color',['product_id'=>$product['product_id'] , 'color_id'=>$product['color_id']]) }}"><img width="60" src="{{asset(App\Photo::where(['product_id'=>$product['product_id'] ,'color_id'=>$product['color_id']])->first()->path)}}" alt=""/></a></td>
                  <td>{{ App\Product::find($product['product_id'])->name }}<br/>Color : {{ App\Color::find($product['color_id'])->name }}<br> Brand : {{App\Product::find($product['product_id'])->brand->name}}</td>

                  <td>
                  	@if(($quantity=App\Product::find($product['product_id'])->colors()->where('color_id',$product['color_id'])->first()->pivot->quantity) > 0 )
                  	<select class="form-control" style="width:60px" onchange="location = this.value;">
                  		<!-- <option selected disabled>Qty</option> -->
                  		@if($product['quantity'] == 1)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>1 ])}}" selected>1</option>
                  		@elseif($product['quantity'] != 1)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>1 ])}}">1</option>
                  		@endif

                  		@if($product['quantity'] == 2 && $quantity >=2)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>2 ])}}" selected>2</option>
                  		@elseif($product['quantity'] != 2 &&  $quantity >= 2)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>2 ])}}">2</option>
                  		@endif


                  		@if($product['quantity'] == 3 &&  $quantity >= 3)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>3 ])}}" selected>3</option>
                  		@elseif($product['quantity'] != 3 && $quantity >= 3)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>3 ])}}">3</option>
                  		@endif

                  		@if($product['quantity'] == 4 &&  $quantity >= 4)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>4 ])}}" selected>4</option>
                  		@elseif($product['quantity'] != 4 && $quantity >= 4)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>4 ])}}">4</option>
                  		@endif


                  		@if($product['quantity'] == 5 &&  $quantity >= 5)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>5 ])}}" selected>5</option>
                  		@elseif($product['quantity'] != 5 && $quantity >= 5)
                  		<option value="{{route('product.changeQuantity' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] , 'count'=>5 ])}}">5</option>
                  		@endif
                  	</select>


                  	@if( $quantity <= 5)
                  		<p style="color:#b94a48">only {{$quantity}} Remind</p>
                  	@endif

	                @elseif( $quantity == 0 )
	                	<p style="color:#b94a48;margin-top: 18px;margin-left: 10px">Out of Stock</p>
	                @endif	

                  </td>



                  <td>
                  	@if($quantity > 0)
	                  	@if($product['quantity'] > 1 && $quantity > 1)
	                  		{{($product['price']+$product['discount'])*$product['quantity']}} <br>
	                  		{{ " ( ". ($product['price']+$product['discount']) ." For 1 )" }}

	                  	@else
	                  		{{($product['price']+$product['discount'])}}
	                  	@endif
	                @else
	                	<p style="color:#b94a48;margin-top: 18px;margin-left: 10px"> - - - - - - - - -</p>
	                @endif
                  </td>
                  <td>
                  	@if($quantity > 0)
	                  	@if($product['discount'] == 0)
	                  		0

	                  	@elseif($product['quantity'] > 1 && $quantity > 1)
	                  		{{($product['discount']*$product['quantity'])}} <br>
	                  		{{ " ( ". ($product['discount']) ." For 1 )" }}
	                  	@else
	                  		{{($product['discount'])}}
	                  	@endif
	                @else
	                	<p style="color:#b94a48;margin-top: 18px;margin-left: 10px"> - - - - - - - - - </p>
	                @endif
                  </td>
                  <td>
                  	@if($quantity > 0)
	                  	@if($product['quantity'] > 1 && $quantity > 1)
	                  		{{($product['price']*$product['quantity'])}} <br>
	                  		{{ " ( ". ($product['price']) ." For 1 )" }}
	                  	@else
	                  		{{($product['price'])}}
	                  	@endif
	                @else
	                	<p style="color:#b94a48;margin-top: 18px;margin-left: 10px"> - - - - - - - - - </p>
	                @endif
                  </td>
                  <td><a class="btn btn-danger" href="{{route('product.removeFromCart' , ['product_id' => $product['product_id'] , 'color_id' => $product['color_id'] ] )}}" type="button"><i class="icon-remove icon-white"></i></a> </td>
                </tr>
				
				
                
            
        @endforeach

		</tbody>
	</table>


	<table class="table table-bordered pull-left" style="width:40%;margin-right: 35px" >
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
	
            
		
			
			
		
			{!! Form::open(['method'=>'POST' , 'action'=>'CartController@checkOut' , 'class'=>'pull-left']) !!}
			<div class="form-group">
				@if(Auth::user()->addresses->count() > 0)
				<p style="font-size: 18px;font-weight: bold">Select Address</p>
				@foreach(Auth::user()->addresses as $address)
					<p style="font-size: 15px;font-weight: bold">
						<input type="radio" name="address_id" value="{{$address->id}}">
						<span>{{ $address->city }}</span>
						<span>, {{ $address->area }}</span>
						<p style="margin-left:20px;margin-top: -10px;font-weight: bold">{{ $address->mobile }}</p>
					</p>
				@endforeach
				@endif
				<button class="btn btn-large btn-success pull-left">Checkout <i class="icon-arrow-right"></i></button>

			</div>
			{!! Form::close() !!}
		
	@else 
		<h2>Cart is Empty</h2>
	@endif	
	
@else 
	<h2>Cart is Empty</h2>
@endif

</div>

	




@stop

