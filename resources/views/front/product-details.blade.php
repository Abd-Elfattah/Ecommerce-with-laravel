@extends('layouts.home')
@section('styles')
	<style type="text/css">
		.discount{
			padding: 10px 14px;
			opacity:0.95;
		}

		.product-cart, .product-except{
			margin-top:-35px;
		}

		.btn-grey{
		    background-color:#D8D8D8;
			color:#FFF;
		}
		.rating-block{
			background-color:#FAFAFA;
			border:1px solid #EFEFEF;
			padding:15px 15px 20px 15px;
			border-radius:3px;
		}
		.bold{
			font-weight:700;
		}
		.padding-bottom-7{
			padding-bottom:7px;
		}

		.review-block{
			background-color:#FAFAFA;
			border:1px solid #EFEFEF;
			padding:15px;
			border-radius:3px;
			margin-bottom:15px;
		}
		.review-block-name{
			font-size:12px;
			margin:10px 0;
		}
		.review-block-date{
			font-size:12px;
		}
		.review-block-rate{
			font-size:13px;
			margin-bottom:15px;
		}
		.review-block-title{
			font-size:15px;
			font-weight:700;
			margin-bottom:10px;
		}
		.review-block-description{
			font-size:13px;
		}

		.break-rating p{
			margin-bottom: 3px;
		}
		textarea{
			resize:none;
		}
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	


@stop

