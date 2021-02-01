@extends('master')
@section('title')
	Trang chủ
@endsection
@section('content')
		<section class="contai-grid">
			<!-- slide vs banner trang chủ -->
			<section class="slide-banner">
				<div class="col-slide">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner">
						    @foreach($slides as $key => $slide)
						    <div class="carousel-item @if($key==0) active @endif">
						      <img src="/image/slide/{{$slide->image}}" class="d-block w-100" alt="...">
						    </div>
						    @endforeach
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
						<div class="blog-card-title"> <span>TIN CÔNG NGHỆ</span><a href="{{route('newsindex')}}">Xem tất cả...</a></div>
						@foreach($news as $n)
						<div class="row-card-news ">
							<div class="col-img"><img src="/image/news/{{$n->image}}" alt="..." /></div>
							<div class="col-title"><a href="{{route('shownews',$n->id)}}">{{$n->title}}</a></div>
						</div>
						@endforeach
					</div>

				</div>
			</section>
			<!-- phone list product -->
			<div class="list-product">
				<div class="row-titel">
					<a href="">sản phẩm nổi bật</a>
				</div>
				<div class="row-subtitel">
					@foreach($new_product as $new)
					<div class="col-product" >
						<div class="card-product" align="center">
							<a href="{{route('show',$new->id)}}">
							<img src="/image/product/{{$new->image}}" />
							<p>{{$new->name}}</p>
							@if($new['promotion_price']==0)
							<div class="price"><strong>{{number_format($new['unit_price'], 0, '', '.')}}<u>đ</u></strong></div>
							@else
							<div class="price" style="width: auto"><strong>{{number_format($new['unit_price'], 0, '', '.')}}<u>đ</u> (-{{$new['promotion_price']}}%)</strong>
							</div>
							@endif
							</a>
							<div class="btn-buynow"><a href="{{route('show',$new->id)}}" class="addtocart"><button >Mua Ngay</button></a></div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="list-product">
				<div class="row-titel">
					<a href="">sản phẩm khuyến mãi</a>
				</div>
				<div class="row-subtitel" style="overflow: auto;">
					@foreach($promo_product as $new)
					<div class="col-product" >
						<div class="card-product" align="center">
							<a href="{{route('show',$new->id)}}">
							<img src="/image/product/{{$new->image}}" />
							<p>{{$new->name}}</p>
							@if($new['promotion_price']==0)
							<div class="price"><strong>{{number_format($new['unit_price'], 0, '', '.')}}<u>đ</u></strong></div>
							@else
							<div class="price" style="width: auto"><strong>{{number_format($new['unit_price'], 0, '', '.')}}<u>đ</u> (-{{$new['promotion_price']}}%)</strong>
							</div>
							@endif
							</a>
							<div class="btn-buynow"><a href="{{route('show',$new->id)}}" class="addtocart"><button >Mua Ngay</button></a></div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			<div class="list-product">
				<div class="row-titel">
					<a href="">sản phẩm bán chạy</a>
				</div>
				<div class="row-subtitel" style="overflow: auto;">
					@foreach($hot_product as $new)
					<div class="col-product" >
						<div class="card-product" align="center">
							<a href="{{route('show',$new->id)}}">
							<img src="/image/product/{{$new->image}}" />
							<p>{{$new->name}}</p>
							@if($new['promotion_price']==0)
							<div class="price"><strong>{{number_format($new['unit_price'], 0, '', '.')}}<u>đ</u></strong></div>
							@else
							<div class="price" style="width: auto"><strong>{{number_format($new['unit_price'], 0, '', '.')}}<u>đ</u> (-{{$new['promotion_price']}}%)</strong>
							</div>
							@endif
							</a>
							<div class="btn-buynow"><a href="{{route('show',$new->id)}}" class="addtocart"><button >Mua Ngay</button></a></div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous"></script>
@endsection
	
	
