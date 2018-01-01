@extends('layouts.home')
@section('styles')
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	<style type="text/css">
		.discount{
			padding: 10px 14px;
			opacity:0.95;
		}

		.product-cart, .product-except{
			margin-top:-35px;
		}
	</style>
@stop

@section('content')


	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="{{url('/Eco-home')}}">Home</a> <span class="divider">/</span></li>
    <li><a href="{!! url('Eco-home/sub-category',$product->brand->subcategory->id) !!}">{{$product->brand->subcategory->name}}</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>

    
    
	<div class="row">

			<div class="span4">
				<div class="slider">
    	
	    		@foreach($photos as $photo)
				    <div><img src="{{asset($photo->path)}}" style="height:300px"></div>
	            @endforeach
			</div>
			</div>	  
			
			<div class="span5">
				<h3>{{$product->name . " - " . $color->name . " color"}} 
				@if( ($quantity = $color_product->quantity) >0 && !$product->offer_price == 0)
				<span class="discount">
					{{ floor(100 - ($product->offer_price/$product->price)*100 ) }}% off
				</span>
				@endif
				</h3>
				@if( $quantity > 0)
					<hr class="soft"/>
				@endif
				
				  <div style="margin-bottom:30px">
					<label class="control-label" style="width:300px">
						@if($product->offer_price == 0 && $quantity > 0)
							<span class="price">{{ $product->price }} EGP</span>
							
						@elseif($quantity > 0)
							<span class="price" style="font-size:19px;font-weight:bold">{{ $product->offer_price }} EGP</span>
							<span class="before-discount" style="margin-left:15px">{{ $product->price }} EGP</span>
						@endif
					</label>


					<div class="controls">
						<input type="hidden" class="product-id" value="{{ $product->id }}">
						<input type="hidden" class="color-id" value="{{ $color->id }}">


				@if(Session::has('cart') &&  Session::get('cart')->totQty > 0 && $quantity > 0 )
					@if(array_key_exists($color_product->id , Session::get('cart')->items))
						<a class="btn btn-large btn-primary pull-right product-cart" href="{{route('product.removeFromCart' ,['product_id'=>$product->id ,'color_id'=>$color->id])}}"> Remove From <i class=" icon-shopping-cart"></i></a>
					@elseif( $quantity > 0)
						<a class="btn btn-large pull-right product-cart" href="{{route('product.addToCart' ,['product_id'=>$product->id ,'color_id'=>$color->id])}}"> Add to cart <i class=" icon-shopping-cart"></i></a>
					@endif

				@elseif( $quantity > 0)
					<a class="btn btn-large pull-right product-cart" href="{{route('product.addToCart' ,['product_id'=>$product->id ,'color_id'=>$color->id])}}"> Add to cart <i class=" icon-shopping-cart"></i></a>
				@endif
					</div>



				  </div>
				
				
					<hr class="soft"/>


				@if( $quantity > 10)
					<h4>{{$color_product->quantity}} items in stock</h4>
				@elseif($quantity <= 10 && $quantity > 0)
					<h4 style="color:#b94a48">only {{$color_product->quantity}} items in stock</h4>
				@elseif($quantity == 0)
					<h3 style="color:#b94a48">Out Of Stock</h3>
				@endif


				  <div style="margin-top:6px">
					<h4>Color : {{ $color->name }}</h4>
					@if(count($other_colors) > 0)
					<h5 style="color:#006DCC">Other Colors :
						@foreach($other_colors as $color)
							@if($color == $other_colors->first())
								<a href="{{route('product.color',[$product->id , $color->id])}}">{{$color->name}}</a>
							@else
								<span style="color:black"> , </span><a href="{{route('product.color',[$product->id , $color->id])}}">{{$color->name}}</a>
							@endif
						@endforeach
					</h5>
					@endif
				  </div>
			<hr class="soft"/>
				
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>

			@if( $quantity == 0)
				<hr class="soft clr" style="margin-top: 100px" />
			@else
				<hr class="soft clr" style="margin-top: 60px" />
			@endif

			


			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
              <!-- <li><a href="#profile" data-toggle="tab">Related Products</a></li> -->
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered" style="width: 60%">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Brand </td><td class="techSpecTD2">{{$product->brand->name}}</td></tr>

				@foreach($product->values as $value)
					<tr class="techSpecRow"><td class="techSpecTD1">{{$value->option->name}} </td><td class="techSpecTD2">{{$value->name}}</td></tr>
				@endforeach

				
				
				</tbody>
				</table>
				
				<h5>Description</h5>
				<p>
				{{$product->description}}
				</p>


              </div>
		
				<br class="clr">
			</div>
		
		</div>
	</div>

</div>

@stop
		


@section('scripts')
	
  		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
		
		<script type="text/javascript">
				$(document).ready(function(){
		      	
	     	 		$('.slider').bxSlider();
					
				});


		</script>

	
@stop