@section('content')


	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="{{route('homePage')}}">Home</a> <span class="divider">/</span></li>
    <li><a href="{{route('sub-category.show' , ['id'=>$product->brand->subcategory->id,'current_page'=>1])}}">{{$product->brand->subcategory->name}}</a> <span class="divider">/</span></li>
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
              <li><a href="#profile" data-toggle="tab">Reviews</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered" style="width: 60%">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1" style="font-weight: bold">Brand </td><td class="techSpecTD2">{{$product->brand->name}}</td></tr>

				@foreach($product->values as $value)
					<tr class="techSpecRow"><td class="techSpecTD1" style="font-weight: bold">{{$value->option->name}} </td><td class="techSpecTD2">{{$value->name}}</td></tr>
				@endforeach

				
				
				</tbody>
				</table>
				
				<h5>Description</h5>
				<p>
				{{$product->description}}
				</p>


              </div>

              <div class="tab-pane fade" id="profile">
				<div id="myTab">

		<!-- Rating -->
		
		<div class="row" id="beforeComment" style="margin-left: 0px">
			<div class="col-sm-3">
				<div class="rating-block pull-left" style="width: 200px;text-align: center">
					<h4>Average user rating</h4>
					<?php 
						$ratings = $product->ratings;
						$count=0;
						foreach ($ratings as $rating) {
						 	$count +=$rating->rating_stars;
						 } 
					?>
					<h2 class="bold padding-bottom-7" id="putRate">
						<span id="all_rating">
						@if($count != 0)
							{{number_format($count/count($ratings),1)}}
						@elseif($count == 0)
							0
						@endif
						</span> 
						<small>/ 5</small></h2>
					<div id="rateYo" style="margin-left: 35px"></div>
				</div>
				<div style="margin-left: 280px;padding-top: 10px">
					<p style="font-size: 18px;font-weight: bold">Rating Breakdown 
						@if(Auth::user())
							@if($count = Auth::user()->rating()->where('product_id',$product->id)->count() == 0)
								<button class="pull-right btn btn-primary" id="makeRate">Make Review</button>
							@endif
						@endif
						@if(! Auth::user())
							<a href="{{route('login')}}" class="pull-right btn btn-primary">Make Review</a>
						@endif
					</p>
					<div class="break-rating">
						<div id="rateYo1" class="pull-left" style="margin-right:15px"></div>
						<p><span id="star5">({{App\Rating::where(['rating_stars'=>5,'product_id'=>$product->id])->count()}})</span> <span><i class="fa fa-user"></i></span></p>
					</div>
					<div class="break-rating"> 
						<div id="rateYo2" class="pull-left" style="margin-right:15px"></div>
						<p><span id="star4">({{App\Rating::where(['rating_stars'=>4,'product_id'=>$product->id])->count()}})</span> <span><i class="fa fa-user"></i></span></p>
					</div>
					<div class="break-rating">
						<div id="rateYo3" class="pull-left" style="margin-right:15px"></div>
						<p><span id="star3">({{App\Rating::where(['rating_stars'=>3,'product_id'=>$product->id])->count()}})</span> <span><i class="fa fa-user"></i></span></p>
					</div>
					<div class="break-rating">
						<div id="rateYo4" class="pull-left" style="margin-right:15px"></div>
						<p><span id="star2">({{App\Rating::where(['rating_stars'=>2,'product_id'=>$product->id])->count()}})</span> <span><i class="fa fa-user"></i></span></p>
					</div>
					<div class="break-rating">
						<div id="rateYo5" class="pull-left" style="margin-right:15px"></div>
						<p><span id="star1">({{App\Rating::where(['rating_stars'=>1,'product_id'=>$product->id])->count()}})</span> <span><i class="fa fa-user"></i></span></p>
					</div>
					

				</div>

			</div>
					
		</div>	
		

		<!-- Make Comment -->
		<div id="ratingForm" class="form-group" style="display:none">
			<hr/>
			<div id="rateStars" style="margin-bottom: 10px"></div>
			<textarea id="comment" class="formcontrol" placeholder="Leave your comment here ..."
			rows="3" style="width:600px"></textarea><br>
			<button class="btn btn-primary" id="submit" >Submit review</button>

			<span id="error"></span>
			<span id="errorComment"></span><span id="errorRate"></span>
		</div>

		<!-- Make Comment -->

		<hr/>

		<?php 
			if(Auth::check()){
				$user_id = Auth::user()->id;
				$user_rating = $product->ratings()->where('user_id',$user_id)->first();
				if($user_rating){
					$ratings = $product->ratings()->where('user_id','!=',Auth::user()->id)->orderBy('id','DESC')->get();
				}else{
					$ratings = $product->ratings()->orderBy('id','DESC')->get();
					$user_rating = 0;
				}
			}else{
					$ratings = $product->ratings()->orderBy('id','DESC')->get();
					$user_rating = 0;
			}
		?>
		
		@if(Auth::check() && $user_rating)
		<div class="row">
			<div class="col-sm-7" style="margin-left: 0px">
				
				<div class="review-block">
					<div class="row" style="margin-left: 40px">
						<div class="col-sm-3 pull-left" style="margin-right: 30px;width: 100px">
							<div class="review-block-name" style="margin-bottom: 7px;font-size: 15px;font-weight: bold">{{App\User::find($user_rating->user_id)->firstname. " " .App\User::find($user_rating->user_id)->lastname}}</div>
							<div class="review-block-date">
							<span style="font-size: 14px">
								{{$user_rating->created_at->toFormattedDateString()}}
								</span>
							<br/>
							{{$user_rating->created_at->diffForHumans()}}</div>
						</div>
						<div class="col-sm-9" style="margin-top: 10px;">

							<div id="userRating<?php echo $user_rating->id; ?>" style="margin-left: 125px;margin-bottom: 15px"></div>
							<div class="review-block-description">
							<p style="padding-right: 50px;font-size: 16px">
								{{$user_rating->comment}}
							</p>
							</div>
						</div>
					</div>
					
				</div></div>
			</div>
			<hr/>
		@endif

		


		<!-- users -->
			<?php $count=1; ?>
					@if($ratings->count() >0)
					
					<div class="row">
						<div class="col-sm-7" style="margin-left: 0px">
					<div class="review-block">
					@foreach($ratings as $rating)
					
					<div class="row" style="margin-left: 40px">
						<div class="col-sm-3 pull-left" style="margin-right: 30px;width: 100px">
							<div class="review-block-name" style="margin-bottom: 7px;font-size: 15px;font-weight: bold">
								{{App\User::find($rating->user_id)->firstname." ".App\User::find($rating->user_id)->lastname}}
							</div>
							<div class="review-block-date" >
								<span style="font-size: 14px">
								{{$rating->created_at->toFormattedDateString()}}
								</span>
								<br/>
								{{$rating->created_at->diffForHumans()}}
							</div>
							
						</div>
						<div class="col-sm-9" style="margin-top: 10px;">

							<div id="userRating<?php echo $rating->id ?>" style="margin-left: 125px;margin-bottom: 15px"></div>
							<div class="review-block-description">
							<p style="padding-right: 50px;font-size: 16px">
								{{$rating->comment}}
							</p>
							</div>
						</div>
					</div>
					
						@if( count($ratings) > $count )
							<hr style="margin-left: 30px" />
						@endif
						<?php $count++; ?>
					@endforeach
					</div>

				</div>
				</div>
				@endif

			
	</div>
		<!-- Rating -->
		
		<br class="clr"/>
		<!-- <hr class="soft"/> -->
				
		
			</div>
		
		</div>
	</div>

</div>

@stop
		


