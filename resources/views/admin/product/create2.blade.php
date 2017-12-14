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
            {!! Form::open(['method'=>'POST' , 'action'=>['ProductController@secondStore',$product->id]]) !!}

                <div class="form-group" style="width:60%">
                    {!! Form::label('color_id','Color :') !!}
                    {!! Form::select('color_id' , $colors , null , ['class'=>'form-control']) !!}
                </div>


                <div class="form-group" style="width:60%">
                    {!! Form::label('quantity','Quantity :') !!}
                    {!! Form::text('quantity' , null , ['class'=>'form-control']) !!}
                </div>
                
                @if($sub->attr1 != null)
                    <div class="form-group" style="width:60%">
                        <label for="val1">{{$sub->attr1}}</label>
                        {!! Form::text('val1' , null , ['class'=>'form-control']) !!}
                    </div>
                @endif

                @if($sub->attr2 != null)
                    <div class="form-group" style="width:60%">
                        <label for="val2">{{$sub->attr2}}</label>
                        {!! Form::text('val2' , null , ['class'=>'form-control']) !!}
                    </div>
                @endif

                @if($sub->attr3 != null)
                    <div class="form-group" style="width:60%">
                        <label for="val3">{{$sub->attr3}}</label>
                        {!! Form::text('val3' , null , ['class'=>'form-control']) !!}
                    </div>
                @endif

                @if($sub->attr4 != null)
                    <div class="form-group" style="width:60%">
                        <label for="val4">{{$sub->attr4}}</label>
                        {!! Form::text('val4' , null , ['class'=>'form-control']) !!}
                    </div>
                @endif


                @if($sub->attr5 != null)
                    <div class="form-group">
                        <label for="val5">{{$sub->attr5}}</label>
                        {!! Form::text('val5' , null , ['class'=>'form-control']) !!}
                    </div>
                @endif

                
                <div class="form-group">
                    {!! Form::submit('Continue' , ['class' => 'btn btn-primary']) !!}
                    <span class="pull-right">2/3</span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>





@stop


