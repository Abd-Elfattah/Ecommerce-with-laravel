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
		<li class="active">Special Offers</li> 
		
    </ul>
	<h3>Special Products<small class="pull-right" style="margin-top:10px">
	@if(!empty($products))
		{{count($products)}}	
	@else {{"No"}}

	@endif
	products are available </small></h3>	
	<hr class="soft"/>
	
	<!-- <form class="form-horizontal span6">
		<div class="control-group">
		  <label class="control-label alignL">Sort By </label>
			<select>
              <option>Priduct name A - Z</option>
              <option>Priduct name Z - A</option>
              <option>Priduct Stoke</option>
              <option>Price Lowest first</option>
            </select>
		</div>
	  </form> -->

	  



<br class="clr"/>
<div class="tab-content">
	<!-- <div class="tab-pane" id="listView">
		<div class="row">	  
			<div class="span2">
				<img src="{{ asset('themes/images/products/3.jpg') }}" alt=""/>
			</div>
			<div class="span4">
				<h4>Product Name </h4>					
				<hr class="soft"/>
				
				<p>
				Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - 
				that is why our goods are so popular..
				</p>
				<a class="btn btn-small pull-right" href="product_details.html">View Details</a>
				<br class="clr"/>
			</div>
			<div class="span3 alignR">
			<form class="form-horizontal qtyFrm">
			<h3> $140.00</h3>
			
			  <a href="product_details.html" class="btn btn-large "> Add to <i class=" icon-shopping-cart"></i></a>
			  
			
				</form>
			</div>
		</div>
		<hr class="soft"/>
		
	</div> -->

	<div class="tab-pane  active" id="blockView">
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
							   	<span class="discount" style="position:relative;top:-310px;left:-14px;">
									{{ floor((100-(($product->offer_price/$product->price)*100)) ) }}% off
									</span>
							   	<p class="before-discount">
										{{$product->price}} EGP
								</p>
							   
							</div>
						  </div>
						</li>
			@endforeach
		@endif

			

		
			
		  </ul>
	<hr class="soft"/>
	</div>
</div>

	
	<div class="pagination" style="text-align:center">
			@if($products)
				{{ $products->render() }}
			@endif
	</div>

			
			<br class="clr"/>
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