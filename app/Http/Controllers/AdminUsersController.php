<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUsersRequest;
use Illuminate\Support\Facades\Session;

use App\User;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(8);
        return view('admin.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        if($input['is_admin']){
            $user->is_admin = 1;
            $user->save();
        }

        if($user){
            Session::flash('createUser' , 'The User has been Created Successfully');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
        }

        

        $user = User::findOrFail($id);

        $user->update($input);


        //bug
        if($input['is_admin']== '1'){
            $user->is_admin = 1;
            $user->save();
        }else{
            $user->is_admin = 0;
            $user->save();
        }

        if($user){
            Session::flash('editUser' , 'The User Has been updated');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if( $user->delete() ){
            Session::flash('deleteUser' , 'The User Has been Deleted');
        }


        return redirect()->route('admin.users.index');
    }


    public function adminstrators(){
        $users = User::whereIsAdmin(1)->paginate(5);

        return view('admin.users.index' , compact('users'));
    }

    public function clients(){
        $users = User::whereIsAdmin(0)->paginate(5);

        return view('admin.users.index' , compact('users'));
    }


    
}
