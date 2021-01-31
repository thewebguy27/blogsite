<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateprofileRequest;
use App\User;
class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users',User::all());
    }
    public function makeadmin(User $user){
        $user->role='admin';
        $user->save();
        session()->flash('success','User has been made admin');
        return redirect(route('users.index'));

    }
    public function edit(){
        return view('users.edit')->with('user',auth()->user());
    }
    public function update(Updateprofilerequest $request){
        $user=auth()->user;
        $user->update([
            'name'=>$request->name,
            'about'=>$request->about
        ]);
        session()->flash('success','User updated successfully');
        return redirect()->back();
    }
}
