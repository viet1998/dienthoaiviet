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
									<h3>Danh Sách Sản Phẩm <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">

										<form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="form-group row">
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
												@if(Session::has('thatbai'))
												<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
												@endif
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
												<div class="col-sm-10">
													<input type="text" name="name" class="form-control"  placeholder="" value="{{$product->name}}">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Loại</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="type">
														@foreach($product_types as $product_type)
														<option value="{{$product_type->id}}" @if($product->id_type==$product_type->id) selected @endif >{{$product_type->name}}</option>
														@endforeach
													</SELECT>
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Hãng</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="company">
														@foreach($companies as $company)
														<option value="{{$company->id}}" @if($product->id_company==$company->id) selected @endif>{{$company->name}}</option>
														@endforeach
													</SELECT>
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Mô Tả</label>
												<div class="col-sm-10">
													<textarea name="description" class="form-control" style="height: 300px">{{$product->description}}</textarea>
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Giá</label>
												<div class="col-sm-10">
													<input type="text" name="unit_price" class="form-control"  placeholder="" value="{{$product->unit_price}}">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Giá Khuyến Mãi</label>
												<div class="col-sm-10">
													<input type="text" name="promotion_price" class="form-control"  placeholder="" value="{{$product->promotion_price}}">
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Tình Trạng</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="new">
														
														<option value="1" @if($product->new==1) selected @endif>Mới</option>
														<option value="0" @if($product->new==0) selected @endif>Cũ</option>
													</SELECT>
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Ảnh Đại Diện</label>
												<div class="col-sm-10">
													<div style="overflow: auto">
													<table>
														<tr>
													@foreach($product->images as $image)
														<td align="center">

															<p><input type="radio" name="image" value="{{$image->link}}" @if($product->image==$image->link) checked @endif> </p>
															<p><img src="/image/product/{{$image->link}}" width="100px" height="100px"/> </p>
															<p><a href="{{route('remove_image',$image->id)}}" class="btn btn-danger">Xóa</a> </p>
														</td>
													@endforeach
														</tr>
													</table>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Thêm Hình Ảnh</label>
												<div class="col-sm-10">
													<input type="file" name="addimage[]" class="form-control" placeholder="" multiple >
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