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

class PageController extends Controller
{
    public function insertVisitor(Request $request)
    {
        $ip_user=$request->ip();
        $visitors=Visitor::where('ip_address',$ip_user)->get();
        if(count($visitors)<=0){
            $visitor=new Visitor;
            $visitor->ip_address=$ip_user;
            $visitor->date_visitor=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
    }

    public function getCompany($id){
        $products=Product::where('id_company',$id)->get();
        $company=Company::find($id);
        return compact('products','company');
    }
    
    //-------------------load các trang web-----------------
    public function showHomePage(Request $request){
        $this->insertVisitor($request);
        $slide = Slide::all();
        $new_product = Product::where('new',1) -> paginate(5);
        return view('trangchu', compact('slide', 'new_product'));
    }

    
    public function getProduct(Request $request,$id)
    {
        $this->insertVisitor($request);
        $product=Product::find($id);
        if(is_null($product)) return redirect()->route('trangchu');
        $product_variant=Product_variant::where('id_product',$id)->get();
        $sp_lienquan=Product::where('id_type',$product->id_type)->paginate(3);
        $new_product=Product::where('new',1)->paginate(4);
        $promo_product=Product::where('promotion_price','<>',0)->paginate(4);
        return view('show',compact('product','sp_lienquan','new_product','promo_product','product_variant'));
    }

    public function getSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        $products=Product::where('id_type',8)->get();
        $type_product=Type_product::find(8);
        return view('type-product',compact('products','type_product'));
    }

    public function getAppleSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(1));
    }
    public function getSamsungSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(2));
    }
    public function getOppoSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(3));
    }
    public function getXiaomiSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(4));
    }
    public function getVivoSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(5));
    }
    public function getRealmeSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(6));
    }
    public function getOneplusSmartphone(Request $request)
    {
        $this->insertVisitor($request);
        return view('company-product',$this->getCompany(7));
    }
    
    //----------------------------------------------------------------------------------
    //Ajax web product
    public function getBonusPrice($id)
    {
        $product_variant=Product_variant::find($id);
        $price=$product_variant->unit_price;
        $promotion_price=$price*(100-$product_variant->product->promotion_price)/100;
        if($product_variant->quantity<=0)
            echo number_format($promotion_price,0,'','.').'<u>đ</u> (-'.$product_variant->product->promotion_price.'%) <strike>'.number_format($price,0,'','.').'</strike><u>đ</u> <span style="color:red;">(Đã hết hàng)</span>';
        else
            echo number_format($promotion_price,0,'','.').'<u>đ</u> (-'.$product_variant->product->promotion_price.'%) <strike>'.number_format($price,0,'','.').'</strike><u>đ</u>';
    }
    // kiểm tra số lượng hàng trong kho
    public function getCheckOutOfStock($id)
    {
        $product_variant=Product_variant::find($id);
        if($product_variant->quantity<=0)
            echo '<button type="submit" style="color:white;background: #636362;" disabled="disabled">Mua ngay</button>';
        else 
            echo '<button type="submit" style="color:white;" >Mua ngay</button>';

    }

    //----------------------------------
    
    public function getSearch(Request $req){
        $products=Product::where('name','like','%'.$req->key.'%')->get();
        $key=$req->key;
        return view('smartphone-search',compact('products','key'));
    }
    public function getProfile(){
        
        return view('customer.profile');
    }
    //------------------------------------------------------

    // Phần xử lý đặt hàng và thanh toán

    public function getCheckout()
    {
        if(Auth::check())
        {
            $user=Auth::user();
            return view('checkout',compact('user'));
        }
        return view('checkout');
    }

    public function getReduceItemCart(Request $req,$id){
        $product_variant=Product_variant::find($id);
        $oldcart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->add($product_variant,$id,-1);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getIncreaseItemCart(Request $req,$id){
        $product_variant=Product_variant::find($id);
        $oldcart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->add($product_variant,$id,1);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getAddtoCart(Request $req)
    {
        $product_variant=Product_variant::find($req->id_product_variant);
        $oldcart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldcart);
        $cart->add($product_variant,$req->id_product_variant,1);
        $req->session()->put('cart',$cart);
        return redirect()->back();
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

    public function postCheckout(Request $req)              /*Đặt Hàng*/
    {
        if(Session::has('cart')){
            $cart=Session::get('cart');
            foreach($cart->items as $key => $value)
            {
                $product_variant=Product_variant::find($key);
                $product_variant->quantity-=$value['qty'];
                if($product_variant->quantity<0)
                {
                    $cart->removeItem($key);
                    if(count($cart->items)>0){
                        Session::put('cart',$cart);
                    }
                    else{
                        Session::forget('cart');
                    }
                    return redirect()->back()->with('thatbai','Sản phẩm '.$product_variant->product->name.' '.$product_variant->version.' '.$product_variant->color.' đã hết hàng');
                }
            }
            $customer=Customer::where('phone_number',$req->phone_number)->get();
            if($customer->count()==0){
                $customer=new Customer;
                $customer->name=$req->name;
                $customer->gender=$req->gender;
                $customer->email=$req->email;
                $customer->address=$req->address;
                $customer->phone_number=$req->phone_number;
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
            if(Auth::check())
            {
                $bill->id_user=Auth::user()->id;
            }
            $bill->save();

            foreach($cart->items as $key => $value)
            {
                $product_variant=Product_variant::find($key);
                $product_variant->quantity-=$value['qty'];
                $product_variant->save();
                $bill_detail=new Bill_detail;
                $bill_detail->id_bill=$bill->id;
                $bill_detail->id_product_variant=$key;
                $bill_detail->quantity=$value['qty'];
                $bill_detail->unit_price=$value['price'];
                $bill_detail->save();
            }
            Session::forget('cart');

            return redirect()->back()->with('thanhcong','Đặt hàng thành công sử dụng số điện thoại để kiểm tra');
        }
        return redirect()->back()->with('thatbai','Hãy chọn sản phẩm vào giỏ hàng');
    }

    public function getConfirmCheckOrder(Request $request)
    {
        
    }
    public function getCheckOrder(Request $request)
    {
        $customer=Customer::where('phone_number',$request->checkphone)->first();
        return view('check-phone',compact('customer'));

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
                'phone'=>'required|unique:users,phone',
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
                'phone.required'=>'Vui lòng nhập số điện thoại',
                'phone.unique'=>'Số điện thoại đã có người sử dụng',
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

    public function getCheckout1(){
        return view('checkout');
    }
    

}
