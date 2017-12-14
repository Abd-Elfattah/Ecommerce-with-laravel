@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Products

                            <a href="{{ route('products.create') }}" class="btn btn-primary" style=" margin-left:25px">Create Product</a>
                            
                        </h1>

                        


                        @if(Session::has('createUser'))
                            <ol class="breadcrumb" style="clear:both">
                                <li class="active">
                                    <i class="fa fa-user"></i> 
                                    <span class="text-success">{{ session('createUser') }}</span>
                                </li>
                            </ol>

                        @endif



                        @if(Session::has('deleteUser'))
                            <ol class="breadcrumb" style="clear:both">
                                <li class="active">
                                    <i class="fa fa-user"></i> 
                                    <span class="text-danger">{{ session('deleteUser') }}</span>
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
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sub-category</th>
                    <th>Brand</th>
                    <th>Price (EGP)</th>
                    <th>Offer Price</th>
                    <th>More</th>
                  </tr>
                </thead>
                <tbody>
                @if($products)
                    @foreach($products as $product)
                      <tr>
                        
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->brand->subcategory->category->name}}</td>
                        <td>{{$product->brand->subcategory->name}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->price}}</td>
                        
                        <td>{{$product->offer_price == 0 ? "No Offer" : $product->offer_price}}</td>
                        <td><a href="{!! url('admin/product/details', $product->id) !!}">Details</a></td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->
        
    <div class="row text-center">
        @if($products)
            {{$products->render()}}
        @endif
    </div>


    


@stop
