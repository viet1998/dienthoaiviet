@extends('master')
@section('title')
Tìm đơn hàng
@endsection
@section('content')
<style type="text/css">
	.title-phone-oder{ font-size: 14px; background-color: #f0f0f0; margin:0;padding: 1rem 0;}
	.item-product-order{font-size: 14px; margin: 0; padding: 0.5rem;}
</style>
<section class="contai-grid">
	<section style="margin-top: 120px;">
		<h2 style="text-align: center;">Cảm ơn quý khách đã tin tưởng mua hàng tại Điện Thoại Việt</h2>
		<hr width="100%">
		<section class="row" style="font-size: 14px;">
			<div class="col-10" >
				<p>Chào Anh/Chị &nbsp<strong>{{$customer->name}} - {{$customer->phone_number}}</strong></p>
			</div>
			<div class="col-2">
				<p style="color: #147aff;"><i class="fas fa-comments"></i>&nbsp<a style="text-decoration: none;" href="#">Phản hồi, góp ý</a></p>
			</div>
			
		</section>
		<section class="row">
			<div class="col-12">
				<div class="card" style="padding: 20px;">
					<h2>Đơn hàng online đã mua gần đây</h2>
					<table>
						<tr>
							<td>
					<div class="row title-phone-oder" >
						<div class="col-2">Mã sản phẩm</div>
						<div class="col-4">Sản phẩm</div>
						<div class="col-2">Giá</div>
						<div class="col-2">Ngày đặt mua</div>
						<div class="col-2">Trạng thái</div>
					</div>
						</td>
					</tr>
						<tr>
							<td>
					<div class="row item-product-order" >
						<div class="col-2" style="color: #147aff;">#0890</div>
						<div class="col-1"><img width="100%;" src="/image/product/iphone-11-pro-max-silver-select-2019-4909.png"></div>
						<div class="col-3"><strong>iphone 11 pro max Trắng 64GB</strong><br><a href="#">Xem chi tiết</a></div>
						<div class="col-2" style="color: #f00;">30.000.000<u>đ</u></div>
						<div class="col-2">20/02/2020</div>
						<div class="col-2"><p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: #EED202;  text-align: center;">
														Chưa Giao hàng
														</p></div>
					</div>
					</td>
					</tr>
					</table>
					<hr width="100%;">
				</div>
			</div>
		</section>
	</section>
</section>
@endsection