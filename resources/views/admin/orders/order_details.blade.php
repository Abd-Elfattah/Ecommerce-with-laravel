@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div style="margin-top:20px">
				<div>
					
					<h5>
						<p style="font-size: 16px;font-weight: bold">
							<span>Client Name :</span>
							{{App\User::find($payment->user_id)->firstname . " " . 
							App\User::find($payment->user_id)->lastname}}
						</p>
						<p style="font-weight: bold">
							<span>Shipping To : 
								<?php $address = App\Address::find($payment->address_id); ?>
								<span>{{$address->city}}</span>
								<span> ,{{$address->area}}</span>
								<p>Mobile : {{$address->mobile}}</p>
							</span>
						</p>
						<span>Date : {{$payment->created_at->toDayDateTimeString()}}</span> 
						<span style="margin-left: 15%">Status : 
							@if($payment->is_delivered == 0)
								{{ "Processing" }}<span style="margin-left: 8px;font-size: 18px;color:#a94442;"><i class="fa fa-times-circle-o"></i></span>
							@else
								{{ "Delivered" }}<span style="margin-left: 6px;font-size: 18px;color:#3c763d;"><i class="fa fa-check-circle-o"></i></span>
							@endif
						</span>
						<?php $address = App\Address::find($payment->address_id); ?>
						<p>Address: <span>{{$address->city . ", ".$address->area}}</span></p>
					</h5>
					
				</div>
				<table class="table table-bordered" style="width:90%;">
					<tbody>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Order Num</td>
							<td class="techSpecTD2">Number of Products</td>
							<td class="techSpecTD2">Totall-Price (EGP)</td>
							<td class="techSpecTD2">totall-Discount (EGP)</td>
							<td class="techSpecTD2">After-Discount (EGP)</td>
						</tr>
						<tr>
							<td class="techSpecTD1">{{ $payment->id }}</td>
							<td class="techSpecTD1">{{ $payment->orders->count() }}</td>
							<td class="techSpecTD1">{{ $payment->totall_before_discount }}</td>
							<td class="techSpecTD1">{{ $payment->totall_discount }}</td>
							<td class="techSpecTD1">{{ $payment->totall_price }}</td>
						</tr>
						
					</tbody>
				</table>
				<p style="font-weight: bold;margin-bottom: 0px">More Details :</p>
				<table class="table table-bordered" style="width:90%">
					<tbody>
						<tr class="techSpecRow">
							<td class="techSpecTD1">Product</td>
							<td class="techSpecTD2">Color</td>
							<td class="techSpecTD2">Quantity</td>
							<td class="techSpecTD2">Before-discount (EGP)</td>
							<td class="techSpecTD2">Discount (EGP)</td>
							<td class="techSpecTD2">Price (EGP)</td>
						</tr>
						@foreach($payment->orders as $order)
						<?php $product = App\Product::findOrFail($order->product_id);  ?>
						<?php $color = App\Color::findOrFail($order->color_id) ;?>

						<tr class="techSpecRow">
							<td class="techSpecTD1">{{ $product->name }}</td>
							<td class="techSpecTD2">{{ $color->name }}</td>
							<td class="techSpecTD2">{{ $order->quantity }}</td>
							<td class="techSpecTD2">
								@if($order->quantity == 1)
									{{ $order->price_before_discount }}
								@else
									{{ $order->price_before_discount*$order->quantity . 
										" (" . $order->price_before_discount . " For 1)" }}
								@endif
							</td>
							<td class="techSpecTD2">
								@if($order->quantity == 1)
									{{ $order->discount }}
								@else
									@if($order->discount != 0)
										{{ $order->discount*$order->quantity . 
											" (" . $order->discount . " For 1)" }}
									@elseif($order->discount == 0)
										{{ $order->discount }}
									@endif
								@endif
							</td>
							<td class="techSpecTD2">
								@if($order->quantity == 1)
									{{ $order->price }}
								@else
									{{ $order->price*$order->quantity . 
										" (" . $order->price . " For 1)" }}
								@endif
							</td>
							
						</tr>

						@endforeach

						

						
					</tbody>
				</table>
			</div>
		</div>

        </div>
    </div>



@stop
