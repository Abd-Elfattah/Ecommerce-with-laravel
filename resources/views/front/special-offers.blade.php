@extends('layouts.home')

@section('styles')

	<style type="text/css">
		.before-discount{
			
			margin-top: -85px;
			margin-left:110px;
			height: 55px;
		}
		.discount{
			opacity:0.9;
		}
	</style>

@stop



@section('content')
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ route('homePage') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Special Offers</li> 
		
    </ul>
	<h3>Special Offers Products
	<small class="pull-right" style="margin-top:10px">
		@if($count > 0)
			{{$count}}	
		@else {{"No"}}

		@endif
		products are available 
	</small>
		
	</h3>	
	<!-- <hr class="soft"/> -->

	@if($count == 0)
	<div class="span9">
		<h3>No Offers</h3>
	</div>
	@endif
	


	




<div class="tab-content">
	
	<div class="tab-pane  active" id="blockView">
		<ul class="thumbnails">

		@if($products)
			@foreach($products as $product)
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
							  <h5 class="product-name" style="margin-bottom: 30px;"><a  href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">{{$product->name}}</a></h5>



						<!-- if offer price found -->
						@if($product->offer_price != 0)								  
						<!-- if offer price found -->
									  	<h4 style="text-align:center"><input type="hidden" class="product-id" value="{{ $product->id }}">

									
							
							@if($color_product=$color->pivot)
								@if( Session::has('cart') && Session::get('cart')->totQty > 0 )
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

							


										   <!-- if offer price found -->
										   	<span class="price">{{$product->offer_price}} EGP</span>
										   <!-- if offer price found -->

										   	</h4>
										   	<span class="discount" style="position:relative;top:-310px;left:-14px;">
												{{ floor((100-(($product->offer_price/$product->price)*100)) ) }}% off
											</span>
										   	<p class="before-discount">
													{{$product->price}} EGP
											</p>
						@endif
						<!-- if offer price found -->

							</div>
						  </div>
						</li>
						<?php break ?>
					@endif
				@endforeach
			@endforeach
		@endif
			
		  </ul>

		  @if($count > 0)
		  <hr class="soft"/>

		  <div class="pagination" style="text-align: center;">
		  	{{$products->render()}}
		  </div>
		  @endif
		  

		<br class="clr"/>
	</div>
</div>

	
	


<br class="clr"/>


</div>

@stop





@section('scripts')
		
		<script type="text/javascript">
	
				

				$(document).ready(function(){
				
					$('#sortBy').on('change' , function(){
						if( $(this).val() == 'brands'){
							
							$('#brands').show();
							window.stop();
						}
					});					

				});

			

		</script>

	
@stop