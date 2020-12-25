<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessoriesproductController extends Controller
{
	public function showAccessories(){
		return view('accessories');
	}    
}
