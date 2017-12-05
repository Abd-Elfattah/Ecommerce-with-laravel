@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Users

                            <a href="{{ route('users.adminstrators') }}" class="btn btn-info" style=" margin-left:25px">Adminstrators</a>
                            <a href="{{ route('users.clients') }}" class="btn btn-primary">Clients</a>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                @if($users)
                    @foreach($users as $user)
                      <tr>
                        
                        <td>{{$user->id}}</td>
                        <td>{{$user->firstname}}</td>
                        <td>{{$user->lastname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->is_admin == 1 ? "Adminstrator" : "Client"}}</td>
                        
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td><a href="{{ route('admin.users.edit' , $user->id) }}">Edit</a></td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->
        
    <div class="row text-center">
        {{$users->render()}}
    </div>


    


@stop
