@extends('layouts.admin')

@section('content')

	<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header col-lg-12" style="padding-left:0">
                             Orders

                            <a href="{{route('DeliveredPayments')}}" class="btn btn-info" style=" margin-left:25px">Delivered Oreders</a>
                            <a href="{{route('ProcessingPayments')}}" class="btn btn-primary">Processing Orders</a>
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
                    
                    <th>Order Num</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Totall Price</th>
                    <th>Discount</th>
                    <th>After Disc</th>
                    <th>Status</th>
                    <th>Deliver</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                @if($payments)
                    @foreach($payments as $payment)
                      <tr>
                        
                        <td>{{$payment->id}}</td>
                        <td>{{App\User::find($payment->user_id)->firstname . " " .App\User::find($payment->user_id)->lastname}}</td>
                        <td>{{$payment->created_at->diffForHumans()}}</td>
                        <td>{{$payment->totall_before_discount}}</td>
                        <td>{{$payment->totall_discount}}</td>
                        
                        <td>{{$payment->totall_price}}</td>
                        <td>{{$payment->is_delivered == 1 ? "Delivered" : "Processing"}}</td>
                        <td>
                        	@if($payment->is_delivered == 1)
                        		{{" ---------------"}}
                        	@else
                        		<a href="{{route('payments.deliver' , $payment->id) }}">Deliver now</a>
                        	@endif
                        </td>
                        <td><a href="{{route('orderDetails',$payment->id)}}">Details</a></td>
                      </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>



    <!-- Pagination -->
    <div class="pagination" style="margin-left: 450px">
    		@if($payments)
    		  {{$payments->render()}}
            @endif
    </div>


    


@stop
