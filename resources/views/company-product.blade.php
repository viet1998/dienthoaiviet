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
		<!-- logo brand product -->
		<section class="lg-brand">
			<div class="row-lg-brand">
				<div class="column">
					<a href="Apple"><img src="/image/logo/iphone-apple.jpg" /></a>
				</div>
				<div class="column">
					<a href="samsung"><img src="/image/logo/samsung.jpg" /></a>
				</div>
				<div class="column">
					<a href="oppo"><img src="/image/logo/oppo42.png" /></a>
				</div>
				<div class="column">
					<a href="xiaomi"><img src="/image/logo/xiaomi42.jpg" /></a>
				</div>
				<div class="column">
					<a href="vivo"><img src="/image/logo/vivo42.jpg" /></a>
				</div>
				<div class="column">
					<a href="realme"><img src="/image/logo/realme42.png" /></a>
				</div>
				<div class="column">
					<a href="oneplus"><img src="/image/logo/oneplus42.jpg" style="height: 86%;" /></a>
				</div>
			</div>
		</section>
	<!--  bộ lọc  -->
		<section class="filter-price bg-light">
			<div class="column">
			<p>Chọn mức giá:</p>
			</div>
			<div class="column">
				<a href="#">Dưới 2 triệu</a>
			</div>
			<div class="column">
				<a href="#">Từ 2 - 4 triệu</a>
			</div>
			<div class="column">
				<a href="#">Từ 4 - 7 triệu</a>
			</div>
			<div class="column">
				<a href="#">Từ 7 - 13 triệu</a>
			</div>
			<div class="column">
				<a href="#">Trên 13 triệu</a>
			</div>		
		</section>

	<!-- danh sách điện thoại nổi bật nhất -->
	<section class="list-listphone">
		<div class="title-lpd">
			<span>Điện thoại nổi bật nhất</span>
		</div>
		<div class="col-listphone">
			<div class="card-listphone">
				<a href="/dienthoaiviet/1">
				<img src="/image/product/iphone-11-pro-max-green.jpg" />
				<p>Iphone 11 pro max(64gb Chính hảng)</p>
				<div class="price"><strong>23.000.000<u>đ</u></strong><span>26.000.000<u>đ</u></span></div>
				</a>
			</div>
			<div class="card-listphone">
				<a href="/dienthoaiviet/1">
				<img src="/image/product/iphone-11-pro-max-green.jpg" />
				<p>Iphone 11 pro max(64gb Chính hảng)</p>
				<div class="price"><strong>23.000.000<u>đ</u></strong><span>26.000.000<u>đ</u></span></div>
				</a>
			</div>
			<div class="card-listphone">
				<a href="/dienthoaiviet/1">
				<img src="/image/product/iphone-11-pro-max-green.jpg" />
				<p>Iphone 11 pro max(64gb Chính hảng)</p>
				<div class="price"><strong>23.000.000<u>đ</u></strong><span>26.000.000<u>đ</u></span></div>
				</a>
			</div>
			<div class="card-listphone">
				<a href="/dienthoaiviet/1">
				<img src="/image/product/iphone-11-pro-max-green.jpg" />
				<p>Iphone 11 pro max(64gb Chính hảng)</p>
				<div class="price"><strong>23.000.000<u>đ</u></strong><span>26.000.000<u>đ</u></span></div>
				</a>
			</div>
			<div class="card-listphone">
				<a href="/dienthoaiviet/1">
				<img src="/image/product/iphone-11-pro-max-green.jpg" />
				<p>Iphone 11 pro max(64gb Chính hảng)</p>
				<div class="price"><strong>23.000.000<u>đ</u></strong><span>26.000.000<u>đ</u></span></div>
				</a>
			</div><div class="card-listphone">
				<a href="/dienthoaiviet/1">
				<img src="/image/product/iphone-11-pro-max-green.jpg" />
				<p>Iphone 11 pro max(64gb Chính hảng)</p>
				<div class="price"><strong>23.000.000<u>đ</u></strong><span>26.000.000<u>đ</u></span></div>
				</a>
			</div>
		</div>		
	</section>
	</section>
@endsection
