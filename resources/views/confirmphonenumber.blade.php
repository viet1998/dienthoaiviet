@extends('master')
@section('title')
xác nhận số điên thoại
@endsection
@section('content')
<style type="text/css">
	.card-confirm{border: 1px solid #999; border-radius: 10px; text-align: center;}
	.card-confirm input{border: none;font-size: 16px; font-weight: bold; outline: 0}
	.card-confirm h1{margin:20px; }

	.forn-otp{ padding: 10px; margin: 20px auto; border: 1px solid #999; width: 300px; border-radius: 50px;}
	.btn-otp{ width: 300px; font-size: 20px;padding: 10px;margin-top: 10px; margin-bottom: 50px; background-color: transparent; border: none;
		border-radius: 50px; color: #fff;  background-color: purple; 
  background-image: linear-gradient(to right, #0066ff, #52a8ff); }
</style>
<section class="contai-grid top-130">
	<div style=" font-size: 16px;" class="row">
		<div class="col-md-2"> </div>
		<div class="col-12 col-md-8 ">
			<div class="card-confirm">
				<form  action="{{route('checkorder')}}" method="get">
				@csrf
				<img src="/image/banner/i1.png" width="100%">
				<h1>Mã xác nhận đã được gửi đến số điện thoại {{$phone}}</h1>
				<div class="forn-otp">
					
						<i class="fas fa-lock"></i> &nbsp
						<input type="text" name="phone" value="{{$phone}}" placeholder="Nhập mã xác nhận vào đây" hidden="">
						<input type="text" name="otp" placeholder="Nhập mã xác nhận vào đây">
					
				</div>
				<h4 style="color: #f00;">*@if(Session::has('thatbai')) {{Session::get('thatbai')}} @else Vui lòng nhập mã OTP @endif</h4>
				<button class="btn-otp" type="submit">TIẾP TỤC</button>
				</form>
			</div>
		</div>
		<div class="col-md-2"> </div>
	</div>
</section>
@endsection