@section('scripts')
	
		<script type="text/javascript">
				$(document).ready(function(){

					// ------ Slider ------------------

						$('.slider').bxSlider();

					// ------ Slider ------------------
					$('#makeRate').click(function(){
						$('#ratingForm').removeAttr('style');
					});

					var url = "{{route('productRatings')}}";
					$.ajax(url,{
						type:'GET',
						data:{id:"{{$product->id}}"},
						success:function(ratings){
							if(ratings.length > 0){
								var allRatings  = 0;
								var length = ratings.length;
								$.each(ratings , function(index,rating){
									allRatings += rating.rating_stars; 
									var userRating = "#userRating"+rating.id;
									$(userRating).rateYo({
										rating:rating.rating_stars,
									    starWidth:"15px",
									    spacing:"3px",
									    readOnly:true

									});
								});
								allRatings = allRatings/length;
								$("#rateYo").rateYo({
								    rating:allRatings,
								    starWidth:"18px",
								    spacing:"5px",
								    readOnly:true
								});
							}else{
								$("#rateYo").rateYo({
								    rating:0,
								    starWidth:"18px",
								    spacing:"5px",
								    readOnly:true
								});
							}
						}
					});


		      		
	     	 		$("#rateYo1").rateYo({
					    rating: 5,
					    starWidth:"15px",
					    spacing:"5px",
					    readOnly:true
					});
					$("#rateYo2").rateYo({
					    rating: 4,
					    starWidth:"15px",
					    spacing:"5px",
					    readOnly:true
					});
					$("#rateYo3").rateYo({
					    rating: 3,
					    starWidth:"15px",
					    spacing:"5px",
					    readOnly:true
					});
					$("#rateYo4").rateYo({
					    rating: 2,
					    starWidth:"15px",
					    spacing:"5px",
					    readOnly:true
					});
					$("#rateYo5").rateYo({
					    rating: 1,
					    starWidth:"15px",
					    spacing:"5px",
					    readOnly:true
					    
					    
					});

					

					

					$('#rateStars').rateYo({
						normalFill: "#A0A0A0",
					    starWidth:"25px",
					    spacing:"3px"
					    
					});


					// user insert rating
					$("#rateStars").rateYo("option", "onChange", function () {
						var onChange = $(this).rateYo("option", "onChange");
						var stars = $(this).rateYo("option", "rating");
						$(this).rateYo("option", "rating", next(stars));
					}); 
					
					function next(x){
						return Math.ceil(x);
					}

					$('#submit').click(function(){
						var stars = $('#rateStars').rateYo("option", "rating");
						var comment = $('#comment').val();


						if(stars == 0 && comment == ''){
							$('#errorRate').empty();
							$('#errorComment').empty();
							$('#error').text('Enter your Comment And Rating First please .. ');
							
						}else if(stars == 0 || comment == ''){
							$('#error').empty();
							if(stars == 0){
								$('#errorRate').text('Select Stars Please');
							}else{
								$('#errorRate').empty();
							}
							
							if(comment == ''){
								$('#errorComment').text('Type Comment');
							}else{
								$('#errorComment').empty();
							}
						}else if(stars != 0 && comment != ''){
							$('#errorRate').empty();
							$('#errorComment').empty();
							$('#error').empty();

							var product_id = "{{ $product->id }}";
							<?php if(Auth::user()){ ?>
								var user_id = "{{ Illuminate\Support\Facades\Auth::user()->id }}";
							<?php } ?>
							var url = "{{route('make.rating')}}";
							
							$.ajax(url,{
								type:'GET',
								data:{
									user_id:user_id,
									product_id:product_id,
									rating_stars:stars,
									comment:comment
								},
								success:function(data){
									var html = data[0];
									var rating = data[1];
									$('#ratingForm').remove();
									$('#beforeComment').after(html);
									$('#newRating').rateYo({
										rating:rating.rating_stars,
									    starWidth:"15px",
									    spacing:"3px",
									    readOnly:true
									});

									$('#makeRate').remove();
									// Update Old
									var update = data[2];
									var new_rating = update[0]/update[1];
									$('#all_rating').text(new_rating.toFixed(1));
									var html = '<div id="rateYo" style="margin-left: 35px"></div>';
									$("#rateYo").remove();
									$('#putRate').after(html);
									$("#rateYo").rateYo({
									    rating:new_rating,
									    starWidth:"18px",
									    spacing:"5px",
									    readOnly:true
									});
									var users_count = update[2];
									$('#star'+rating.rating_stars).text("("+users_count+")")

									// console.log(data);

								}
							});
						}

						
						
					});

					

					
				});


		</script>
  		<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

	
@stop