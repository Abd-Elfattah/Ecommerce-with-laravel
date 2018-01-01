@extends('layouts.admin')

@section('content')

    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-6 col-lg-offset-3" style="padding-left:0">
                            Create Product
                            
                        </h1>
                        


                    </div>
                </div>
    <!-- /.row -->


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            {!! Form::open(['method'=>'POST' , 'action'=>['ProductController@secondStore',$product->id,$sub->id]]) !!}

                <div class="form-group" style="width:60%">
                    {!! Form::label('color_id','Color :') !!}
                    {!! Form::select('color_id' , $colors , null , ['class'=>'form-control']) !!}
                </div>


                <div class="form-group" style="width:60%">
                    {!! Form::label('quantity','Quantity :') !!}
                    {!! Form::text('quantity' , null , ['class'=>'form-control']) !!}
                </div>
                
                <?php $i=1; ?>
                @foreach($sub->options as $option)
                    <div class="form-group" style="width:60%">
                       <label for="value{{$i}}">{{$option->name}}</label>
                       <input type="text" name="value{{$i}}" id="value{{$i}}" class="form-control">
                    </div>
                <?php $i++; ?>
                @endforeach
                


                
                <div class="form-group">
                    {!! Form::submit('Continue' , ['class' => 'btn btn-primary']) !!}
                    <span class="pull-right">2/3</span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>





@stop


