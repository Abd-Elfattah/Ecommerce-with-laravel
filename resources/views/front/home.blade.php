@extends('layouts.home')

@section('styles')
<style type="text/css">
		.before-discount{
			
			margin-top: -85px;
			margin-left:110px;
			height: 55px;
		}
</style>
@stop

@section('content')

<div class="span9">	
<ul class="breadcrumb">
	<li><a href="{!! url('Eco-home') !!}">Home</a> <span class="divider">/</span></li>
	
</ul>
<h3>Latest Products </h3>
	  <ul class="thumbnails">
			@if($products)
			@foreach($products as $product)
					
						<li class="span3">
							
						  <div class="thumbnail">
							<a href="{!! url('Eco-home/product',$product->id) !!}">
							<img class="product-image" src="{{ asset($product->photos->first()->path) }}" alt=""/>
							</a>
							<div class="caption">
							  <h5 class="product-name" style="margin-bottom: 30px;"><a  href="{!! url('Eco-home/product',$product->id) !!}">{{$product->name}}</a></h5>



				<!-- if offer price found -->
				@if($product->offer_price != 0)								  
									
																	  
						
								<!-- if offer price found -->
								  <h4 style="text-align:center"><input type="hidden" class="product-id" value="{{ $product->id }}">

						@if(Auth::check())	
							@if(Session::has('cart_id'))
								@if(in_array($product->id , Session::get('cart_id')) == 1 )
								   <a style="font-weight:bold"  class="btn btn-danger product-cart">Remove <i class="icon-shopping-cart"></i>
								   </a> 

								@endif 

								@if(in_array($product->id , Session::get('cart_id')) == 0 )
							   		<a style="font-weight:bold"  class="btn product-cart">Add To <i class="icon-shopping-cart"></i>
								   </a> 
								@endif

						   	@endif

							@if(!Session::has('cart_id'))

								   		<a style="font-weight:bold"  class="btn product-cart">Add To <i class="icon-shopping-cart"></i>
								   		</a>
							@endif


						@else
							<a style="font-weight:bold" href="{{ url('/login') }}" class="btn">Add To <i class="icon-shopping-cart"></i>
							</a>

						@endif

								   <!-- if offer price found -->
								  
							   	<span class="price">{{$product->offer_price}} EGP</span>
							   		
								   <!-- if offer price found -->

							   	</h4>
							   	<span class="discount" style="position:relative;top:-309px;left:-14px;">
									{{ floor((100-(($product->offer_price/$product->price)*100)) ) }}% off
									</span>
							   	<p class="before-discount">
										{{$product->price}} EGP
								</p>
			@endif
			<!-- if offer price found -->






							<!-- if No offer price found -->
							@if($product->offer_price == 0)
							  
							   		 <h4 style="text-align:center"><input type="hidden" class="product-id" value="{{ $product->id }}" >
							   	@if(Auth::check())
							   		 	@if(Session::has('cart_id'))
								  		@if(in_array($product->id , Session::get('cart_id')) == 1 )
									   <a style="font-weight:bold"  class="btn btn-danger product-cart">Remove <i class="icon-shopping-cart"></i>
									   </a> 

									   		@endif 

									   		@if(in_array($product->id , Session::get('cart_id')) == 0 )
								   		<a style="font-weight:bold"  class="btn product-cart">Add To <i class="icon-shopping-cart"></i>
									   </a> 
									   		@endif

									   	@endif

									   	@if(!Session::has('cart_id'))

									   		<a style="font-weight:bold"  class="btn product-cart">Add To <i class="icon-shopping-cart"></i>
									   		</a>


									   @endif
								@else
										<a style="font-weight:bold" href="{{ url('/login') }}" class="btn">Add To <i class="icon-shopping-cart"></i>
										</a>

								@endif	   
									   
							   			<span class="price">{{$product->price}} EGP</span>
							   			
									  

							   	</h4>

							   	<span class="discount" style="position:relative;top:-309px;left:-14px;opacity:0;"></span>
							   	<p class="before-discount"></p>
							@endif
							<!-- if No offer price found -->

							   
							</div>
						  </div>
						</li>
			@endforeach
		@endif		
		
	  </ul>	

</div>



@stop


@section('scripts')
		
		<script type="text/javascript">
	
				

				$(document).ready(function(){
				
					$('.product-cart').click(function(){

						var product_id = $(this).parent().find('.product-id').val();

						if($(this).hasClass('btn-danger')){
							$.ajax({
								type:'get',
								url:'{!!URL::to('removeFromCartAjax')!!}',
								data:{'id':product_id},
								success:function(cart_count){
								
									$('.new-cart-update').text(cart_count);
									


								},
								error:function(){
									
								}
							})

							$(this).removeClass('btn-danger').html('Add To <i class="icon-shopping-cart"></i>');





						// Add Session Product to Cart
						}else{
							$.ajax({
								type:'get',
								url:'{!!URL::to('addToCartAjax')!!}',
								data:{'id':product_id},
								success:function(cart_count){
									$('.new-cart-update').text(cart_count);

								},
								error:function(){

								}
							})


							$(this).addClass('btn-danger').html('Remove <i class="icon-shopping-cart"></i>');
							
						}

						
					});
			});


		</script>

	
@stop