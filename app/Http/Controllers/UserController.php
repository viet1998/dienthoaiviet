<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLogin(){
    	return view('user.login');
    }
  	public function showSigup(){
    	return view('user.sigup');
    }
     
    public function showProfileUser(){
    	return view('user.profile');
    }  
}
