<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_variant;
use App\Models\Bill_detail;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Collective\Html\FormFacade as Form;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.product_admin');
    }

    public function getProductVariant(){
        $product_variants=Product_variant::paginate(10);
        return view('admin.product.product_variant_admin',compact('product_variants'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add_product_admin');
    }

    public function createVariant($id)
    {
        $product=Product::find($id);
        return view('admin.product.add_product_variant_admin',compact('product'));
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
                'unit_price'=>'required',
                'images'=>'required'
            ],
            [
                'name.required'=>'nhập tên',
                'unit_price.required'=>'nhập giá',
                'images.required'=>'nhập ảnh'
            ]);
        
        $product=new Product;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->id_type=$request->type;
        $product->id_company=$request->company;
        $product->promotion_price=$request->promotion_price;
        $product->unit_price=$request->unit_price;
        $product->new=1;
        $product->last_modified_by_user=Auth::user()->id;
        $files=$request->file('images');
        $name=null;
        if($request->hasFile('images'))
        {
            foreach ($files as $file) {
                $name=$file->getClientOriginalName();
                $destinationPath=public_path('/image/product');
                $file->move($destinationPath,$name);

            }
            
        }
        $product->image=$name;
        $product->save();
        if($request->hasFile('images'))
        {
            foreach ($files as $file) {
                $name=$file->getClientOriginalName();
                $image=new Image;
                $image->id_product=$product->id;
                $image->link=$name;
                $image->save();
            }
        }   
        return redirect()->back()->with('thanhcong','Thêm sản phẩm mới thành công');
    }

    public function storeVariant(Request $request)
    {
        $this->validate($request,
            [
                'version'=>'required',
                'colors'=>'required',
                'unit_price'=>'required',
                'quantity'=>'required'
            ],
            [
                'version.required'=>'Nhập phiên bản',
                'unit_price.required'=>'Nhập giá',
                'colors.required'=>'Chọn màu',
                'quantity.required'=>'Nhập số lượng'
            ]);
        if($request->image_product==0 && !$request->hasFile('image')){
            $error=null;
            $error="Hãy nhập ảnh!";
            return redirect()->back()->with('error',$error);
        }
        foreach ($request->colors as $key => $color) {
            $product_variant=new Product_variant;
            $product_variant->id_product=$request->id_product;
            $product_variant->version=$request->version;
            $product_variant->color=$color;
            $product_variant->unit_price=$request->unit_price;
            $product_variant->quantity=$request->quantity;
            $product_variant->last_modified_by_user=Auth::user()->id;
            $name=null;
            if($request->image_product!=0){
                $product_variant->id_image=$request->image_product;
            }else{
                $file=$request->file('image');
                $name=$file->getClientOriginalName();
                $image=new Image;
                $image->id_product=$request->id_product;
                $image->link=$name;
                $image->save();
                $product_variant->id_image=$image->id;
            }
            $product_variant->save();
        }
        
             
        return redirect()->back()->with('thanhcong','Thêm sản phẩm mới thành công');
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
        return view('admin.product.edit_product',['product'=>$product]);
    }

    public function editVariant($id)
    {
        $product_variant=Product_variant::find($id);
        return view('admin.product.edit_product_variant',['product_variant'=>$product_variant]);
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
                'unit_price'=>'required',
            ],
            [
                'name.required'=>'nhập tên',
                'unit_price.required'=>'nhập giá',
            ]);
        $product=Product::find($id);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->id_type=$request->type;
        $product->id_company=$request->company;
        $product->promotion_price=$request->promotion_price;
        $product->unit_price=$request->unit_price;
        $product->new=$request->new;
        $product->last_modified_by_user=Auth::user()->id;
        $product->image=$request->image;
        $files=$request->file('addimage');
        $name=null;
        if($request->hasFile('addimage'))
        {
            foreach ($files as $file) {
                $name=$file->getClientOriginalName();
                $destinationPath=public_path('/image/product');
                $file->move($destinationPath,$name);
                $image=new Image;
                $image->id_product=$product->id;
                $image->link=$name;
                $image->save();
            }
        }
        $product->update();
        return redirect()->back()->with('thanhcong','Sửa thông tin thành công');
    }

    public function updateVariant(Request $request, $id){
        $this->validate($request,
            [
                'version'=>'required',
                'color'=>'required',
                'unit_price'=>'required',
                'quantity'=>'required'
            ],
            [
                'version.required'=>'Nhập phiên bản',
                'unit_price.required'=>'Nhập giá',
                'color.required'=>'Chọn màu',
                'quantity.required'=>'Nhập số lượng'
            ]);
        
        $product_variant=Product_variant::find($id);
        $product_variant->version=$request->version;
        $product_variant->color=$request->color;
        $product_variant->unit_price=$request->unit_price;
        $product_variant->quantity=$request->quantity;
        $product_variant->last_modified_by_user=Auth::user()->id;
        $product_variant->id_image=$request->image;
        $product_variant->save();
        return redirect()->back()->with('thanhcong','Thêm sản phẩm mới thành công');
    }

    public function removeImage($id)
    {
        $image = Image::find($id);
        $productvariant= Product_variant::where('id_image',$image->id)->get();
        if(count($productvariant)>0)
            return redirect()->back()->with('thatbai','Hãy thay đổi ảnh của sản phẩm: '.$image->product->name.' '.$image->product_variant->version.' '.$image->product_variant->color.' trước khi xóa'); 
        $image->delete();
        return redirect()->back()->with('thanhcong','Xóa ảnh thành công');
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
        showProductToHtml($product);
        } 
    }

    public function getSortVariant($id)
    {
        
        switch ($id) {
            case 1:
                $product_variants=Product_variant::orderBy('unit_price')->get();
                break;

            case 2:
                $product_variants=Product_variant::orderBy('unit_price','DESC')->get();
                break;

            case 3:
                $product_variants=Product_variant::Join('bill_detail', 'product_variants.id', '=', 'bill_detail.id_product_variant')->select('product_variants.id','id_product','color','version','id_image','product_variants.unit_price','product_variants.quantity','last_modified_by_user','product_variants.created_at','product_variants.updated_at',Bill_detail::raw('sum(bill_detail.quantity) as product_count'))->groupBy('bill_detail.id_product_variant')->orderByDesc('product_count')->get();
                break;
            
            default:
                # code...
                break;
        }
        foreach($product_variants as $product)
        {
            ?>
        <tr>
        <td><?php echo $product['id']; ?></td >
        <td><a href="<?php echo  route('product.edit',$product->id_product) ?>"><?php echo $product['product']['name'] ?></a></td>
        <td><?php echo $product['version']; ?></td >
        <td><?php echo $product['color']; ?></td >
        <td><?php echo $product['product']['product_type']['name']; ?></td >
        <td><?php echo $product['product']['company']['name']; ?></td >
        <td><?php echo $product['quantity']; ?></td >
        <?php if($id==3) {?>
            <td><?php echo $product['product_count'] ?></td>
        <?php } else {
        ?>  <td><?php echo $product->bill_detail->sum('quantity'); ?></td >
        <?php } ?>
        <td style=""><?php echo number_format($product['unit_price'],0,'','.') ?> VNĐ</td>
        <td><img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/<?php echo $product['image']['link'] ?>"> </td>
        <td><?php echo $product['last_modified_by_user'].' - '.$product['user_modified']['full_name']; ?></td>
        <td><?php echo $product['created_at']; ?></td >
        <td><?php echo $product['updated_at']; ?></td >
        <td style="width: 150px">

        
        <?php echo Form::open(array('route' => ['product.destroy',$product['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('product.editvariant',$product['id']); ?>" class="btn btn-primary">Sửa</a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-primary','onclick'=>'return confirm("Có xóa '.$product['product']['name'].' không?")']); ?>
        <?php echo Form::close(); ?>
        </td>
        </tr>
        <?php } 
         // return $products;
        // return view('page.quanly.timkiemsanpham',compact('products','request')); onclick="return  confirm('Có xóa '+<?php $product['name']+' không?');"
    }

    
     public function showProductToHtml($product){
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
        <?php
     }
}
