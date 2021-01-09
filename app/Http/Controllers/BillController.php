<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\bill_detail;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.quanly.quanlydonhang');
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
        return view('page.quanly.suadonhang',compact('bill'));
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
        $bill->note=$request->note;
        $bill->update();
        return redirect()->back()->with('thanhcong','Đơn hàng đã chuyển sang trạng thái '.$request->status);
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

    public function getSort($id)
    {
        
        switch ($id) {
            case 1:
                $bills=Bill::where('status','Đã Giao Hàng')->orderBy('date_order','DESC')->get();
                break;

            case 2:
                $bills=Bill::where('status','Chưa Giao Hàng')->orderBy('date_order','DESC')->get();
                break;

            case 3:
                $bills=Bill::where('status','Hủy')->orderBy('date_order','DESC')->get();
                break;

            case 4:
                $bills=Bill::orderBy('total','DESC')->orderBy('date_order','DESC')->get();
                break;

            case 5:
                $bills=Bill::orderBy('total')->orderBy('date_order','DESC')->get();
                break;


            
            default:
                # code...
                break;
        }
        foreach($bills as $key => $bill)
        {
            ?>
        <tr>
        <td><?php echo $key+1 ?></a></td>
        <td><?php echo $bill['customer']['name'] ?></a></td>
        <td><?php echo $bill['date_order'] ?></td>
        <td><?php echo number_format($bill['total']) ?> VNĐ</td>
        <td><?php echo $bill['customer']['phone_number'] ?></a></td>
        <td style="text-align: center"><?php echo $bill['payment'] ?></td>
        <?php if($bill['status']=='Chưa Giao Hàng') { ?>
        <td><div style="background-color: #FBF405;text-align: center;border-radius: 10px"><b><?php echo $bill['status'] ?></b></div></td>
        <?php } else {if ($bill['status']=='Đã Giao Hàng'){ ?>
        <td ><div style="background-color: #48FB05;text-align: center;border-radius: 10px"><b><?php echo $bill['status'] ?></b></div></td>
        <?php } else {if ($bill['status']=='Hủy') { ?>
        <td ><div style="background-color: red;text-align: center;border-radius: 10px"><b><?php echo $bill['status'] ?></b></div></td> 
        <?php }}} ?>
        <td><?php echo $bill['note'] ?></td>
        <td style="text-align: center;width: 200px">

            
            <a href="<?php echo route('qldonhang.show',$bill['id']); ?>" class="btn btn-primary">Chi Tiết</a>
        </td>
        </tr>
        <?php } 
         // return $bills;
        // return view('page.quanly.timkiemsanpham',compact('bills','request')); onclick="return  confirm('Có xóa '+<?php $bill['name']+' không?');"
    }

    public function getSearch($searchname)
    {
        $bills=Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('customer.name','like','%'.$searchname.'%')->orderBy('date_order','DESC')->get();
        if($searchname==null)
            $bills=Bill::orderBy('date_order','DESC')->get();
        foreach($bills as $key => $bill)
        {
            ?>
        <tr>
        <td><?php echo $key+1 ?></a></td>
        <td><?php echo $bill['customer']['name'] ?></a></td>
        <td><?php echo $bill['date_order'] ?></td>
        <td><?php echo number_format($bill['total']) ?> VNĐ</td>
        <td><?php echo $bill['customer']['phone_number'] ?></a></td>
        <td style="text-align: center"><?php echo $bill['payment'] ?></td>
        <?php if($bill['status']=='Chưa Giao Hàng') { ?>
        <td><div style="background-color: #FBF405;text-align: center;border-radius: 10px"><b><?php echo $bill['status'] ?></b></div></td>
        <?php } else {if ($bill['status']=='Đã Giao Hàng'){ ?>
        <td ><div style="background-color: #48FB05;text-align: center;border-radius: 10px"><b><?php echo $bill['status'] ?></b></div></td>
        <?php } else {if ($bill['status']=='Hủy') { ?>
        <td ><div style="background-color: red;text-align: center;border-radius: 10px"><b><?php echo $bill['status'] ?></b></div></td> 
        <?php }}} ?>
        <td><?php echo $bill['note'] ?></td>
        <td style="text-align: center;width: 200px">
            <a href="<?php echo route('qldonhang.show',$bill['id']); ?>" class="btn btn-primary">Chi Tiết</a>
        </td>
        </tr>
        
        <?php } 
    }
}
