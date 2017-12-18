@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                       		{{$product->name . " - " . $color->name . " color"}}

                            <a href="{{route('color.add.images' , [$product->id , $color->id])}}" class="btn btn-primary" style="margin-left:40px">Add Images</a>
                        </h1>
                        
                    </div>
                </div>
    <!-- /.row -->



    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                  <tr>
                    
                    <th>Photo</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Delete</th>                    
                  </tr>
                </thead>
                <tbody>
                	@if($photos)
	                    @foreach($photos as $photo)
	                      <tr>
	                        
	                        <td><img width="70px" src="{{asset($photo->path)}}"></td>
	                        <td>{{$product->name}}</td>
	                        <td>{{$color->name}}</td>
	                        <td><a href="{{route('color.images.delete' , $photo->id)}}">Delete</a></td>
	                      </tr>
	                    @endforeach
	                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->
        
    <div class="row text-center">
        
    </div>


    


@stop
