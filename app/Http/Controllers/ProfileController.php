<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payment;
class ProfileController extends Controller
{
    

    // User Profile
    public function userAddress($id){
        $user = User::findOrFail($id);

        return view('front.addresses' , compact('user'));
    }


    public function createAddress($id){
    	$user = User::find($id);
    	return view('front.createAddress' , compact('user'));
    }

    public function storeAddress(Request $request , $id)
    {
    	$this->validate($request , [
    		'city' => 'string|required|min:4',
    		'area' => 'required', 
    		'location_type' => 'required', 
    		// 'mobile' => 'required|unique:addresses|Numeric' 
            'mobile' => 'unique:addresses|required|regex:/(01)[0-9]{9}/'
    	]);

    	$user = User::findOrFail($id);
    	$input = $request->all();
    	$address = $user->addresses()->create($input);

    	return redirect()->route('user.address' , $id);
    }

    public function showOrders($id){
        $user = User::findOrFail($id);
        $payments = Payment::where('user_id' , $user->id)->orderBy('id','DESC')->paginate(2);
        return view('front.orders' , compact('user','payments'));
    }
}
