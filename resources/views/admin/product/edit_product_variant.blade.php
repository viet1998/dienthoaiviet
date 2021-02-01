@extends('admin.master-admin')
@section('content')
<script src="/admin/js/jquery2.0.3.min.js"></script>
<script src="/admin/js/raphael-min.js"></script>
<script src="/admin/js/morris.js"></script>
	<section id="container">
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Sửa Biến Thể Của Sản Phẩm {{$product_variant->product->name}} <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
										<form action="{{route('product.updatevariant',$product_variant->id)}}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group row">
												@if(Session::has('error'))
												<div class="alert alert-danger">{{Session::get('error')}}</div>
												@endif
												@if(count($errors)>0)
												<div class="alert alert-danger">
													@foreach($errors->all() as $err)
													{{$err}}<br>
													@endforeach
												</div>
												@endif
												@if(Session::has('thanhcong'))
												<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
												@endif
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">ID Sản Phẩm</label>
												<div class="col-sm-10">
													<input type="number" name="id_product" class="form-control"  placeholder="" value="{{$product_variant->product->id}}" disabled="disabled">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
												<div class="col-sm-10">
													<input type="text" name="name" class="form-control"  placeholder="" value="{{$product_variant->product->name}}" disabled="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Phiên Bản</label>
												<div class="col-sm-10">
													<input type="text" name="version" class="form-control"  placeholder="Nhập phiên bản" value="{{$product_variant->version}}">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Màu</label>
												<div class="col-sm-10">
													<input name="color" type="radio" value="Đỏ" @if($product_variant->color=='Đỏ') checked @endif/> Đỏ
													<input name="color" type="radio" value="Vàng" @if($product_variant->color=='Vàng') checked @endif/> Vàng
													<input name="color" type="radio" value="Trắng" @if($product_variant->color=='Trắng') checked @endif/> Trắng
													<input name="color" type="radio" value="Đen" @if($product_variant->color=='Đen') checked @endif/> Đen
													<input name="color" type="radio" value="Xanh Lá" @if($product_variant->color=='Xanh Lá') checked @endif/> Xanh Lá
													<input name="color" type="radio" value="Xanh Dương" @if($product_variant->color=='Xanh Dương') checked @endif/> Xanh Dương
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Giá</label>

												<div class="col-sm-10">
													<input type="number" name="unit_price" class="form-control"  placeholder="Nhập giá" value="{{$product_variant->unit_price}}">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Hình Ảnh</label>
												<table>
													<tr>
													@foreach($product_variant->product->images as $image)
														<td align="center">
															<p><input type="radio" name="image" value="{{$image->id}}" @if($product_variant->id_image==$image->id) checked @endif> </p>
															<p><img src="/image/product/{{$image->link}}" width="100px" height="100px"/> </p>
														</td>
													@endforeach
													</tr>
												</table>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Số Lượng</label>
												<div class="col-sm-10">
													<input type="number" name="quantity" class="form-control"  placeholder="Nhập số lượng" value="{{$product_variant->quantity}}">
												</div>
											</div>
											<div class="form-group row">
												<div  align="center">
													<input type="submit" class="btn btn-primary" value="Nhập">
													<a href="{{route('productvariants')}}" class="btn btn-primary">Quay Lại</a>
												</div>

											</div>
										</form>

									</div>
								</div>
							</div>
						</div>
						
				<!--//agileinfo-grap-->
				</div>
			</div>
		</div>
		
		
	</section>
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <!-- <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p> -->
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="/admin/js/bootstrap.js"></script>
<script src="/admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/admin/js/scripts.js"></script>
<script src="/admin/js/jquery.slimscroll.js"></script>
<script src="/admin/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="/admin/js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	

<!-- script đồ thị -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endsection