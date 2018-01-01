<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment;
use App\Order;

class PaymentController extends Controller
{
    public function index(){
    	$payments = Payment::orderBy('id','DESC')->paginate(10);
    	return view('admin.orders.index' , compact('payments'));
    }
    public function showDelivered(){
    	$payments = Payment::where('is_delivered',1)->orderBy('id','DESC')->paginate(10);
    	return view('admin.orders.index' , compact('payments'));
    }

    public function showProcessing(){
    	$payments = Payment::where('is_delivered',0)->orderBy('id','DESC')->paginate(10);
    	return view('admin.orders.index' , compact('payments'));
    }

    public function orderDetails($id){
    	$payment = Payment::findOrFail($id);
    	return view('admin.orders.order_details',compact('payment'));
    }

    public function deliver($id){
    	$payment = Payment::findOrFail($id);
    	$payment->update(['is_delivered'=>1]);
    	return redirect()->back();
    }
}
