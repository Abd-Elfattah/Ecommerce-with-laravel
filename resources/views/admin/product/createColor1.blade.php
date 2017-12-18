@extends('layouts.admin')

@section('content')

    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             {{$product->name . " Colors" }}

                        </h1>
                        
                    </div>
                </div>
    <!-- /.row -->


    <!-- row -->

        <!-- <div class="row"> -->
                    <div class="col-lg-4 col-lg-offset-1">

                        

                        <h2>Create Color</h2>

                            {!! Form::open(['method'=>'POST' , 'action'=>['ColorController@storeColor' , $product->id ]]) !!}

                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <select id="color" name="color_id" class="form-control">
                                        
                                            @foreach($colors as $color)
                                                
                                        
                                                    <option value="{{$color->id}}">{{$color->name}}</option>
                                                
                                            @endforeach
                                       
                                    </select>
                                </div>


                                <div class="form-group">
                                    {!! Form::label('quantity','Quantity') !!}
                                    {!! Form::text('quantity' , null , ['class'=>'form-control']) !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::submit('Create Color' , ['class' => 'btn btn-primary']) !!}
                                </div>
                            {!! Form::close() !!}

                    </div>
        <!-- </div> -->

    <!-- row -->




    <!-- row -->
        <!-- <div class="row"> -->
            <div class="col-lg-6 col-lg-offset-1" style="margin-top:85px; border-left:1px solid #DDDDDD; padding-left:40px">

                @if(Session::has('deleteCategory'))
                    <ol class="breadcrumb" style="clear:both">
                        <li class="active">
                            <i class="fa fa-user"></i> 
                            <span class="text-danger">{{ session('deleteCategory') }}</span>
                        </li>
                    </ol>

                @endif


                @if(Session::has('createCategory'))
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-user"></i> 
                                <span class="text-success">{{ session('createCategory') }}</span>
                            </li>
                        </ol>

                @endif


                @if(Session::has('editCategory'))
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-user"></i> 
                                <span class="text-success">{{ session('editCategory') }}</span>
                            </li>
                        </ol>

                @endif


                <table class="table">
                    <thead>
                      <tr>
                        
                        
                        <th>Color</th>
                        <th>Quantiy</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($product->colors)
                        @foreach($product->colors as $color)
                          <tr> 
                            <td>{{$color->name}}</td>
                            <td>{{$color->pivot->quantity}}</td>
                            <td>{{$color->pivot->created_at->diffForHumans()}}</td>
                            <td>{{$color->pivot->updated_at->diffForHumans()}}</td>
                            <td><a href="">Edit</a></td>
                            <td><a href="">Delete</a></td>
                          </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>


               


            </div>
        <!-- </div> -->
    <!-- row -->


@stop

