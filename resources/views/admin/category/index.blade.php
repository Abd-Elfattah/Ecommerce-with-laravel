@extends('layouts.admin')

@section('content')

    <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Categories

                        </h1>
                        
                    </div>
                </div>
    <!-- /.row -->


    <!-- row -->

        <!-- <div class="row"> -->
                    <div class="col-lg-4 col-lg-offset-1">

                        

                        <h2>Create Category</h2>

                            {!! Form::open(['method'=>'Post' , 'action'=>'CategoryController@store']) !!}

                                <div class="form-group">
                                    {!! Form::label('name','Name :') !!}
                                    {!! Form::text('name' , null , ['class'=>'form-control']) !!}
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::submit('Create Category' , ['class' => 'btn btn-primary']) !!}
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
                        
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($categories)
                        @foreach($categories as $category)
                          <tr> 
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td>{{$category->updated_at->diffForHumans()}}</td>
                            <td><a href="{{ route('category.edit' , $category->id) }}">Edit</a></td>
                            <td><a href="{{ route('category.delete' , $category->id) }}">Delete</a></td>
                          </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>


               


            </div>
        <!-- </div> -->
    <!-- row -->


@stop

