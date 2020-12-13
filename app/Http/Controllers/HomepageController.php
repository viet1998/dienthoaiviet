<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;

class HomepageController extends Controller
{
    public function showHomePage(){
    	$slide = Slide::all();
    	$new_product = Product::where('new',1) -> paginate(5);
    	return view('trangchu', compact('slide', 'new_product'));
    }
}
