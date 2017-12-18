@extends('layouts.admin')

@section('styles')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
@stop



@section('content')


<h1 class="text-center">Add Images For {{ " " . $color->name . " "}} Color</h1>	
<h3 class="text-center">Add Photos</h3>
	

  {!! Form::open(['method'=>'POST' , 'action'=>['ColorController@storeNewColorImages' , $product->id , $color->id] , 'class'=>'dropzone' , 'files'=>true ]) !!}
  
	{!! Form::close() !!}

	<div class="text-center">
		<a class="btn btn-primary" href="{{ route('color.images' , [$product->id , $color->id]) }}">Add Images</a>
	</div>

@stop


@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@stop