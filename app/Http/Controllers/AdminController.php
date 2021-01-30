<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Product_variant;
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
use DateTime;


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
        $bills_dagiao=Bill::where('status',2)->get();
        $bills_chuagiao=Bill::where('status',0)->get();
        $bills_huy=Bill::where('status',1)->get();
        $bills=Bill::all();
        $chart_bill=[($bills_dagiao->count()*100)/$bills->count(),($bills_chuagiao->count()*100)/$bills->count(),($bills_huy->count()*100)/$bills->count()];
        return $chart_bill;
    }

    public function getDataStatistical(Request $req){

        $days = $req->input('days');
        $range = Carbon::now('Asia/Ho_Chi_Minh')->subDays($days)->toDateString();
        $to = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        // $bill_total=Bill::select('date_order',Bill::raw('sum(total) as tongtien'))->where('date_order','>=',$range)->where('date_order','<=',$to)->groupBy('date_order')->get();
        $month=Carbon::now('Asia/Ho_Chi_Minh')->month;
        switch($days){
                case 30: {
                    $range = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
                    break;
                } 
                case 90: {
                    switch ($month) {
                        case 1:
                        case 2:
                        case 3:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,01,01)->toDateString();
                                break;
                            }
                            
                        case 4:
                        case 5:
                        case 6:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,04,01)->toDateString();
                                break;
                            }
                        case 7:
                        case 8:
                        case 9:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,07,01)->toDateString();
                                break;
                            }
                        case 10:
                        case 11:    
                        case 12:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,10,01)->toDateString();
                                break;
                            }
                            
                        
                        default:
                            # code...
                            break;
                    }
                    break;
                } 
                case 365: {
                    $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,01,01)->toDateString();
                    break;
                } 
                case 400: {
                    $range = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->subMonth()->toDateString();
                    $to=Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->subMonth()->toDateString();
                    break;
                } 
                case 401: {
                    $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->subYear()->year,01,01)->toDateString();
                    $to= Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->subYear()->year,12,31)->toDateString();
                    break;
                } 
                default: break;
        }
        $begin = new DateTime($range);
        $end   = new DateTime($to);
        $bills=null;
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $day=$i->format('Y-m-d');
            $bill=Bill::select('date_order',Bill::raw('sum(total) as tongtien'))->where('date_order','=',$day)->groupBy('date_order')->first();
            if($i==$end) {
                if($bill!=null){
                    $bills[$day]='{"date_order":"'.$day.'","tongtien":'.$bill->tongtien.'}';
                }
                else
                    $bills[$day]='{"date_order":"'.$day.'","tongtien":0}';
            }
            else {
                if($bill!=null){
                    $bills[$day]='{"date_order":"'.$day.'","tongtien":'.$bill->tongtien.'},';
                }else{
                    $bills[$day]='{"date_order":"'.$day.'","tongtien":0},';
                }
            }
        }
        echo '[';
        foreach($bills as $bill)
        {
            echo $bill;
        }
        echo ']';
        // echo '<br>'.$bill_total;
    }
    public function getSumTotalForDay(Request $req){

        $days = $req->input('days');
        $range = Carbon::now('Asia/Ho_Chi_Minh')->subDays($days)->toDateString();
        $to = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $month=Carbon::now('Asia/Ho_Chi_Minh')->month;
        switch($days){
                case 30: {
                    $range = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
                    break;
                } 
                case 90: {
                    switch ($month) {
                        case 1:
                        case 2:
                        case 3:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,01,01)->toDateString();
                                break;
                            }
                            
                        case 4:
                        case 5:
                        case 6:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,04,01)->toDateString();
                                break;
                            }
                        case 7:
                        case 8:
                        case 9:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,07,01)->toDateString();
                                break;
                            }
                        case 10:
                        case 11:    
                        case 12:
                            {
                                $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,10,01)->toDateString();
                                break;
                            }
                            
                        
                        default:
                            # code...
                            break;
                    }
                    break;
                } 
                case 365: {
                    $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,01,01)->toDateString();
                    break;
                } 
                case 400: {
                    $range = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->subMonth()->toDateString();
                    $to=Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->subMonth()->toDateString();
                    break;
                } 
                case 401: {
                    $range = Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->subYear()->year,01,01)->toDateString();
                    $to= Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->subYear()->year,12,31)->toDateString();
                    break;
                } 
                default: break;
        }
        $bill_total=Bill::select(Bill::raw('sum(total) as tongtien'))->where('date_order','>=',$range)->where('date_order','<=',$to)->get();
        
        foreach ($bill_total as $key => $value) {
        ?>
        : <?php echo number_format($value->tongtien,0,'','.'); ?> VNĐ
        <?php
        }
    }
    public function getAdminDashboard(){
        $endLastMonth=Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->subMonth()->toDateString();
        $startLastMonth=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->subMonth()->toDateString();
        $startThisMonth=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $toDay=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $startOfThisYear=Carbon::createFromDate(Carbon::now('Asia/Ho_Chi_Minh')->year,01,01)->toDateString();
        $visitor_count=[count(Visitor::where('date_visitor',Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->get()),
            count(Visitor::where('date_visitor','>=',$startLastMonth)->where('date_visitor','<=',$endLastMonth)->get()),
            count(Visitor::where('date_visitor','>=',$startThisMonth)->where('date_visitor','<=',$toDay)->get()),
            count(Visitor::where('date_visitor','>=',$startOfThisYear)->where('date_visitor','<=',$toDay)->get()),
            count(Visitor::all())
        ];
        $product=Product_variant::Join('products','products.id','=','product_variants.id_product')
        ->Join('bill_detail','bill_detail.id_product_variant','=','product_variants.id')
        ->select('product_variants.id','products.id_company',Bill_detail::raw('sum(bill_detail.quantity) as product_count'))
        ->groupBy('bill_detail.id_product_variant')
        ->where('products.id_company',1)
        ->get();
        $brand_data=[0,0,0,0,0,0,0,0];
        $products=Product_variant::all();
        foreach ($products as $key => $product) {
            switch($product->product->id_company){
                case 1: $brand_data[1]=$product->bill_detail->sum('quantity'); break;
                case 2: $brand_data[2]=$product->bill_detail->sum('quantity'); break;
                case 3: $brand_data[3]=$product->bill_detail->sum('quantity'); break;
                case 4: $brand_data[4]=$product->bill_detail->sum('quantity'); break;
                case 5: $brand_data[5]=$product->bill_detail->sum('quantity'); break;
                case 6: $brand_data[6]=$product->bill_detail->sum('quantity'); break;
                case 7: $brand_data[7]=$product->bill_detail->sum('quantity'); break;
                default: break;
            }
        }
        $total =array_sum($brand_data);
        // $brand_data=
        $chart_bill=$this->getStatistical();
        $bills=Bill::orderBy('date_order','DESC')->take(5)->get();
        $products=$product_variants=Product_variant::Join('bill_detail', 'product_variants.id', '=', 'bill_detail.id_product_variant')
                ->select('product_variants.id','id_product','color','version','id_image','product_variants.unit_price','product_variants.quantity','last_modified_by_user','product_variants.created_at','product_variants.updated_at',Bill_detail::raw('sum(bill_detail.quantity) as product_count'))
                ->groupBy('bill_detail.id_product_variant')
                ->orderByDesc('product_count')
                ->take(5)->get();

        $customers=Customer::join('bills','customer.id','=','bills.id_customer')
            ->select('customer.id','name','email','gender','address','phone_number','customer.note',Bill::raw('count(bills.id_customer) as bills_count'),Bill::raw('sum(bills.total) as totalpaid'))
            ->groupBy('bills.id_customer')
            ->orderBy('bills_count','DESC')
            ->take(5)
            ->get();
        return view('admin.dashboard',compact('visitor_count','brand_data','total','chart_bill','bills','products','customers'));
    }


}
