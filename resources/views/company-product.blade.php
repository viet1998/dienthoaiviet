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
					<a href="{{route('apple_smartphone')}}"><img src="/image/logo/iphone-apple.jpg" /></a>
				</div>
				<div class="column">
					<a href="{{route('samsung_smartphone')}}"><img src="/image/logo/samsung.jpg" /></a>
				</div>
				<div class="column">
					<a href="{{route('oppo_smartphone')}}"><img src="/image/logo/oppo42.png" /></a>
				</div>
				<div class="column">
					<a href="{{route('xiaomi_smartphone')}}"><img src="/image/logo/xiaomi42.jpg" /></a>
				</div>
				<div class="column">
					<a href="{{route('vivo_smartphone')}}"><img src="/image/logo/vivo42.jpg" /></a>
				</div>
				<div class="column">
					<a href="{{route('realme_smartphone')}}"><img src="/image/logo/realme42.png" /></a>
				</div>
				<div class="column">
					<a href="{{route('oneplus_smartphone')}}"><img src="/image/logo/oneplus42.jpg" style="height: 86%;" /></a>
				</div>
			</div>
		</section>
	<!--  bộ lọc  -->
		<section class="filter-price bg-light">
			<div class="column">
			<p>Chọn mức giá:</p>
			</div>
			<div class="column">
				<a id="all-2" href="#" onclick="getFilter(0,2000000)">Dưới 2 triệu</a>
			</div>
			<div class="column" >
				<a id="2-4" href="#" onclick="getFilter(2000000,4000000)">Từ 2 - 4 triệu</a>
			</div>
			<div class="column" >
				<a id="4-7" href="#" onclick="getFilter(4000000,7000000)">Từ 4 - 7 triệu</a>
			</div>
			<div class="column" >
				<a id="7-13" href="#" onclick="getFilter(7000000,13000000)">Từ 7 - 13 triệu</a>
			</div>
			<div class="column" >
				<a id="13-all" href="#" onclick="getFilter(13000000,1000000000)">Trên 13 triệu</a>
			</div>		
		</section>

	<!-- danh sách điện thoại nổi bật nhất -->
	<section class="list-listphone">
		<div class="title-lpd">
			<span>Điện Thoại - {{$company->name}}</span>
		</div>
		<div class="col-listphone" id="product">
			@foreach($products as $product)
			<div class="card-listphone" align="center">
				<a href="{{route('show',$product['id'])}}">
				<img src="/image/product/{{$product['image']}}" />
				<p>{{$product['name']}}</p>
				@if($product['promotion_price']==0)
				<div class="price"><strong>{{number_format($product['unit_price'], 0, '', '.')}}<u>đ</u></strong></div>
				@else
				<div class="price" style="width: auto"><strong>{{number_format($product['unit_price'], 0, '', '.')}}<u>đ</u> (-{{$product['promotion_price']}}%)</strong>
				</div>
				@endif
				<div class="btn-buynow"><a href="{{route('show',$product->id)}}" class="addtocart"><button >Mua ngay</button></a></div>
				</a>
			</div>
			@endforeach
		</div>		
	</section>
	</section>
<script type="text/javascript">
	function getFilter(from,to){
		var id= <?php echo $company->id; ?>;
		$.get('dtdd/filter/'+id+'/'+from+'/'+to,function(data){
			$("#product").html(data);
		});
	}
</script>
@endsection
