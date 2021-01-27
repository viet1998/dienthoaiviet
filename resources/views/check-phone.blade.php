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
				<div class="card" style="padding: 10px;">
					<h2>Đơn hàng online đã mua gần đây</h2>
					
					<div class="row title-phone-oder" >
						<div class="col-1" style="width:20px">Mã sản phẩm</div>
						<div class="col-4">Sản phẩm</div>
						<div class="col-2">Giá</div>
						<div class="col-2">Ngày đặt mua</div>
						<div class="col-2">Trạng thái</div>
					</div>
					@foreach($customer->bill as $bill)
					<div class="row item-product-order" >
						<div class="col-1" style="color: #147aff;width:20px">#{{$bill->id}}</div>
						<div class="col-4" >
							<table width="100%" height="100%">
								@foreach($bill->bill_detail as $bill_detail)
								<tr >
									<td style="height: 80px">
										<div style="float:left;width: 25%">
											<img width="60px" height="60px" src="/image/product/{{$bill_detail->product_variant->image->link}}">
										</div>
										<div style="width: 70%">
											<strong>{{$bill_detail->product_variant->product->name}} {{$bill_detail->product_variant->version}} {{$bill_detail->product_variant->color}}</strong><br><a href="{{route('show',$bill_detail->product_variant->product->id)}}" target="_blank">Xem chi tiết</a>
										</div>
									</td>
								</tr>
								@endforeach
							</table>
								
						
						</div>
						<div class="col-2" style="color: #f00;">{{number_format($bill->total,0,'','.')}}<u>đ</u></div>
						<div class="col-2">{{$bill->date_order}}</div>
						<div class="col-2">
							@switch($bill->status)
							@case(0)
							<p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: #EED202;  text-align: center;">Chưa Giao hàng</p>@break
							@case(1)
							<p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: red;  text-align: center;">Đã Hủy</p>@break
							@case(2)
							<p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: #48FB05;  text-align: center;">Đã Giao hàng</p>@break
							@endswitch
						</div>
					</div>
					@endforeach		
					<hr width="100%;">
				</div>
			</div>
		</section>
	</section>
</section>
@endsection