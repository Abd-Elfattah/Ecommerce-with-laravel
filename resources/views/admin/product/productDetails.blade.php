@extends('layouts.admin')

@section('content')


	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header col-lg-12" style="padding-left:0">
                     {{$product->name}}

                     <a href="{{ route('product.create-color-1' , $product->id) }}" class="btn btn-primary" style=" margin-left:25px">Add new Color</a>
                     <!-- <a href="{{ route('product.create-color-1' , $product->id) }}" class="btn btn-primary" style=" margin-left:25px">Add new Discount</a> -->

                     {!! Form::open(['method'=>'DELETE' , 'action'=>['ProductController@destroy' , $product->id] , 'style'=>'float:right' ]) !!}                	
	                		{!! Form::submit('Delete Product' , ['class' => 'btn btn-danger pull-right']) !!}
	                {!! Form::close() !!}


                     @if($product->offer_price == 0)
	                     <div class="col-lg-5 pull-right">
	                     {!! Form::open(['method'=>'POST' , 'action'=>['ProductController@addDiscount',$product->id] ,'style'=>'width:200px']) !!}
	                     		
	                     		{!! Form::submit('Add Discount' , ['class' => 'btn btn-primary']) !!}
	                     		{!! Form::text('offer_price' , null , ['class'=>'form-control']) !!}
	                     		
	                     	
	                     {!! Form::close() !!}
	                     </div>
	                @else

	                	<a href="{{route('delete.discount' , $product->id)}}" class="btn btn-danger">Delete Discount</a>

	                @endif

	                
	                
                </h1>

                


                @if(Session::has('createUser'))
                    <ol class="breadcrumb" style="clear:both">
                        <li class="active">
                            <i class="fa fa-user"></i> 
                            <span class="text-success">{{ session('createUser') }}</span>
                        </li>
                    </ol>

                @endif



                @if(Session::has('deleteUser'))
                    <ol class="breadcrumb" style="clear:both">
                        <li class="active">
                            <i class="fa fa-user"></i> 
                            <span class="text-danger">{{ session('deleteUser') }}</span>
                        </li>
                    </ol>

                @endif
                
            </div>
    </div>

<div class="row">
    <div class="col-lg-6">
		<div class="tab-pane fade active in" id="home">
			<h4>Product Information</h4>
			<table class="table table-bordered">
			<tbody>


				<tr class="techSpecRow"><td class="techSpecTD1">Brand :</td><td class="techSpecTD2">{{$product->brand->subcategory->category->name}}</td></tr>

				<tr class="techSpecRow"><td class="techSpecTD1">Sub-Category :</td><td class="techSpecTD2">{{$product->brand->subcategory->name}}</td></tr>

				<tr class="techSpecRow"><td class="techSpecTD1">Brand :</td><td class="techSpecTD2">{{$product->brand->name}}</td></tr>

				<tr class="techSpecRow"><td class="techSpecTD1">Price(EGP) :</td><td class="techSpecTD2">{{$product->price}}</td></tr>

				<tr class="techSpecRow"><td class="techSpecTD1">Offer price :</td><td class="techSpecTD2">
					{{ $product->offer_price == 0 ? "No Offer Price" : $product->offer_price}}
				</td></tr>

				<tr class="techSpecRow"><td class="techSpecTD1">Colors :</td><td class="techSpecTD2">
			@foreach($product->colors as $color)
				{{$color->name}} 
			@endforeach
				</td></tr>

			@if($product->brand->subcategory->attr1 != null)
				<tr class="techSpecRow"><td class="techSpecTD1">{{$product->brand->subcategory->attr1}} :</td><td class="techSpecTD2">{{$product->val1}}</td></tr>
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
			<div class="row"></div>
			<h4 style="margin-top:40px">Product Description</h4>
			<p>{{ $product->description }}</p>

		</div>
	</div>


 <!-- Colors Sidebar -->

 <div class="col-lg-4 pull-right" style="margin-right: 120px">
		<div class="" id="home">
			<h4>Product Colors</h4>
			@foreach($product->colors as $color)
				<table class="table table-bordered">
				<tbody>
					<tr class="techSpecRow"><td class="techSpecTD1">Color :</td><td class="techSpecTD2">{{$color->name}}</td></tr>
					<tr class="techSpecRow"><td class="techSpecTD1">Quantity :</td><td class="techSpecTD2">{{$color->pivot->quantity}}</td></tr>
					<tr class="techSpecRow"><td class="techSpecTD1">Images :</td><td class="techSpecTD2"><a href="{{route('color.images' , [$product->id , $color->id] )}}">See All</a></td></tr>
					<tr class="techSpecRow"><td class="techSpecTD1">
					{!! Form::open(['method'=>'POST' , 'action'=>['ColorController@addQuantity' , $product->id , $color->id]]) !!}
							{!! Form::submit('Add Quantity' , ['class' => 'btn btn-primary']) !!} 
					</td><td class="techSpecTD2">
								{!! Form::text('quantity' , null , ['class'=>'form-control']) !!}
						{!! Form::close() !!}
					</td></tr>


					<tr class="techSpecRow"><td class="techSpecTD1">Delete</td><td class="techSpecTD2">
					{!! Form::open(['method'=>'DELETE' , 'action'=>['ColorController@deleteColor' , $product->id , $color->id]]) !!}
							{!! Form::submit('Delete Color' , ['class' => 'btn btn-danger']) !!} 
					{!! Form::close() !!}
					</td></tr>
				</tbody>
				</table>
			@endforeach
	</div>
</div>


</div>
<!-- End of row -->



@stop