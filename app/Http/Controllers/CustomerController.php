<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Bill;
use Collective\Html\FormFacade as Form;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.quanly.quanlykhachhang');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.quanly.themkhachhang');
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
        return view('page.quanly.quanlykhachhang');
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
        return view('page.quanly.suakhachhang',compact('customer'));
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
                'email'=>'required|email',
                'address'=>'required',
                'phone_number'=>'required'
            ],
            [
                'name.required'=>'Nhập tên',
                'gender.required'=>'Nhập giới tính',
                'email.required'=>'Nhập email',
                'address.required'=>'Nhập địa chỉ',
                'phone_number.required'=>'Nhập số điện thoại',
                'email.email'=>'Email không đúng định dạng'
                
            ]);
        $customer=Customer::find($id);
        $customer->name=$request->name;
        $customer->gender=$request->gender;
        $customer->email=$request->email;
        if($customer->phone_number!=$request->phone_number){
            $checkcus=Customer::where('phone_number',$request->phone_number)->get();
            if($checkcus->count()==0)
                $customer->phone_number=$request->phone_number;
            else
                $this->validate($request,
                [
                    'phone_number'=>'unique:customer,phone_number'
                ],
                [
                    'phone_number.unique'=>'Số điện thoại đã có trong danh sách khách hàng'
                ]);
        }
        $customer->address=$request->address;
        
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

    public function getSort($id)
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
                $customers=Customer::join('bills','customer.id','=','bills.id_customer')->select('customer.id','name','email','gender','address','phone_number','customer.note',Bill::raw('count(bills.id_customer) as bills_count'))->groupBy('bills.id_customer')->orderBy('bills_count','DESC')->get();
                break;


            
            default:
                # code...
                break;
        }
        ?>
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên Khách Hàng</th>
            <th>Giới Tính</th>
            <th>Email</th>
            <?php if($id==5) { ?> <th>Số Đơn Hàng Đã Mua</th> <?php } ?>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Ghi Chú</th>
            <th>Chức Năng</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($customers as $key => $customer)
        {
            ?>
        <tr>
        <td><?php echo $customer['id'] ?></td>
        <td><?php echo $customer['name'] ?></td>
        <td><?php echo $customer['gender'] ?></td>
        <td><?php echo $customer['email'] ?></td>
        <?php if($id==5) { ?> <td><?php echo $customer['bills_count'] ?></td> <?php } ?>
        <td><?php echo $customer['address'] ?></td>
        <td><?php echo $customer['phone_number'] ?></td>
        <td><?php echo $customer['note'] ?></td>
        <td>
            <?php echo Form::open(array('route' => ['qlkhachhang.destroy',$customer['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('qlkhachhang.edit',$customer['id']); ?>" class="btn btn-primary">Sửa</a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-primary','onclick'=>'return confirm("Có xóa '.$customer['name'].' không?")']); ?>
            <?php echo Form::close(); ?>
        </td>
        </tr>
        </tbody>
        <?php } 
         // return $customers;
        // return view('page.quanly.timkiemsanpham',compact('customers','request')); onclick="return  confirm('Có xóa '+<?php $customer['name']+' không?');"
    }

    public function getSearch($searchname)
    {
        $customers=Customer::where('name','like','%'.$searchname.'%')->orWhere('email','like','%'.$searchname.'%')->orWhere('phone_number','like','%'.$searchname.'%')->get();
        if($searchname==null)
            $customers=Customer::all();
        ?>
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên Khách Hàng</th>
            <th>Giới Tính</th>
            <th>Email</th>
            <th>Địa Chỉ</th>
            <th>Điện Thoại</th>
            <th>Ghi Chú</th>
            <th>Chức Năng</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($customers as $key => $customer)
        {
            ?>
        <tr>
        <td><?php echo $customer['id'] ?></td>
        <td><?php echo $customer['name'] ?></td>
        <td><?php echo $customer['gender'] ?></td>
        <td><?php echo $customer['email'] ?></td>
        <td><?php echo $customer['address'] ?></td>
        <td><?php echo $customer['phone_number'] ?></td>
        <td><?php echo $customer['note'] ?></td>
        <td>
            <?php echo Form::open(array('route' => ['qlkhachhang.destroy',$customer['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('qlkhachhang.edit',$customer['id']); ?>" class="btn btn-primary">Sửa</a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-primary','onclick'=>'return confirm("Có xóa '.$customer['name'].' không?")']); ?>
            <?php echo Form::close(); ?>
        </td>
        </tr>
        </tbody>
        
        <?php } 
    }
}
