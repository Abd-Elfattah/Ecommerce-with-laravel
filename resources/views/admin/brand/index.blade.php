@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Brands
                        
                            <a href="{{ route('brand.create') }}" class="btn btn-info" style=" margin-left:25px">Create Brand</a>

                        
                        </h1>

                        


                        @if(Session::has('createBrand'))
                            <ol class="breadcrumb" style="clear:both">
                                <li class="active">
                                    <i class="fa fa-user"></i> 
                                    <span class="text-success">{{ session('createBrand') }}</span>
                                </li>
                            </ol>

                        @endif



                        @if(Session::has('deleteBrand'))
                            <ol class="breadcrumb" style="clear:both">
                                <li class="active">
                                    <i class="fa fa-user"></i> 
                                    <span class="text-danger">{{ session('deleteBrand') }}</span>
                                </li>
                            </ol>

                        @endif
                        
                    </div>
                </div>
    <!-- /.row -->



    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                  <tr>
                    
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Sub-Category</th>                
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Delete</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                @if($brands)
                    @foreach($brands as $brand)
                      <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->subcategory->category->name }}</td>
                        <td>{{ $brand->subcategory->name }}</td>
                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                        <td>{{ $brand->updated_at->diffForHumans() }}</td>
                        <td><a href="{{ url('admin/brands' , $brand->id) }}">Delete</a></td>
                        <td><a href="{{ route('brand.edit' , $brand->id) }}">Edit</a></td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->

    @if($brands)
        <div class="row text-center">
            {{ $brands->render() }}
        </div>
    @endif


    


@stop
