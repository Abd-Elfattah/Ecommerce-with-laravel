@extends('layouts.home')
@section('styles')
	<style type="text/css">
		.discount{
			padding: 4px 14px;
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
			<div id="gallery" class="span3">
            <a href="{{ asset($product->photos->first()->path) }}" title="{{$product->name}}">
				<img src="{{ asset($product->photos->first()->path) }}" style="width:100%" alt="Fujifilm FinePix S2950 Digital Camera"/>
            </a>


			@if(count($product->photos)>1)
				<div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">

                @if( count($product->photos) <= 4 )
                	
                  <div class="item active">
                  @foreach($product->photos()->where('id', '>' , $product->photos->first()->id)->get() as $photo)
                   <a href="{{ asset($photo->path) }}"> <img style="width:30px;height:50px" src="{{ asset($photo->path) }}" alt=""/></a>
                   @endforeach
                  </div>
                  	

                @endif
                  <!-- <div class="item">
                   <a href="themes/images/products/large/f3.jpg" > <img style="width:29%" src="themes/images/products/large/f3.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f1.jpg"> <img style="width:29%" src="themes/images/products/large/f1.jpg" alt=""/></a>
                   <a href="themes/images/products/large/f2.jpg"> <img style="width:29%" src="themes/images/products/large/f2.jpg" alt=""/></a>
                  </div>
                </div> -->
              <!--  
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  -->
              </div>
			@endif


	</div>		  
				 
</div>
			<div class="span6">
				<h3>{{$product->name}} 
				@if( !$product->offer_price == 0)
				<span class="discount pull-right">
					{{ floor(100 - ($product->offer_price/$product->price)*100 ) }}% off
				</span>
				@endif
				</h3>
				<!-- <small>- (14MP, 18x Optical Zoom) 3-inch LCD</small> -->
				<hr class="soft"/>
				
				  <div style="margin-bottom:30px">
					<label class="control-label" style="width:300px">
						@if($product->offer_price == 0)
							<span class="price">{{ $product->price }} EGP</span>
							
						@else
							<span class="price" style="font-size:19px;font-weight:bold">{{ $product->offer_price }} EGP</span>
							<span class="before-discount" style="margin-left:15px">{{ $product->price }} EGP</span>
						@endif
					</label>


					<div class="controls">
						<input type="hidden" class="product-id" value="{{ $product->id }}">



						@if(Auth::check())	
							@if(Session::has('cart_id'))
								@if(in_array($product->id , Session::get('cart_id')) == 1 )
								   <button class="btn btn-large btn-primary pull-right product-cart"> Remove From <i class=" icon-shopping-cart"></i></button> 

								@endif 

								@if(in_array($product->id , Session::get('cart_id')) == 0 )
							   		<button class="btn btn-large pull-right product-cart"> Add to cart <i class=" icon-shopping-cart"></i></button> 
								@endif

						   	@endif

							@if(!Session::has('cart_id'))

								   		<button class="btn btn-large pull-right product-cart"> Add to cart <i class=" icon-shopping-cart"></i></button>
							@endif


						@else
							<a href="{{ url('/login') }}" class="btn btn-large pull-right product-except"> Add to cart <i class=" icon-shopping-cart"></i></a>
							</a>

						@endif


					  
					</div>



				  </div>
				
				
				<hr class="soft"/>


				<h4>{{$product->colors->first()->pivot->quantity}} items in stock</h4>
			
				  <div style="margin-top:6px">
					<h4>Color : {{ $product->colors()->first()->name }}</h4>
				  </div>
			
				<hr class="soft clr"/>
				
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			
			<div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
              <!-- <li><a href="#profile" data-toggle="tab">Related Products</a></li> -->
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{$product->brand->name}}</td></tr>

				@if($product->brand->subcategory->attr1 != null)
				<tr class="techSpecRow"><td class="techSpecTD1">{{$product->brand->subcategory->attr1}} :</td><td class="techSpecTD2" style="width:70%">{{$product->val1}}</td></tr>
			@endif

			@if($product->brand->subcategory->attr2 != null)
				<tr class="techSpecRow"><td class="techSpecTD1">{{$product->brand->subcategory->attr2}} :</td><td class="techSpecTD2">{{$product->val2}}</td></tr>
			@endif

			@if($product->brand->subcategory->attr3 != null)
				<tr class="techSpecRow"><td class="techSpecTD1">{{$product->brand->subcategory->attr3}} :</td><td class="techSpecTD2">{{$product->val3}}</td></tr>
			@endif


			@if($product->brand->subcategory->attr4 != '')
				<tr class="techSpecRow"><td class="techSpecTD1">{{$product->brand->subcategory->attr4}} :</td><td class="techSpecTD2">{{$product->val4}}</td></tr>
			@endif

			@if($product->brand->subcategory->attr5 != '')
				<tr class="techSpecRow"><td class="techSpecTD1">{{$product->brand->subcategory->attr5}} :</td><td class="techSpecTD2">{{$product->val5}}</td></tr>
			@endif
				
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
		
		<script type="text/javascript">
	
				

				$(document).ready(function(){
				
					$('.product-cart').click(function(){

						var product_id = $(this).parent().find('.product-id').val();

						if($(this).hasClass('btn-primary')){
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

							$(this).removeClass('btn-primary').html('Add To Cart <i class="icon-shopping-cart"></i>');





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


							$(this).addClass('btn-primary').html('Remove From <i class="icon-shopping-cart"></i>');
							
						}

						
					});
			});


		</script>

	
@stop