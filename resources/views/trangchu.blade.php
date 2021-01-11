@extends('master')
@section('title')
	Trang chủ
@endsection
@section('content')
		<section class="contai-grid">
			<!-- slide vs banner trang chủ -->
			<section class="row-slide-banner">
				<div class="col-slide">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner">
						    <div class="carousel-item active">
						      <img src="/image/slide/banner1.png" class="d-block w-100" alt="...">
						    </div>
						    <div class="carousel-item">
						      <img src="/image/slide/banner2.png" class="d-block w-100" alt="...">
						    </div>
						    <div class="carousel-item">
						      <img src="/image/slide/banner3.png" class="d-block w-100" alt="...">
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
				<!--  banner and blog card -->
				<div class="col-banner">
					<a href=""><img src="/image/banner/iPhoneDOCQUYEN-398-110-398x110.png"></a>

					<div class="blog-card">
						<div class="blog-card-title"> <span>TIN CÔNG NGHỆ</span><a href="tincongnghe">Xem tất cả...</a></div>
						<div class="row-card-news ">
							<div class="col-img"><img src="/image/news/iphone-12.jpg" alt="..." /></div>
							<div class="col-title"><a href="#">24h công nghệ có gì HOT 6/10: iPhone 12 Pro Max lộ ảnh rõ nét cùng thời điểm mở bán chính thức, chi tiết cụm 5 camera trên Galaxy A72</a></div>
						</div>
						<div class="row-card-news">
							<div class="col-img"><img src="/image/news/vivov20den.jpg" alt="..." /></div>
							<div class="col-title"><a href="#">Vivo V20 Pro 5G phiên bản RAM 8GB lộ ảnh thực tế bên cạnh hộp đựng, thiết kế được xác nhận với cụm 3 camera mặt sau</a></div>
							
						</div>
					</div>

				</div>
			</section>
			<!-- phone list product -->
			<div class="list-product">
				<div class="row-titel">
					<a href="SP noi bat">sản phẩm nổi bật</a>
				</div>
				<div class="row-subtitel">
					@foreach($new_product as $new)
					<div class="col-product" >
						<div class="card-product" align="center">
							<a href="{{route('show',$new->id)}}">
							<img src="/image/product/{{$new->image}}" />
							<p>{{$new->name}}</p>
							<div class="price" >
								<span>{{number_format($new->promotion_price,0,',','.')}}<u>đ</u></span>
								<strong>{{number_format($new->unit_price,0,',','.')}}<u>đ</u></strong>
							</div>
							</a>
							<div class="btn-buynow"><button ><a href="{{route('addtocart',['id'=>$new['id'],'qty'=>1])}}">Mua Ngay</a></button></div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="row" style="margin: 10px auto;">{{$new_product->links('vendor/pagination/bootstrap-4')}}</div>
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
@endsection
	
	
