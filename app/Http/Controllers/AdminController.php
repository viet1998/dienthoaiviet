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
use App\Models\Visitor;
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
        $endLastMonth=Carbon::now()->endOfMonth()->subMonth()->toDateString();
        $startLastMonth=Carbon::now()->startOfMonth()->subMonth()->toDateString();
        return $endLastMonth+$startLastMonth;
     //    $visitor=[count(Visitor::where('date_visitor',Carbon::now('Asia/Ho_Chi_Minh')->toDateString())),
     //        count(Visitor::where('date_visitor','>=',Carbon::now('Asia/Ho_Chi_Minh')->toDateString()))
     //    ];
    	// return view('admin.dashboard');
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
        ?>
        : <?php echo number_format($value->tongtien); ?> VNĐ
        <?php
        }
    }
    public function getAdminDashboard(){
        $endLastMonth=Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->subMonth()->toDateString();
        $startLastMonth=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->subMonth()->toDateString();
        $startThisMonth=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $toDay=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startOfThisYear=Carbon::createFromDate(2021,01,01)->toDateString();
        $visitor_count=[count(Visitor::where('date_visitor',Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->get()),
            count(Visitor::where('date_visitor','>=',$startLastMonth)->where('date_visitor','<=',$endLastMonth)->get()),
            count(Visitor::where('date_visitor','>=',$startThisMonth)->where('date_visitor','<=',$toDay)->get()),
            count(Visitor::where('date_visitor','>=',$startOfThisYear)->where('date_visitor','<=',$toDay)->get()),
            count(Visitor::all())
        ];

        // $brand_data=
        return view('admin.dashboard',compact('visitor_count'));
    }
}
