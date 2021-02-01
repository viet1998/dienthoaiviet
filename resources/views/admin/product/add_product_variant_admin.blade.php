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
									<h3>Thêm Sản Phẩm <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
										<form action="{{route('product.storevariant')}}" method="post" enctype="multipart/form-data">
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
													<input type="number" name="id_product" class="form-control"  placeholder="" value="{{$product->id}}">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
												<div class="col-sm-10">
													<input type="text" name="name" class="form-control"  placeholder="" value="{{$product->name}}" disabled="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Phiên Bản</label>
												<div class="col-sm-10">
													<input type="text" name="version" class="form-control"  placeholder="Nhập phiên bản" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Màu</label>
												<div class="col-sm-10">
													<input name="colors[]" type="checkbox" value="Đỏ" /> Đỏ
													<input name="colors[]" type="checkbox" value="Vàng" /> Vàng
													<input name="colors[]" type="checkbox" value="Trắng" /> Trắng
													<input name="colors[]" type="checkbox" value="Đen" /> Đen
													<input name="colors[]" type="checkbox" value="Xanh Lá" /> Xanh Lá
													<input name="colors[]" type="checkbox" value="Xanh Dương" /> Xanh Dương
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Giá</label>

												<div class="col-sm-10">
													<input type="number" name="unit_price" class="form-control"  placeholder="Nhập giá" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Hình Ảnh</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="image_product">
														<option value="0">Không</option>
														@foreach($product->images as $image)
														<option value="{{$image->id}}" >{{$image->link}}</option>
														@endforeach
													</SELECT>

												</div>
												<div class="col-sm-10" style="float: right">
													<input type="file" name="image" class="form-control" placeholder="">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Số Lượng</label>
												<div class="col-sm-10">
													<input type="number" name="quantity" class="form-control"  placeholder="Nhập số lượng" >
												</div>
											</div>
											<div class="form-group row">
												<div  align="center">
													<input type="submit" class="btn btn-primary" value="Nhập">
													<a href="{{route('product.index')}}" class="btn btn-primary">Quay Lại</a>
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