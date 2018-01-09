@extends('layouts.home')

@section('styles')
<style type="text/css">
		.before-discount{
			
			margin-top: -85px;
			margin-left:110px;
			height: 55px;
		}

		.tag{
			background:none;
		}
		.discount_offers{
			background-color:#da4f49;
			height:auto;
			width:55px;
			color:white;
			padding: 6px 10px;
			font-size:15px;
			margin-right: 10px;
			font-weight: bold;
			opacity:0.88;
			right: -10px;
		}

		.price{
			color:#006dcc;
			margin-left:8px;
			font-size:19px;
		}

		.before-Discount{
			text-decoration: line-through;
			color: #b8b894;
			font-size:16px;
			position: relative;
			left:-10px;
			top:-20px;
			float: right;

		}
</style>
@stop

@section('content')

<div class="span9">	

<div class="well well-small" style="height: 350px">
<h4><a href="{{route('offers')}}">Best Offers</a> <small class="pull-right">{{ count($offer_products) . " Offers Available" }}</small></h4>
<div class="row-fluid">
	<div id="featured" class="carousel slide" >
		<div class="carousel-inner" >


			<div class="item active">
			  <ul class="thumbnails">
			  	<?php $offers = array_slice($offer_products, 0 , 4) ?>
			  @foreach($offers as $product)
				@foreach( $product->colors()->withPivot('id')->get() as $color )
					@if( $color->pivot->quantity == 0 )	
						<?php continue ?>
					@elseif( $color->pivot->quantity > 0 )


						<li class="span3">
						  <div class="thumbnail">
						  	<span class="tag discount_offers">
								{{ floor((100-(($product->offer_price/$product->price)*100)) ) }}% off
							</span>
							<a href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">
								<img height="160px" src="{{ asset($product->photos()->where('color_id', $color->id)->first()->path ) }}" alt=""></a>
							<div class="caption">
							  <h5><a style="color:#555" href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">{{ $product->name }}</a></h5>
							  <!-- Rating -->
							  <div style="margin-left:30px">
							  		<div id="productRating{{$product->id}}" class="pull-left"></div>
							  		<span id="ratingUsers{{$product->id}}"></span>
							  </div>
							   <h4><a class="btn" href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">VIEW</a> 
							   	<span class="price pull-right">{{$product->offer_price}} EGP</span>
							   	<p class="before-Discount">{{$product->price}} EGP</p>
							   </h4>
							</div>
						  </div>
						</li>


						<?php break; ?>
					@endif
				@endforeach
			@endforeach
			  </ul>
			</div>


			@if($count = count($offer_products) > 4)
			<?php $offers = array_slice($offer_products, 4) ?>
	        @for($i=1;count($offers) > 0 ; $i++)
				<?php 
    				if($i==1){
    				      $offers = array_slice($offer_products,$i*4,4);
    				}
				?>
			<div class="item">
			  <ul class="thumbnails">
		       
			  @foreach($offers as $product)
				@foreach( $product->colors()->withPivot('id')->get() as $color )
					@if( $color->pivot->quantity == 0 )	
						<?php continue ?>
					@elseif( $color->pivot->quantity > 0 )


						<li class="span3">
						  <div class="thumbnail">
						  	<span class="tag discount_offers">
								{{ floor((100-(($product->offer_price/$product->price)*100)) ) }}% off
							</span>
							<a href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">
								<img height="160px" src="{{ asset($product->photos()->where('color_id', $color->id)->first()->path ) }}" alt=""></a>
							<div class="caption">
							  <h5><a style="color:#555" href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">{{ $product->name }}</a></h5>
							  <!-- Rating -->
							  <div style="margin-left:20px">
							  		<div id="productRating{{$product->id}}" class="pull-left"></div>
							  		<span id="ratingUsers{{$product->id}}"></span>
							  </div>
							   <h4><a class="btn" href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">VIEW</a> 
							   	<span class="price pull-right">{{$product->offer_price}} EGP</span>
							   	<p class="before-Discount">{{$product->price}} EGP</p>
							   </h4>
							</div>
						  </div>
						</li>


						<?php break; ?>
					@endif
				@endforeach
				
			@endforeach
			
			  </ul>
			</div>
			<?php 
				
				$offers = array_slice($offer_products,($i+1)*4,4);
				if(count($offers) == 0){
				    break;
				}
			?>
			@endfor

			@endif

		</div>

		
		  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
		  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			
	</div>
  </div>
</div>



<h3>Latest Products </h3>
	  <ul class="thumbnails">
			@if($latest_products)
			@foreach($latest_products as $product)
				@foreach( $product->colors()->withPivot('id')->get() as $color )
					@if( $color->pivot->quantity == 0 )	
						<?php continue ?>
					@elseif( $color->pivot->quantity > 0 )
						<li class="span3">
							
						  <div class="thumbnail">
							<a href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">
							<img class="product-image" src="{{ asset($color->photos()->where('product_id',$product->id)->first()->path) }}" alt=""/>
							</a>
							<div class="caption">
							  <h5 class="product-name" style="margin-bottom: 10px;"><a  href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">{{$product->name}}</a></h5>

							  <!-- Rating -->
							  <div style="margin-left:70px">
							  		<div id="productRating{{$product->id}}" class="pull-left"></div>
							  		<span id="ratingUsers{{$product->id}}"></span>
							  </div>
							  


						<!-- if No offer price found -->
						@if($product->offer_price == 0)
						  
					   		 <h4 style="text-align:center">
						
							@if($color_product=$color->pivot)
								@if(Session::has('cart') && Session::get('cart')->totQty > 0 )
									@if(array_key_exists($color_product->id , Session::get('cart')->items))
									
										<a style="font-weight:bold"  class="btn btn-danger product-cart" href="{{route('product.removeFromCart' ,['product_id'=>$product->id ,'color_id'=>$color->id])}}">Remove <i class="icon-shopping-cart"></i>
										   		</a>
									@else
										<a style="font-weight:bold"  class="btn product-cart" href="{{route('product.addToCart' ,['product_id'=>$product->id ,'color_id'=>$color->id])}}">Add To <i class="icon-shopping-cart"></i>
										   		</a>
									@endif

								@else

										<a style="font-weight:bold"  class="btn product-cart" href="{{route('product.addToCart' ,['product_id'=>$product->id ,'color_id'=>$color->id])}}">Add To <i class="icon-shopping-cart"></i>
										   		</a>
								@endif
							@endif

							
						   	<span class="price">{{$product->price}} EGP</span>				
						   	</h4>
						 <!--  	<span class="discount" style="position:relative;top:-310px;left:-14px;opacity:0">-->
							<!--	0% off-->
							<!--</span>-->
						 <!--  	<p class="before-discount" style="opacity:0">-->
							<!--		0 EGP-->
							<!--</p>-->
						@endif
						<!-- if No offer price found -->

							   
							</div>
						  </div>
						</li>
						<?php break ?>
					@endif
				@endforeach
			@endforeach
		@endif
			
		  </ul>

</div>



@stop





@section('scripts')
		<script type="text/javascript">
			$(document).ready(function(){

				var url = "{{route('homeRating')}}";
				$.get(url,function(data){
					console.log(data);
						$.each(data,function(index,product){
							var id=product[0];
							var rating=product[1];
							var count=product[2];
							$("#productRating"+id).rateYo({
							    rating: rating,
							    starWidth:"13px",
							    spacing:"5px",
							    readOnly:true
							});

							$('#ratingUsers'+id).text("("+ count +")");
							
						});
											
				});

				
			});
		</script>

	
@stop