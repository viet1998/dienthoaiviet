
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
						<button class="btn"><a href="#"><i class="fas fa-edit"></i></a></button>
					</div>
				</div>
				<hr width="100%">
				<div class="user-list-order">
					<h3>Danh sách đơn hàng của bạn </h3>
					<div class="row">
						
						<div class="col">
							@if(Auth::check())
							@if(isset($carts))
							@foreach($carts as $key => $value)
							<div class="card-order">
								<div class="row item-product" style="vertical-align: middle">
									<div class="col-9" >
										<span style="margin: 0 20px; font-weight: bold;">
										Đơn hàng: {{$key}} | Ngày mua: @foreach($bills as $bill) @if($bill->id==$key) {{$bill->date_order}} @endif @endforeach
										</span>
									</div>
									<div class="col-3" style="text-align: center;">
										@foreach($bills as $bill) 
											@if($bill->id==$key) 
												@switch($bill->status)
													@case(0) 
														<p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: #EED202;">
														Chưa Giao hàng
														</p> @break
													@case(1) 
														<p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: #36B93A;">Đã Giao Hàng
														</p> @break
													@case(2) 
														<p style="color: #fff; border: 1px solid #000; border-radius: 15px; padding: 2px; background-color: #CD0016;">Đã Hủy
														</p> @break
													@default
												@endswitch
											@endif 
										@endforeach
									</div>
								</div>
								<hr width="100%" />
								@foreach($value->items as $item)
								<div class="row item-product" style="padding: 5px">
									<div class="col-2"><a href="{{route('show',$item['item']['id_product'])}}"><img src="/image/product/{{$item['item']['image']['link']}}"  style="width: 80px;height: 90px"></a></div>
									<div class="col-6">
										<strong>{{$item['item']['product']['name']}} 
											<a href="{{route('show',$item['item']['id_product'])}}" style="text-decoration: none;color: black;">(Chi tiết)</a></strong><br>
										<strong>Phiên Bản: {{$item['item']['version']}}</strong><br>
										<strong>Màu: {{$item['item']['color']}}</strong>
										<!-- <p>Bộ nhớ 64GB/ Ram 4GB/ Camera: 48m & 12m</p> -->
									</div>
									<div class="col-4">
										<p>Số Lượng: {{$item['qty']}}</p>
										<p>Giá: {{number_format($item['price'],0,'','.')}}<u>đ</u></strong></p>
									</div>
								</div>
								@endforeach
								<hr width="100%">
								<div class="row"> 
									<div class="col-8"><p>Tổng thanh toán:</p></div>
									<div class="col-4"><strong style="color: #f00;">{{number_format($value->totalPrice,0,'','.')}}<u>đ</u></strong></div>
								</div>
								
							</div>
							@endforeach
							@endif
							@endif
							

						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
</section>

@endsection