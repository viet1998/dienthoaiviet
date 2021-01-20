@extends('admin.master-admin')
@section('content')
<script src="/adminjs/jquery2.0.3.min.js"></script>
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
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
										<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
											@csrf
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
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
												<div class="col-sm-10">
													<input type="text" name="name" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Loại</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="type">
														@foreach($product_types as $product_type)
														<option value="{{$product_type->id}}">{{$product_type->name}}</option>
														@endforeach
													</SELECT>
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Hãng</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="company">
														@foreach($companies as $companie)
														<option value="{{$companie->id}}">{{$companie->name}}</option>
														@endforeach
													</SELECT>
												</div>
											</div>

											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Mô Tả</label>
												<div class="col-sm-10">
													<input type="text" name="description" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Giá</label>
												<div class="col-sm-10">
													<input type="number" name="unit_price" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Khuyến Mãi</label>
												<div class="col-sm-10">
													<input type="number" name="promotion_price" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Hình Ảnh</label>
												<div class="col-sm-10">
													<input type="file" name="images[]" class="form-control" placeholder="" multiple >
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

@endsection