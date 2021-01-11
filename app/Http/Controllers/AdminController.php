<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Customer;
use App\Models\News;
use App\Models\Type_product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Company;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function showLoginAdmin(){
    	return view('admin.login');
    }

    public function showindex(){
    	return view('admin.dashboard');
    }

    public function getStatistical(){
        $bills_dagiao=Bill::where('status','Đã Giao Hàng')->get();
        $bills_chuagiao=Bill::where('status','Chưa Giao Hàng')->get();
        $bills_huy=Bill::where('status','Hủy')->get();
        $bills=Bill::all();
        $chart_bill=[($bills_dagiao->count()*100)/$bills->count(),($bills_chuagiao->count()*100)/$bills->count(),($bills_huy->count()*100)/$bills->count()];
        return view('admin.dashboard',compact('chart_bill'));
    }

    public function getDataStatistical(Request $req){

        $days = $req->input('days');
        $range = Carbon::now()->subDays($days);
        $to = Carbon::now();
        $bill_total=Bill::select('date_order',Bill::raw('sum(total) as tongtien'))->where('date_order','>=',$range)->where('date_order','<=',$to)->groupBy('date_order')->get();
        echo $bill_total;
    }
    public function getSumTotalForDay(Request $req){

        $days = $req->input('days');
        $range = Carbon::now()->subDays($days);
        $to = Carbon::now();
        $bill_total=Bill::select(Bill::raw('sum(total) as tongtien'))->where('date_order','>=',$range)->where('date_order','<=',$to)->get();
        
        foreach ($bill_total as $key => $value) {
            # code...
        
        ?>
        : <?php echo number_format($value->tongtien); ?> VNĐ
        <?php
        }
    }
    public function getAdminDashboard(){
        return view('admin.dashboard');
    }
}
