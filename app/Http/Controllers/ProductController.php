<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product_admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('show',compact('product'));
    }
    // public function navbar(){
    //     return view('navbar');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view('admin.edit_product',['product'=>$product]);
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
                'type'=>'required',
                'company'=>'required',
                'unit_price'=>'required',
                'promotion_price'=>'required',
            ],
            [
                'name.required'=>'nhập tên',
                'type.required'=>'nhập loại',
                'type.required'=>'nhập hãng',
                'unit_price.required'=>'nhập giá',
                'promotion_price.required'=>'nhập giá khuyến mãi nhỏ nhất = 0',
            ]);
        $product=Product::find($id);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->id_type=$request->type;
        $product->id_company=$request->company;
        $product->unit_price=$request->unit_price;
        $product->promotion_price=$request->promotion_price;
        $product->new=$request->new;
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $name=$file->getClientOriginalName();
            $destinationPath=public_path('image/product');
            $file->move($destinationPath,$name);
            $product->image=$name;
        }
        $product->update();
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
        $bill_detail=Bill_detail::where('id_product',$id)->get();
        if($bill_detail->count()>0)
            return redirect()->back()->with('thatbai','Không thể xóa sản phẩm có trong đơn hàng đã đặt!');
        else{
            $product=Product::find($id);
            $name=$product->name;
            $product->delete();
        }
        return redirect()->back()->with('thanhcong','Xóa sản phẩm '.$name.' thành công');
    }

    public function getSearch($searchname)
    {
        $products=Product::where('name','like','%'.$searchname.'%')->get();
        if($searchname==null)
            $products=Product::all();
        foreach($products as $product)
        {
            ?>
        <tr>
        <td><a href="<?php echo  route('sanpham',$product['id']) ?>"><?php echo $product['name'] ?></a></td>
        <td><a href="<?php echo  route('loai_sanpham',$product['product_type']['id']) ?>"><?php echo $product['product_type']['name'] ?></a></td>
        <td width="200px"><?php echo $product['description'] ?></td>
        <td style="text-align: center"><?php echo number_format($product['unit_price']) ?> VNĐ</td>
        <td style="text-align: center"><?php echo number_format($product['promotion_price']) ?> VNĐ</td>
        <td><img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/<?php echo $product['image'] ?>"> </td>
        <td><?php echo $product['unit'] ?></td>
        <!-- <?php if(isset($product['bills_count']))?>
        <td><?php echo $product['bills_count'] ?></td>  -->
        <td style="">

        <!-- <form method="post" action="<?php echo route('qlsanpham.destroy',$product['id']) ?>"> -->
        <?php echo Form::open(array('route' => ['qlsanpham.destroy',$product['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('qlsanpham.edit',$product['id']); ?>" class="btn btn-primary">Sửa</a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-primary','onclick'=>'return confirm("Có xóa '.$product['name'].' không?")']); ?>
        <?php echo Form::close(); ?>
        </td>
        </tr>
        
        <?php } 
    }

    public function getSort($id)
    {
        
        switch ($id) {
            case 1:
                $products=Product::orderBy('unit_price')->get();
                break;

            case 2:
                $products=Product::orderBy('unit_price','DESC')->get();
                break;

            case 3:
                $products=Product::join('bill_detail', 'products.id', '=', 'bill_detail.id_product')->select('products.id','name','id_type','description','products.unit_price','promotion_price','image','unit','new',Bill_detail::raw('sum(bill_detail.quantity) as product_count'))->groupBy('bill_detail.id_product')->orderByDesc('product_count')->get();
                break;
            
            default:
                # code...
                break;
        }?>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Loại Bánh</th>
                <th>Mô Tả</th>
                <?php if($id==3) {?><th>Số lượng đã bán</th><?php } ?>
                <th>Giá</th>
                <th>Giá Khuyến Mãi</th>
                <th>Hình Ảnh</th>
                <th>Đơn vị</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody >
            <?php
        foreach($products as $product)
        {
            ?>
        <tr>
        <td><?php echo $product['id']; ?></td >
        <td><a href="<?php echo  route('sanpham',$product['id']) ?>"><?php echo $product['name'] ?></a></td>
        <td><a href="<?php echo  route('loai_sanpham',$product['product_type']['id']) ?>"><?php echo $product['product_type']['name'] ?></a></td>
        <td width="200px"><?php echo $product['description'] ?></td>
        <?php if($id==3) {?><td><?php echo $product['product_count'] ?></td><?php } ?>
        <td style=""><?php echo number_format($product['unit_price']) ?> VNĐ</td>
        <td style=""><?php echo number_format($product['promotion_price']) ?> VNĐ</td>
        <td><img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/<?php echo $product['image'] ?>"> </td>
        <td><?php echo $product['unit'] ?></td>
        <!-- <?php if(isset($product['bills_count']))?>
        <td><?php echo $product['bills_count'] ?></td>  -->
        <td style="">

        <!-- <form method="post" action="<?php echo route('qlsanpham.destroy',$product['id']) ?>"> -->
        <?php echo Form::open(array('route' => ['qlsanpham.destroy',$product['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('qlsanpham.edit',$product['id']); ?>" class="btn btn-primary">Sửa</a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-primary','onclick'=>'return confirm("Có xóa '.$product['name'].' không?")']); ?>
        <?php echo Form::close(); ?>
        </td>
        </tr>
        </tbody>
        
        <?php } 
         // return $products;
        // return view('page.quanly.timkiemsanpham',compact('products','request')); onclick="return  confirm('Có xóa '+<?php $product['name']+' không?');"
    }

}
