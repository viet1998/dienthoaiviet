<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginAdmin(){
    	return view('admin.login');
    }

    public function showindex(){
    	return view('admin.dashboard');
    }

    public function getAdminDashboard(){
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
        $bill_total=Bill::select('id',Bill::raw('sum(total) as tongtien'))->where('date_order','>=',$range)->where('date_order','<=',$to)->get();
        
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
