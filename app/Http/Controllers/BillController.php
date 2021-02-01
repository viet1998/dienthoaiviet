<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Bill;
use App\Models\Bill_detail;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\History_change;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills=Bill::orderBy('created_at','DESC')->paginate(10);
        return view('admin.bill.bill_admin',compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.quanly.themdonhang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill=Bill::find($id);
        return view('page.quanly.chitietdonhang',compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill=Bill::find($id);
        return view('admin.bill.edit_bill',compact('bill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'status'=>'required'
            ],
            [
                'status.required'=>'Hãy chọn tình trạng đơn hàng'
            ]);
        $bill=Bill::find($id);
        $bill->status=$request->status;
        $bill->last_modified_by_user=Auth::user()->id;
        $bill->update();
        $this->saveHistory("Update",$id);
        return redirect()->back()->with('thanhcong','Đơn hàng đã được chuyển trạng thái');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDelItemCart($id)
    {
        $oldcart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        
        return redirect()->back();
    }

    public function getAddtoCart(Request $req,$id,$qty)
    {
        $product=Product::find($id);
        $oldcart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        if(isset($req->unit))
            $cart->add($product,$id,$req->unit);
        else
            $cart->add($product,$id,$qty);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    
    public function postCheckout(Request $req)              /*Đặt Hàng*/
    {
        if(Session::has('cart')){
        $cart=Session::get('cart');
        $customer=Customer::where('phone_number',$req->phone)->get();
        if($customer->count()==0){
            $customer=new Customer;
            $customer->name=$req->name;
            $customer->gender=$req->gender;
            $customer->email=$req->email;
            $customer->address=$req->address;
            $customer->phone_number=$req->phone;
            $customer->note=$req->note;
            $customer->save();
            $id=$customer->id;
        }
        else
        {
            foreach ($customer as $value) {
                $id=$value->id;
            }
        }
        
        $bill=new Bill;
        $bill->id_customer=$id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment;
        $bill->note=$req->note;
        $bill->save();

        foreach($cart->items as $key => $value)
        {
            $bill_detail=new Bill_detail;
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price'];
            $bill_detail->save();
        }
        Session::forget('cart');

        return redirect()->back()->with('thanhcong','Đặt hàng thành công');
        }
        return redirect()->back()->with('thatbai','Hãy chọn sản phẩm vào giỏ hàng');
    }

    public function getSortBill($id)
    {
        
        switch ($id) {
            case 1:
                $bills=Bill::where('status',2)->orderBy('date_order','DESC')->get();
                break;

            case 2:
                $bills=Bill::where('status',0)->orderBy('date_order','DESC')->get();
                break;

            case 3:
                $bills=Bill::where('status',1)->orderBy('date_order','DESC')->get();
                break;

            case 4:
                $bills=Bill::orderBy('total','DESC')->get();
                break;

            case 5:
                $bills=Bill::orderBy('total','ASC')->get();
                break;


            
            default:
                # code...
                break;
        }
        foreach($bills as $key => $bill)
        { $this->showBillToHtml($bill,0); } 
         // return $bills;
        // return view('page.quanly.timkiemsanpham',compact('bills','request')); onclick="return  confirm('Có xóa '+<?php $bill['name']+' không?');"
    }

    public function getSearchBill($searchname)
    {
        $bills=Bill::join('customer', 'customer.id', '=', 'bills.id_customer')
        ->select('bills.id','bills.id_customer','bills.id_user','bills.date_order','bills.total','bills.payment','bills.status','bills.note','bills.last_modified_by_user','bills.created_at','bills.updated_at')
        ->where('customer.name','like','%'.$searchname.'%')
        ->orWhere('customer.phone_number','=',$searchname)
        ->orWhere('bills.id','=',$searchname)
        ->orWhere('bills.id_user','=',$searchname)
        ->orWhere('bills.date_order','=',$searchname)
        ->orWhere('bills.last_modified_by_user','=',$searchname)
        ->orderBy('date_order','DESC')->get();
        if($searchname=='null')
            $bills=Bill::orderBy('date_order','DESC')->get();
        foreach($bills as $key => $bill)
        { $this->showBillToHtml($bill,0); } 
    }
    public function showBillToHtml($bill,$id){
        ?>
        <tr style="text-align: center">
        <td><?php echo $bill['id'] ?></a></td>
        <td><?php echo $bill['customer']['name'] ?></a></td>
        <td><?php echo $bill['customer']['phone_number'] ?></td>
        <td><?php echo $bill['id_user'] ?></td>
        <td><?php echo $bill['date_order'] ?></td>
        <td><?php echo number_format($bill['total'],0,'','.') ?> VNĐ</td>
        <td><?php echo $bill['payment'] ?></a></td>
        <td><?php echo $bill['note'] ?></a></td>
        <td><?php echo $bill['last_modified_by_user'].' - '.$bill['user_modified']['full_name'] ?></a></td>
        <?php if($bill['status']==0) { ?>
        <td><div style="color:#6A6A6A;background-color: #FBF405;text-align: center;border-radius: 10px;padding: 3px"><b>Chưa Giao Hàng</b></div></td>
        <?php } else {if ($bill['status']==2){ ?>
        <td ><div style="color:#6A6A6A;background-color: #48FB05;text-align: center;border-radius: 10px;padding: 3px"><b>Đã Giao Hàng</b></div></td>
        <?php } else {if ($bill['status']==1) { ?>
        <td ><div style="color:#6A6A6A;background-color: red;text-align: center;border-radius: 10px;padding: 3px"><b>Đã Hủy</b></div></td> 
        <?php }}} ?>
        <td><?php echo $bill['updated_at'] ?></td>
        <td>
            <a href="<?php echo route('bill.edit',$bill['id']); ?>" class="btn btn-primary">Chi Tiết</a>
        </td>
        </tr>
        <?php
     }
     public function saveHistory($method,$id){
        $history= new History_change;
        $history->table_change="Bill";
        $history->id_item=$id;
        $history->id_user=Auth::user()->id;
        $history->method=$method;
        $history->date_change=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $history->save();
     }
}
