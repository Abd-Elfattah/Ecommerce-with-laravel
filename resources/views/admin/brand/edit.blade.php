@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-6 col-lg-offset-3" style="padding-left:0">
                            Edit Brand
                            
                        </h1>


                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                @if(Session::has('editBrand'))
                                    <ol class="breadcrumb">
                                        <li class="active">
                                            <i class="fa fa-user"></i> 
                                            <span class="text-success text-center">{{ session('editBrand') }}</span>
                                        </li>
                                    </ol>

                                @endif
                            </div>
                        </div>
                        


                    </div>
                </div>
    <!-- /.row -->


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            {!! Form::model($brand , ['method'=>'PATCH' , 'action'=>['BrandController@update', $brand->id] ]) !!}


                <div class="form-group category">
                    <label for="category_id">Category</label>

                    <select id="category_id" class="form-control cat">
                        

                       
                            @foreach($categories as $cat)
                                @if($brand->subcategory->category->id == $cat->id)
                                    <option value="{{$cat->id}}" selected>{{ $cat->name }}</option>

                                @else
                                    <option value="{{$cat->id}}">{{ $cat->name }}</option>
                                @endif

                            @endforeach
                       
                    </select>


                </div>

                <div class="form-group">
                    <label for="subcategory_id">Sub-Category</label>
                    <select name="subcategory_id" id="subcategory_id" class="form-control subCat">
                        @foreach($subs as $sub)
                            @if($brand->subcategory->id == $sub->id)
                                <option value="{{$sub->id}}" selected>{{ $sub->name }}</option>

                            @else
                                <option value="{{$sub->id}}">{{ $sub->name }}</option>
                            @endif

                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    {!! Form::label('name','Brand :') !!}
                    {!! Form::text('name' , null , ['class'=>'form-control']) !!}
                </div>

                

                
                <div class="form-group">
                    {!! Form::submit('Edit Brand' , ['class' => 'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>





@stop


@section('scripts')
        <script type="text/javascript">

                // Multi select with ajax


                
                $(document).ready(function(){

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

                            },
                            error:function(){

                            }
                        });                        

                    });

                });

        </script>
@stop