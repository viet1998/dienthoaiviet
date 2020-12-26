
@section('title')
Mua sim số đẹp
@endsection
@extends('master')
@section('content')
	<section class="contai-grid">
		<!-- slide & banner -->
		<section class="row-slide-banner-lp">
			<div class="col-slide-lp">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						 <div class="carousel-item active">
						      <img src="/image/slide/800-170-0.png" class="d-block w-100" alt="...">
						    </div>
						    <div class="carousel-item">
						      <img src="/image/slide/800-170-1.png" class="d-block w-100" alt="...">
						    </div>
						    <div class="carousel-item">
						      <img src="/image/slide/800-170-2.png" class="d-block w-100" alt="...">
						    </div>
						    <div class="carousel-item">
						      <img src="/image/slide/800-170-4.png" class="d-block w-100" alt="...">
						    </div>
						    <div class="carousel-item">
						      <img src="/image/slide/800-170-5.png" class="d-block w-100" alt="...">
						    </div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class="col-banner-lp">
				<a href=""><img src="/image/banner/sticky-oppo.png"></a>
				<a href=""><img src="/image/banner/a31.png"></a>
			</div>
		</section>
	
	<!-- Dong thong bao -->
	<div style="height: 40px; width: 100%; padding: 5px; border-radius: 5px;border: 2px solid #f80;">
		<marquee><h1 style="color: #f00;">Trang đang này đang được nâng cấp, bảo trì không khả dụng ngay lúc này</h1></marquee>
		</div>
	<!-- ket thuc thong bao -->
	<!-- danh sách nhà mạng và gói cước -->

		<section class="menu-sim-type">
			<div class="title-menu-sim">
				<h2>gọi thả ga, data khủng</h2>
			</div>
			<div class="list-menu-card">
				<div class="card-mobile-network">
					<div class="col-img"><img src="/image/mobi-network/viettel.png"></div>
					<div class="col-sub">
						<p>Tháng đầu: Miễn phí</p>
						<p>Tráng thứ 2-12: 120.000đ/tháng </p>
						<div><p>Giá từ:</p><strong style="color: #f00;">270.000<u>đ</u></strong></div>
						<a href="#">Chi tiết</a>
						<a href="" class="btn btn-outline-info" style="font-size: 14px; font-weight: bold;">Chọn số</a>
					</div>
				</div>
				<div class="card-mobile-network">
					<div class="col-img"><img src="/image/mobi-network/mobifone.png"></div>
					<div class="col-sub">
						<p>Tháng đầu: Miễn phí</p>
						<p>Tráng thứ 2-12: 120.000đ/tháng </p>
						<div><p>Giá từ:</p><strong style="color: #f00;">270.000<u>đ</u></strong></div>
						<a href="#">Chi tiết</a>
						<a href="" class="btn btn-outline-info" style="font-size: 14px; font-weight: bold;">Chọn số</a>
					</div>
				</div>
				<div class="card-mobile-network">
					<div class="col-img"><img src="/image/mobi-network/vinafone.png"></div>
					<div class="col-sub">
						<p>Tháng đầu: Miễn phí</p>
						<p>Tráng thứ 2-12: 120.000đ/tháng </p>
						<div><p>Giá từ:</p><strong style="color: #f00;">270.000<u>đ</u></strong></div>
						<a href="#">Chi tiết</a>
						<a href="" class="btn btn-outline-info" style="font-size: 14px; font-weight: bold;">Chọn số</a>
					</div>
				</div>
				<div class="card-mobile-network">
					<div class="col-img"><img src="/image/mobi-network/vietnam-mobifone.png"></div>
					<div class="col-sub">
						<p>Tháng đầu: Miễn phí</p>
						<p>Tráng thứ 2-12: 120.000đ/tháng </p>
						<div><p>Giá từ:</p><strong style="color: #f00;">270.000<u>đ</u></strong></div>
						<a href="#">Chi tiết</a>
						<a href="" class="btn btn-outline-info" style="font-size: 14px; font-weight: bold;">Chọn số</a>
					</div>
				</div>
			</div>
		</section>
	</section>
@endsection

@endsection