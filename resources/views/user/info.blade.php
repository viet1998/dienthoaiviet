
@extends('master')
@section('content')
<style type="text/css">
	.contai-grid {font-size: 14px;}
	.side-bar-funtion { width: 100%; height: auto; background-color: #f0f0f0;} 
	.side-bar-funtion li{ list-style: none; text-align: center;padding: 10px;}
	.profile-sub .col-1 button{ background-color: #f0f0f0; height: 100%;width: 50px; font-size: 15px;}
	.profile-sub .col-1 button:hover{opacity: 0.8;}
	.card-profile{box-shadow:  0 0 5px 5px rgba(0,0,0,0.2); padding: 10px;}
	.user-list-order h3{padding: 5px 10px; background-color: #ff3300; color: #fff; border-top-left-radius: 5px; 
		border-bottom-left-radius: 5px; border-top-right-radius: 15px; border-bottom-right-radius: 15px;}
		.img-bn{height: 700px; background-color: #f0f0f0; border-radius: 8px;padding: 10px;}
		.card-order{ background-color: #f0f0f0; height: auto; padding: 8px; border-radius: 5px;margin-bottom: 10px;}
		.card-order .item-product .col-2 img{ width: 100%; }
</style>
<section class="container-grid">
	<section class="contai-grid">
		<section class="top-130">
			<section class="col-12 card-profile">
				<div class="row profile-sub">
					<div class="col-2">
						<img src="/image/icon/user.png" style="background-color: #f0f0f0;width: 90%; border-radius: 50%; padding: 10px;"/>
					</div>
					<div class="col-9">
						<h3>@if(Auth::check()) {{Auth::user()->full_name}} @endif</h3>
						<p><span>Danh hiệu: <strong>@if(Auth::check()) @if(Auth::user()->level==0) Khách hàng @endif @endif</strong></span></p>
						<p><span>Tổng đơn đã đặt: <strong>@if(isset($carts)) {{count($carts)}} @endif</strong></span></p>
						<a href="#" style="background-color: #ffcc6e; border-radius: 16px; padding: 2px;border: 1px solid #ff2600; text-decoration: none; color: #333;">Sản phẩm đã yêu thích <i class="fas fa-chevron-right"></i></a>
					</div>
					<div class="col-1">
						
					</div>
				</div>
				<hr width="100%">
				<div class="user-list-order">
					<h3>Danh sách đơn hàng của bạn </h3>
					<div class="row">
						
						<div class="col" align="center">
								<form action="{{route('updateprofile')}}" method="post" enctype="multipart/form-data">
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
													<input type="text" name="full_name" class="form-control"  placeholder="" value="{{Auth::user()->full_name}}" >
												</div>
											</div>
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Email</label>
												<div class="col-sm-10">
													<input type="text" name="email" class="form-control"  placeholder="" value="{{Auth::user()->email}}" disabled>
												</div>
											</div>
											

											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Số điện thoại</label>
												<div class="col-sm-10">
													<input type="text" name="phone" class="form-control"  placeholder="" value="{{Auth::user()->phone}}" >
												</div>
											</div>

											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Địa chỉ</label>
												<div class="col-sm-10">
													<input type="text" name="address" class="form-control"  placeholder="" value="{{Auth::user()->address}}" >
												</div>
											</div>
											
											
											<div align="center">
												<div align="center">
													<input type="submit" class="btn btn-primary" value="Lưu" >
													<a href="{{route('profile')}}" class="btn btn-primary">Quay Lại</a>
												</div>

											</div>
								</form>
								
							

						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
</section>

@endsection