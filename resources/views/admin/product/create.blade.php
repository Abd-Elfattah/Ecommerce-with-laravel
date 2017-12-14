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
            {!! Form::open(['method'=>'POST' , 'action'=>'ProductController@store']) !!}


                <div class="form-group category">
                    <label for="category_id">Category</label>

                    <select id="category_id" class="form-control cat">
                        <option selected disabled>Choose Category</option>

                        @if($categories)
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{ $cat->name }}</option>
                            @endforeach
                        @endif
                    </select>


                </div>

                <div class="form-group">
                    <label for="subcategory_id">Sub-Category</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control subCat">
                        <option selected disabled>Select Sub-Category</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control brand">
                        <option selected disabled>Select Brand</option>
                    </select>
                </div>


                <div class="form-group">
                    {!! Form::label('name','Product Name :') !!}
                    {!! Form::text('name' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group" style="width:50%">
                    {!! Form::label('price','Price (EGP) :') !!}
                    {!! Form::text('price' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group" style="width:50%">
                    {!! Form::label('offer_price','Offer Price : (not required)') !!}
                    {!! Form::text('offer_price' , null , ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description','Description') !!}
                    {!! Form::textarea('description' , null , ['class'=>'form-control', 'rows'=>5]) !!}
                </div>

                

                
                <div class="form-group">
                    {!! Form::submit('Continue' , ['class' => 'btn btn-primary']) !!}
                    <span class="pull-right">1/3</span>
                </div>
            {!! Form::close() !!}
        </div>
    </div>





@stop





@section('scripts')
        <script type="text/javascript">

                // Multi select with ajax


                
                $(document).ready(function(){


                    // Selet Sub-Category Dynamic by Ajax
                    $('.cat').on('change',function(){

                        var cat_id = $(this).val();

                        option = " ";
                        var div = $(this).parent().parent();

                        $.ajax({
                            type:'get',
                            url:'{!!URL::to('ajaxSub')!!}',
                            data:{'id':cat_id},
                            success:function(data){
                                for(var i=0; i<data.length;i++){
                                    option+= '<option value="'+data[i].id+'">'+data[i].name+'</option>';

                                    div.find('.subCat').html(" ");
                                    div.find('.subCat').append(option);
                                }

                                div.find('.subCat').change();


                            },
                            error:function(){

                            }
                        });                        
                    });




                    //Selet Brand Dynamic by Ajax
                    $('.subCat').on('change',function(){
                        var sub_id = $(this).val();
                        var option = " ";

                        var parent = $(this).parent().parent();

                        $.ajax({
                            type:'get',
                            url:'{!!URL::to('ajaxBrand')!!}',
                            data:{'id':sub_id},
                            success:function(data){

                                for(var i=0;i<data.length;i++){
                                    option+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                                }


                                parent.find('.brand').html(" ");
                                parent.find('.brand').append(option);

                            },
                            error:function(){

                            }
                        });
                    });

                });

        </script>
@stop