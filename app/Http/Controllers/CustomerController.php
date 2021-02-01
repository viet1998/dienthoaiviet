<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bill;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::paginate(10);
        return view('admin.customer.customer_admin',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.themkhachhang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'gender'=>'required',
                'email'=>'required|email',
                'address'=>'required',
                'phone_number'=>'required|unique:customer,phone_number'
            ],
            [
                'name.required'=>'Nhập tên',
                'gender.required'=>'Nhập giới tính',
                'email.required'=>'Nhập email',
                'address.required'=>'Nhập địa chỉ',
                'phone_number.required'=>'Nhập số điện thoại',
                'email.email'=>'Email không đúng định dạng',
                'phone_number.unique'=>'Số điện thoại đã có trong danh sách khách hàng'
            ]);
        $customer=new Customer;
        $customer->name=$request->name;
        $customer->gender=$request->gender;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->phone_number=$request->phone_number;
        $customer->save();
        return redirect()->back()->with('thanhcong','Thêm khách hàng mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer=Customer::find($id);
        return view('admin.customer.edit_customer',compact('customer'));
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
                'name'=>'required',
                'gender'=>'required',
                'address'=>'required',
            ],
            [
                'name.required'=>'Nhập tên',
                'gender.required'=>'Nhập giới tính',
                'address.required'=>'Nhập địa chỉ',
                
            ]);
        $customer=Customer::find($id);
        $customer->name=$request->name;
        $customer->gender=$request->gender;
        $customer->address=$request->address;
        $customer->last_modified_by_user=Auth::user()->id;
        $customer->note=$request->note;
        $customer->update();
        return redirect()->back()->with('thanhcong','Sửa thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=customer::where('id',$id)->get();
        if($customer->count()>0)
            return redirect()->back()->with('thatbai','Hãy xóa đơn hàng của khách hàng trước khi xóa!');
        else{
            $customer=Customer::find($id);
            $name=$customer->name;
            $customer->delete();
        }
        return redirect()->back()->with('thanhcong','Xóa khách hàng '.$name.' thành công');
    }

    public function getSortCustomer($id)
    {
        
        switch ($id) {
            case 1:
                $customers=Customer::where('gender','Nam')->get();
                break;

            case 2:
                $customers=Customer::where('gender','Nữ')->get();
                break;

            case 3:
                $customers=Customer::orderBy('name')->get();
                break;

            case 4:
                $customers=Customer::orderBy('email')->get();
                break;

            case 5:
                $customers=Customer::join('bills','customer.id','=','bills.id_customer')
                ->select('customer.id','name','email','gender','address','phone_number','customer.note','customer.last_modified_by_user','customer.created_at','customer.updated_at',Bill::raw('count(bills.id_customer) as bills_count'))
                ->groupBy('bills.id_customer')
                ->orderBy('bills_count','DESC')
                ->get();
                
                break;


            
            default:
                # code...
                break;
        }
        foreach($customers as $key => $customer)
        { $this->showCustomerToHtml($customer,$id); } 
         // return $customers;
        // return view('page.quanly.timkiemsanpham',compact('customers','request')); onclick="return  confirm('Có xóa '+<?php $customer['name']+' không?');"
    }

    public function getSearchCustomer($searchname)
    {
        $customers=Customer::where('name','like','%'.$searchname.'%')
        ->orWhere('email','like','%'.$searchname.'%')
        ->orWhere('phone_number','=',$searchname)
        ->orWhere('id','=',$searchname)
        ->orWhere('phone_number','=',$searchname)
        ->orWhere('last_modified_by_user','=',$searchname)
        ->get();
        if($searchname=="null")
            $customers=Customer::all();
        foreach($customers as $key => $customer)
        { $this->showCustomerToHtml($customer,0); } 
    }

    public function showCustomerToHtml($customer,$id){
        ?>
        <tr style="text-align: center">
        <td><?php echo $customer['id'] ?></td>
        <td><?php echo $customer['name'] ?></td>
        <td><?php echo $customer['phone_number'] ?></td>
        <td><?php echo count($customer->bill) ?></td>
        <td><?php echo $customer['gender'] ?></td>
        <td><?php echo $customer['email'] ?></td>
        <td><?php echo $customer['address'] ?></td>
        <td><?php echo $customer['note'] ?></td>
        <td><?php echo $customer['last_modified_by_user'].' - '.$customer['user_modified']['full_name'] ?></td>
        <td><?php echo $customer['created_at'] ?></td>
        <td><?php echo $customer['updated_at'] ?></td>
        <td>
            <a href="<?php echo route('customer.edit',$customer['id']); ?>" class="btn btn-primary">Sửa</a>
        </td>
        </tr>
        <?php
     }
}
