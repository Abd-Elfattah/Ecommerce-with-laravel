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
		<li class="active">{{$sub->name}}</li> 
		
    </ul>
	<h3>{{$sub->name}} Products<small class="pull-right" style="margin-top:10px">
	@if($count > 0)
		{{$count}}	
	@else {{"No"}}

	@endif
	products are available </small></h3>	
	<hr class="soft"/>

	
	

	@if(! ($count == 0 && $sort_type==null))
	<form class="form-horizontal span9">
		<div class="control-group">
		  <label class="control-label alignL" style="font-weight: bold">Sort By </label>
			<select id="sortBy" style="width: 170px" onchange="location = this.value;">
			@if(!$sort_type)
              <option selected disabled>Sort By</option>
            @endif

            @if($sort_type == 'low')
              <option value="{{ route('sortBy.priceLowestFirst',['id'=>$sub->id,'current_page'=>1]) }}" selected>Price Lowest first</option>
            @else
              <option value="{{ route('sortBy.priceLowestFirst' , ['id'=>$sub->id,'current_page'=>1]) }}">Price Lowest first</option>
            @endif

            	
            @if($sort_type == 'high' )
              <option value="{{ route('sortBy.priceHighestFirst' ,['id'=>$sub->id,'current_page'=>1]) }}" selected>Price Highest first</option>
            @else
            	<option value="{{ route('sortBy.priceHighestFirst' ,['id'=>$sub->id,'current_page'=>1]) }}">Price Highest first</option>
            @endif

            @if($sort_type == 'disc')
              <option value="{{ route('sortBy.discount' ,['id'=>$sub->id,'current_page'=>1]) }}" selected>Discount Only</option>
            @else
              <option value="{{ route('sortBy.discount' ,['id'=>$sub->id,'current_page'=>1]) }}">Discount Only</option>
            @endif

            @if($sort_type == 'brand')
              <option value="brands" selected>Brand</option>
            @else
              <option value="brands">Brand</option>
            @endif
            </select>



            @if($sort_type == 'brand')
            	<select id="brands" onchange="location = this.value;" style="width: 150px;margin-left: 20px">
            		@foreach( $sub->brands as $brand )
	              	@if($brand_id == $brand->id)
	              		<option value="{{ route('sortBy.brand' , ['sub_id'=>$sub->id , 'brand_id'=>$brand->id,'current_page'=>1]) }}" selected>{{ $brand->name }}</option>
	              	@else
	              		<option value="{{ route('sortBy.brand' , ['sub_id'=>$sub->id , 'brand_id'=>$brand->id,'current_page'=>1]) }}">{{ $brand->name }}</option>
	              	@endif
	              @endforeach
	            </select>
            @endif


            @if($sort_type != 'brand')
            	<select id="brands" onchange="location = this.value;" style="width: 150px;margin-left: 20px;display:none">
            		<option selected disabled>Select Brand</option>
            		@foreach( $sub->brands as $brand )
	              		<option value="{{ route('sortBy.brand' , ['sub_id'=>$sub->id , 'brand_id'=>$brand->id,'current_page'=>1]) }}">{{ $brand->name }}</option>
	              @endforeach
	            </select>
            @endif
		</div>
	</form>
	@endif
		
	@if($count == 0)
	<div class="span9">
		<h3>No Products</h3>
	</div>
	@endif  
	<br class="clr"/>



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
							  <h5 class="product-name" style="margin-bottom: 10px;"><a  href="{{ route('product.color' , ['product_id' => $product->id , 'color_id' =>$color->id]) }}">{{$product->name}}</a></h5>

							  <!-- Rating -->
							  <div style="margin-left:70px">
							  		<div id="productRating{{$product->id}}" class="pull-left"></div>
							  		<span id="ratingUsers{{$product->id}}"></span>
							  </div>

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
						   	<span class="discount" style="position:relative;top:-310px;left:-14px;opacity:0">
								0% off
							</span>
						   	<p class="before-discount" style="opacity:0">
									0 EGP
							</p>
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

	@if($count > 0)
		  <hr class="soft"/>

		@if($page->per_page < $page->totall_items)
		  <!-- Pagination -->
		  <div class="pagination" style="text-align: center;">
		  	<ul>
		  	<!-- sort in sub-category MainPage -->
		  	@if($sort_type == null)
		  		@if($page->previous)
			  		<li><a href="{{route('sub-category.show' , ['id'=>$sub->id , 'current_page'=>($page->current_page-1)])}}">Previous</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Previous</a></li>
			  	@endif

				  @for($i=1; $i <= $page->totall_pages ; $i++)
				  	@if($page->current_page == $i)
				  		<li class="active"><a class="page-link" href="#">{{ $i }}</a></li>
				  	@else
				  		<li><a class="page-link" href="{{route('sub-category.show' , ['id'=>$sub->id , 'current_page'=>$i])}}">{{ $i }}</a></li>
				  	@endif	
				  @endfor

			  	@if($page->next)
			  		<li><a href="{{route('sub-category.show' , ['id'=>$sub->id , 'current_page'=>($page->current_page+1)])}}">Next</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Next</a></li>
			  	@endif
			@endif


			<!-- sort in sub-category disc -->
		  	@if($sort_type == 'disc')
		  		@if($page->previous)
			  		<li><a href="{{route('sortBy.discount' , ['id'=>$sub->id , 'current_page'=>($page->current_page-1)])}}">Previous</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Previous</a></li>
			  	@endif

				  @for($i=1; $i <= $page->totall_pages ; $i++)
				  	@if($page->current_page == $i)
				  		<li class="active"><a class="page-link" href="#">{{ $i }}</a></li>
				  	@else
				  		<li><a class="page-link" href="{{route('sortBy.discount' , ['id'=>$sub->id , 'current_page'=>$i])}}">{{ $i }}</a></li>
				  	@endif	
				  @endfor

			  	@if($page->next)
			  		<li><a href="{{route('sortBy.discount' , ['id'=>$sub->id , 'current_page'=>($page->current_page+1)])}}">Next</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Next</a></li>
			  	@endif
			@endif


			<!-- sort in sub-category Brand -->
		  	@if($sort_type == 'brand')
		  		@if($page->previous)
			  		<li><a href="{{route('sortBy.brand' , ['id'=>$sub->id , 'brand_id'=>$brand_id ,'current_page'=>($page->current_page-1)])}}">Previous</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Previous</a></li>
			  	@endif

				  @for($i=1; $i <= $page->totall_pages ; $i++)
				  	@if($page->current_page == $i)
				  		<li class="active"><a class="page-link" href="#">{{ $i }}</a></li>
				  	@else
				  		<li><a class="page-link" href="{{route('sortBy.brand' , ['id'=>$sub->id , 'brand_id'=>$brand_id ,'current_page'=>$i])}}">{{ $i }}</a></li>
				  	@endif	
				  @endfor

			  	@if($page->next)
			  		<li><a href="{{route('sortBy.brand' , ['id'=>$sub->id , 'brand_id'=>$brand_id ,'current_page'=>($page->current_page+1)])}}">Next</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Next</a></li>
			  	@endif
			@endif

			<!-- sort in sub-category Lowest Price -->
		  	@if($sort_type == 'low')
		  		@if($page->previous)
			  		<li><a href="{{route('sortBy.priceLowestFirst' , ['id'=>$sub->id , 'current_page'=>($page->current_page-1)])}}">Previous</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Previous</a></li>
			  	@endif

				  @for($i=1; $i <= $page->totall_pages ; $i++)
				  	@if($page->current_page == $i)
				  		<li class="active"><a class="page-link" href="#">{{ $i }}</a></li>
				  	@else
				  		<li><a class="page-link" href="{{route('sortBy.priceLowestFirst' , ['id'=>$sub->id , 'current_page'=>$i])}}">{{ $i }}</a></li>
				  	@endif	
				  @endfor

			  	@if($page->next)
			  		<li><a href="{{route('sortBy.priceLowestFirst' , ['id'=>$sub->id , 'current_page'=>($page->current_page+1)])}}">Next</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Next</a></li>
			  	@endif
			@endif


			<!-- sort in sub-category Highest Price -->
			@if($sort_type == 'high')
		  		@if($page->previous)
			  		<li><a href="{{route('sortBy.priceHighestFirst' , ['id'=>$sub->id , 'current_page'=>($page->current_page-1)])}}">Previous</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Previous</a></li>
			  	@endif

				  @for($i=1; $i <= $page->totall_pages ; $i++)
				  	@if($page->current_page == $i)
				  		<li class="active"><a class="page-link" href="#">{{ $i }}</a></li>
				  	@else
				  		<li><a class="page-link" href="{{route('sortBy.priceHighestFirst' , ['id'=>$sub->id , 'current_page'=>$i])}}">{{ $i }}</a></li>
				  	@endif	
				  @endfor

			  	@if($page->next)
			  		<li><a href="{{route('sortBy.priceHighestFirst' , ['id'=>$sub->id , 'current_page'=>($page->current_page+1)])}}">Next</a></li>
			  	@else
			  		<li class="disabled"><a href="#">Next</a></li>
			  	@endif
			@endif

			</ul>
			</div>
		@endif

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


					// Rating 
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