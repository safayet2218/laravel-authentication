<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\User;
use Hash;
use Illuminate\Support\facades\Redirect;

class PasswordController extends Controller
{
    
    public function index(){
    	return view('auth.passwords.passwordchange');
    }
    public function password_update(Request $request){

    	$password=Auth::user()->password;
    	$oldpass=$request->oldpass;

    	if(Hash::check($oldpass,$password)){
    		$user=User::find(Auth::id());
    		$user->password=Hash::make($request->password);
    		$user->save();
    		Auth::logout();
    		return Redirect()->route('login')->with('successMsg','Successfully passord change now log in');

    	}
    	else{
    		return Redirect()->back()->with('ErrorMsg','old Password dosenot mathc!');
    	}

    }
}
