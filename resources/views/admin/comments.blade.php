@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Comments Section

                        </h1>

                        
                        
                    </div>
                </div>
    <!-- /.row -->



    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                  <tr>
                    
                    
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Rating</th>
                    <th>Product</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody>
                @if($ratings)
                    @foreach($ratings as $rating)
                      <tr>
                        <td>{{App\User::find($rating->user_id)->firstname}}</td>
                        <td>{{App\User::find($rating->user_id)->lastname}}</td>
                        <td>{{$rating->rating_stars}} stars</td>
                        <td><a href="{{route('Eco-home.product',$rating->product->id)}}">
                            {{$rating->product->name}}
                        </a></td>
                        <td>{{$rating->created_at->diffForHumans()}}</td>
                        
                      </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->
        
    <div class="row text-center">
        {{$ratings->render()}}
    </div>


    


@stop
