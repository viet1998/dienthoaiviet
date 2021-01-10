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

class PageController extends Controller
{
    public function getIndex()
    {
    	$slides=Slide::all();
    	$new_product=Product::where('new',1)->paginate(4);
    	$khuyenmai=Product::where('promotion_price','<>',0)->get();
    	$loai_sanpham=Type_product::all();
        return view('page.trangchu',compact('slides','new_product','khuyenmai','loai_sanpham'));
    }
    public function getProduct($id)
    {
        $product=Product::find($id);
        $sp_lienquan=Product::where('id_type',$product->id_type)->paginate(3);
        $new_product=Product::where('new',1)->paginate(4);
        $promo_product=Product::where('promotion_price','<>',0)->paginate(4);
        return view('page.sanpham',compact('product','sp_lienquan','new_product','promo_product'));
    }
    public function getContact()
    {
        return view('page.lienhe');
    }
    public function getAbout()
    {
        return view('page.gioithieu');
    }
    
    public function getSmartphone()
    {
        $products=Product::where('id_type',8)->get();
        $type_product=Type_product::find(8);
        return view('type-product',compact('products','type_product'));
    }

    

    public function getAppleSmartphone()
    {
        $products=Product::where('id_company',1)->get();
        $company=Company::find(1);
        return view('company-product',compact('products','company'));
    }
    public function getSamsungSmartphone()
    {
        $products=Product::where('id_company',2)->get();
        $company=Company::find(2);
        return view('company-product',compact('products','company'));
    }
    public function getOppoSmartphone()
    {
        $products=Product::where('id_company',3)->get();
        $company=Company::find(3);
        return view('company-product',compact('products','company'));
    }
    public function getXiaomiSmartphone()
    {
        $products=Product::where('id_company',4)->get();
        $company=Company::find(4);
        return view('company-product',compact('products','company'));
    }
    public function getVivoSmartphone()
    {
        $products=Product::where('id_company',5)->get();
        $company=Company::find(5);
        return view('company-product',compact('products','company'));
    }
    public function getOneplusSmartphone()
    {
        $products=Product::where('id_company',7)->get();
        $company=Company::find(7);
        return view('company-product',compact('products','company'));
    }
    public function getRealmeSmartphone()
    {
        $products=Product::where('id_company',6)->get();
        $company=Company::find(6);
        return view('company-product',compact('products','company'));
    }

    public function getCheckout()
    {
        if(Auth::check())
        {
            $user=Auth::user();
            return view('page.dathang',compact('user'));
        }
        return view('page.dathang');
    }

    public function get404()
    {
        return view('page.404');
    }
    public function getLogin()
    {
        return view('page.dangnhap');
    }
    
    public function getShoppingcart()
    {
        return view('page.giohang');
    }
    public function getManager()
    {
        return view('page.quanly.quanly');
    }
    public function getSearch(Request $req){
        $product=Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->paginate(8);
        return view('page.search',compact('product'));
    }
    public function getTest(){
        
        return view('page.admin.index');
    }
    public function getSignup(){
        
        return view('page.dangky');
    }
    public function getStatistical(){
        $bills_dagiao=Bill::where('status','Đã Giao Hàng')->get();
        $bills_chuagiao=Bill::where('status','Chưa Giao Hàng')->get();
        $bills_huy=Bill::where('status','Hủy')->get();
        $bills=Bill::all();
        $chart_bill=[($bills_dagiao->count()*100)/$bills->count(),($bills_chuagiao->count()*100)/$bills->count(),($bills_huy->count()*100)/$bills->count()];
        return view('page.quanly.bangthongke',compact('chart_bill'));
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

    // Phần đăng nhập

    public function postLogin(Request $req)                             
    {
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'                
            ],
            [
                'email.required'=>'Vui lòng nhập Email',
                'email.email'=>'Không dúng định dạng Email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu nhiều nhất 20 ký tự'
            ]);
        $credentials= array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials))
        {
            return redirect()->back()->with(['thongbao'=>'Đăng nhập thành công','flag'=>'success']);
        }else
        {
            return redirect()->back()->with(['thongbao'=>'Đăng nhập không thành công','flag'=>'danger']);
        }
    }

    public function postLogout(){
        Auth::logout();
        return redirect('dang-nhap');
    }

    
    
    public function postSignup(Request $request){
        $this->validate($request,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'full_name'=>'required',
                're_password'=>'required|same:password',
            ],
            [
                'email.required'=>'Vui lòng nhập Email',
                'email.email'=>'Không dúng định dạng Email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.required'=>'Vui lòng nhập lại mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu nhiều nhất 20 ký tự',
                'full_name.required'=>'Vui lòng nhập họ tên'
            ]);
        $user=new User();
        $user->full_name=$request->full_name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }
    
}
