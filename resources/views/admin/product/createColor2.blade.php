@extends('layouts.admin')

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
@stop



@section('content')


<h1 class="text-center">Create Product</h1>	
<h3 class="text-center">Add Photos</h3>
	

  {!! Form::open(['method'=>'POST' , 'action'=>['ColorController@storeColorImages' , $product->id , $color_id] , 'class'=>'dropzone' , 'files'=>true ]) !!}
  
	{!! Form::close() !!}

	<div class="text-center">
		<a class="btn btn-primary" href="{{ route('product.create-color-1' , $product->id) }}">Create Color</a>
	</div>

@stop


@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@stop