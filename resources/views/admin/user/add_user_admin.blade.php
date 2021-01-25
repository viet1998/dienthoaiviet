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
									<h3>Thêm Tài Khoản <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
										<form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
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
												<label  class="col-sm-2 col-form-label">Họ và tên</label>
												<div class="col-sm-10">
													<input type="text" name="full_name" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Email</label>
												<div class="col-sm-10">
													<input type="text" name="email" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Mật Khẩu</label>
												<div class="col-sm-10">
													<input type="text" name="password" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Quyền truy cập</label>
												<div class="col-sm-10">
													<SELECT class="form-control" name="level">
														<option value="0">Khách Hàng</option>
														<option value="1">Nhân Viên</option>
														<option value="2">Quản Lý</option>
													</SELECT>
												</div>
											</div>

											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Số điện thoại</label>
												<div class="col-sm-10">
													<input type="text" name="phone" class="form-control"  placeholder="" >
												</div>
											</div>

											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Địa chỉ</label>
												<div class="col-sm-10">
													<input type="text" name="address" class="form-control"  placeholder="" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Ghi Chú</label>
												<div class="col-sm-10">
													<textarea name="note" class="form-control"  placeholder=""> </textarea> 
												</div>
											</div>

											
											<div class="form-group row">
												<div  align="center">
													<input type="submit" class="btn btn-primary" value="Nhập">
													<a href="{{route('user.index')}}" class="btn btn-primary">Quay Lại</a>
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