@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Sub-Categories


                            <a href="{{ route('sub.create') }}" class="btn btn-info" style=" margin-left:25px">Create Sub-category</a>
                        </h1>

                        


                        @if(Session::has('createSub'))
                            <ol class="breadcrumb" style="clear:both">
                                <li class="active">
                                    <i class="fa fa-user"></i> 
                                    <span class="text-success">{{ session('createSub') }}</span>
                                </li>
                            </ol>

                        @endif



                        @if(Session::has('deleteSub'))
                            <ol class="breadcrumb" style="clear:both">
                                <li class="active">
                                    <i class="fa fa-user"></i> 
                                    <span class="text-danger">{{ session('deleteSub') }}</span>
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
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brands</th>
                    <th>Attr 1</th>
                    <th>Attr 2</th>
                    <th>Attr 3</th>
                    <th>Attr 4</th>
                    <th>Attr 5</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                @if($subs)
                    @foreach($subs as $sub)
                      <tr>
                        
                        <td>{{ $sub->id }}</td>
                        <td>{{ $sub->name }}</td>
                        <td>{{ $sub->category->name }}</td>
                        <td><a href="{{ route('sub.brands' , $sub->id) }}">View</a></td>
                        <td>{{ $sub->attr1 ? $sub->attr1 : "Empty" }}</td>
                        <td>{{ $sub->attr2 ? $sub->attr2 : "Empty" }}</td>
                        <td>{{ $sub->attr3 ? $sub->attr3 : "Empty" }}</td>
                        <td>{{ $sub->attr4 ? $sub->attr4 : "Empty" }}</td>
                        <td>{{ $sub->attr5 ? $sub->attr5 : "Empty" }}</td>
                        
                        <td>{{$sub->created_at->diffForHumans()}}</td>
                        <td>{{$sub->updated_at->diffForHumans()}}</td>
                        <td><a href="{{ route('sub.edit' , $sub->id) }}">Edit</a></td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->

    @if($subs)
        <div class="row text-center">
            {{ $subs->render() }}
        </div>
    @endif


    


@stop
