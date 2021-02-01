@extends('master')
@section('content')
<!-- phần nội dung -->
<section class="contai-grid" style="font-size: 14px;">
		<div style="margin-left: 0; margin-right: 0;" class=" row top-130">
			<div class="col-12 col-sm-8 col-md-6 col-lg-4 item-1 ">
				@if(count($product->images)!=0)
				@foreach($product->images as $pv)
				<div class="mySlides">
					<img src="/image/product/{{$pv['link']}}" style="height:300px"/>
				</div>
				@endforeach
				@else
				<div class="mySlides">
					<img src="/image/product/{{$product->image}}" style="height:300px"/>
				</div>
				@endif
						<a class="prev" onclick="plusSlides(-1)">  </a>
						<a class="next" onclick="plusSlides(1)"> <i class="fas fa-angle-rigth"></i> </a>
				<div class="caption-container">
					<div class="row-gar">
						@if(count($product->images)!=0)
					    <?php $num=0; ?>
					    @foreach($product->images as $pv)
						<div class="column">
					    <img class="demo cursor" src="/image/product/{{$pv['link']}}" style="width:100%;height:50px" onclick="currentSlide(<?php $num++; echo $num; ?>)" />
					    </div>
						@endforeach
						@else
						<div class="column">
					    <img class="demo cursor" src="/image/product/{{$product->image}}" style="width:100%;height:50px" onclick="currentSlide(0)" />
					    </div>
						@endif

					</div>
				</div>
			</div>
			<!-- phan noi dung san pham ten vs gia -->
			<div class="col-12 col-sm-4 col-md-6 col-lg-5 col-md-6">
					<form method="get" action="{{route('addtocart')}}">
					@csrf
					<!-- tên sản phẩm -->
					<h2><strong> {{$product["name"]}}</strong></h2>
					<!-- giá sản phẩm -->
					<p style="color: #f00; font-size: 16px;">
						<strong id="product_price">
							<span id="variant_price">
								{{number_format(($product["unit_price"]*(100-$product["promotion_price"])/100),0,'','.')}}<u>đ</u> (-{{$product["promotion_price"]}}%) <strike>{{number_format($product["unit_price"],0,'','.')}}<u>đ</u></strike>
							</span>
						</strong>
					</p>
					<p >Phiên Bản - Màu: 
						<select name="id_product_variant" id="id_product_variant" >
							@foreach($product_variant as $pv)
							<option value="{{$pv->id}}">
								{{$pv->version}} - {{$pv->color}}
							</option>
							@endforeach
						</select>
					</p>
					<!-- <div class="for_slick_slider multiple-items">
						<div class="items">
							<label for="a1">
							<p><input type="radio" name="other_price" id="a1">
							64GB</p>
							20.000.000<u>đ</u></p></label>
						</div>
						<div class="items" >
							<label for="a2">
							<p><input type="radio" name="other_price" id="a2">
							128GB</p>
							23.000.000<u>đ</u></p></label>
						</div>
						<div class="items">
							<label for="a3">
							<p><input type="radio" name="other_price" id="a3">
							156GB</p>
							26.000.000<u>đ</u></p></label>
						</div>
						<div class="items">
							<label for="a4">
							<p><input type="radio" name="other_price" id="a4">
							Khác</p>
							xx.xxx.000<u>đ</u></p></label>
						</div>
					</div> -->
					<div class="btn-buynow" id="clickbuy"><button type="submit" >Mua ngay <i class="fas fa-cart-plus"></i></button></div>
					
					<div class="btn-messbox"><button ><a href="https://www.facebook.com/thanhviet781998">Nhắn tin qua <strong style="font-weight: bold;">facebook</strong></a></button></div>
					<!-- Khuyến mãi -->
					<div class="card bg-light" style="padding: 10px;">
						<h3><strong style="color: #ff0000">Khuyến mãi</strong></h3>
						<div><i class="icon-km"><img src="/image/icon/tick.png"></i>giảm giá 1.500.000<u>đ</u></div>
						<div><i class="icon-km"><img src="/image/icon/tick.png"></i>Mua online thêm quà: Giảm giá 500,000đ (Không áp dụng kèm Thu cũ đổi mới)</div>
						<div><i class="icon-km"><img src="/image/icon/tick.png"></i>Pin sạc dự phòng giảm 30% khi mua kèm.</div>
					</div></br>
					<!-- card mở rộng thông tin nội dung -->
					<div class="card">
						<div class="card-header btn"  data-toggle="collapse" data-target="#noidungcard"> BẢO HÀNH VÀ CAM KẾT
						<i class="fas fa-angle-down"></i></div>
						<div class="card-body bg-light collapse"  data-toggle="collapse"  aria-expanded="false" id="noidungcard">
							<p class="text">Giá tốt nhất - Ở đâu rẻ hơn hoàn tiền</p>
							<p class="text">Máy chưa hề sửa chữa</p>
							<p class="text">Bảo hành 12 tháng tận nhà</p>
							<p class="text">Dùng thử 01 tháng miễn phí</p>
							<p class="text">Cài win, vệ sinh miễn phí</p>
							<p class="text">Trả góp lãi suất 0% với thẻ tín dụng</p>
							<p class="text">Lãi suất 1% khi trả góp thường</p>
							<p class="text">Chỉ cần CMND & Bằng lái xe</p>
							<p class="text">Ship COD toàn quốc - OK mới thanh toán.</p>
							<p class="text">Mua Online liên hệ: 0777.126.126</p>
						</div>
					</div>
			</div>
				<!-- Phaanr quang cao -->
			<!-- Phaanr quang cao -->
			<div class="col-12 col-lg-3 col-md-4 item-3">
					<div class="banner">
						@foreach($slides as $slide)
						<a href="1"><img src="/image/slide/{{$slide->image}}" alt="" /></a>
						@endforeach
					</div>
					<div class="extend">
						<div class="extend-titel">
							<span>Chế độ bảo hành</span>
						</div>
						<div class="subex-titel">
							<span>Bảo hành chính hãng</span>
							<div class="border">
							<p>1 đổi 1, 15 ngày</p>
							<p>Bảo hành 12 tháng</p>
							<p>Xử lý trong 30 ngày</p>
							</div>
							<img style="padding: 6px;" src="/image/icon/chedobaohanh.png" alt="" />
							<p>Sửa chữa bảo hành theo chính sách hiện hành của hãng sản xuất</p>
							<p><strong>THÔNG TIN BẢO HÀNH CAO CẤP</strong></p>
							<button class="btn btn-warning" style="font-size: 16px;">Xem chi tiết</a></button>
						</div>
					</div>
			</div>
		</div>
		<div class="row-desc" style="padding: 0;">
					<div class="row-desc-title">
						<div class="card-header"><h2>Mô tả</h2></div>
						<div class="card-body">
						<?php echo $product['description']; ?>
						</div>
					</div>
			</div>
		
	</section>
	<script>
	var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  var dots = document.getElementsByClassName("demo");
	  var captionText = document.getElementById("caption");
	  if (n > slides.length) {slideIndex = 1}
	  if (n < 1) {slideIndex = slides.length}
	  for (i = 0; i < slides.length; i++) {
	      slides[i].style.display = "none";
	  }
	  for (i = 0; i < dots.length; i++) {
	      dots[i].className = dots[i].className.replace(" active", "");
	  }
	  slides[slideIndex-1].style.display = "block";
	  dots[slideIndex-1].className += " active";
	}
									
		$("#id_product_variant").on('change',function(e){
			console.log(e);
			var id= e.target.value;
			$.get('getbonusprice/'+id,function(data){
				$("#variant_price").html(data);
			});
			$.get('checkoutofstock/'+id,function(data){
				$("#clickbuy").html(data);
			});
		});
								
	</script>	
	<!-- slick giá cấu hình -->
	<link rel="stylesheet" type="text/css" href="/css/slick.css">
	<script type="text/javascript" src="/js/slick.min.js"></script>
	<!-- <script type="text/javascript">
		$(function (){
			$('.multiple-items').slick({
			  infinite: true,
			  slidesToShow: 3,
			  slidesToScroll: 1,
			});
		});
	</script> -->	
@endsection