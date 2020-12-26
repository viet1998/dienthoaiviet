<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceBlogController extends Controller
{
    public function showBlogService(){
    	return view('service');
    }
}
