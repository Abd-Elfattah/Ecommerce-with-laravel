@extends('layouts.admin')

@section('content')


	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header col-lg-12" style="padding-left:0">
                     {{$product->name}}

                     <a href="{{ route('') }}" class="btn btn-primary" style=" margin-left:25px">Add new Color</a>
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
</div>


@stop