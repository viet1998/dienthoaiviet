<!DOCTYPE html>
<html>
<head>
	<title>San pham</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!-- java script -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="/js/gallery-product.js"></script>
	 --><!-- link CSS -->
	<link rel="stylesheet" type="text/css" href="/css/layout-product.css">
	<link rel="stylesheet" type="text/css" href="/css/navbar-footer.css">
</head>
<body>
	<!-- phần nội dung -->
	<section class="container-body">

		<div class="grid">
			<!-- row 2 thông tin sản phẩm -->
			<div class="main">
				<div class="item-1">
						@foreach($product->images as $pv)
						<div class="mySlides">
							<img src="/image/product/{{$pv['link']}}" />
						</div>
						@endforeach
					<a class="prev" onclick="plusSlides(-1)"> ❮ </a>
					<a class="next" onclick="plusSlides(1)"> ❯ </a>
					<div class="caption-container">
					    <div class="row-gar">
					    	<?php $num=0; ?>
						    @foreach($product->images as $pv)
						    <div class="column">
						    <img class="demo cursor" src="/image/product/{{$pv['link']}}" style="width:100%" onclick="currentSlide(<?php $num++; echo $num; ?>)" />
						    </div>
							@endforeach
					 	 </div>
					</div>
				</div>
				<!-- phan noi dung san pham ten vs gia -->
				<div class="item-2">
					<form method="get" action="{{route('addtocart')}}">
					@csrf
					<!-- tên sản phẩm -->
					<h3><strong> {{$product["name"]}}</strong></h3>
					<!-- giá sản phẩm -->
					<p style="color: #f00;"><strong id="product_price"><span id="variant_price">{{number_format($product["unit_price"],0,'','.')}}</span><u>đ</u> (-{{$product["promotion_price"]}}%)</strong></p>
					<p>Phiên Bản - Màu: 
						<select name="id_product_variant" id="id_product_variant">
							@foreach($product_variant as $pv)
							<option value="{{$pv->id}}">
								{{$pv->version}} - {{$pv->color}}
							</option>
							@endforeach
						</select>
					</p>

					<div class="btn-buynow"><button type="submit" style="color:white;">Mua ngay</button></div>
					</form>
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
						</div>
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
				<!-- Phaanr chuyen huong -->
				<div class="item-3">
					<div class="banner">
						<a href="1"><img src="/image/slide/banner1.png" alt="" /></a>
						<a href="2"><img src="/image/slide/banner2.png" alt="" /></a>
						<a href="3"><img  src="/image/slide/banner3.png" alt="" /></a>
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
							<img src="/image/icon/chedobaohanh.png" alt="" />
							<p>Sửa chữa bảo hành theo chính sách hiện hành của hãng sản xuất</p>
							<p><strong>THÔNG TIN BẢO HÀNH CAO CẤP</strong></p>
							<button class="btn btn-warning" >Xem chi tiết</a></button>
						</div>
					</div>
				</div>
			</div>
				<!-- phan mo ta -->
			<div class="row-desc card">
					<div class=" row-desc-title">
						<div class="card-header">Mô tả</div>
						<div class="card-body">
						<?php echo $product['description']; ?>
						</div>
					</div>
			</div>

	</section>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
			
		});
								
	</script>	
		<!-- row 3 phần thông tin địa chỉ v...vvv -->
		@include('footer')
	
		<!-- phầm navbar -->
		@include('navbar')
		
