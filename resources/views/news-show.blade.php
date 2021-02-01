@extends('master')
@section('content')
<!-- phần nội dung -->
<style type="text/css">

	.news-item-3 img{ width: 100%; }
	@media only screen and (max-width: 1024px){
		.news-item-3{ display: none; }

	}
	@media only screen and (max-width: 736px){
		.title-show-new span{ font-size: 25px;}

	}
</style>
<section class="contai-grid">
	<div class="top-130">
		<div class="" style="font-size: 16px; display: flex;">
			<div class="col-12 col-md-8 col-lg-9">
				<div class="card bg-light" style="padding:0px;text-align: left;width: 100%;">
					<span style="background-image: url('/image/news/{{$news->image}}');width: 100%;padding: 10%;background-repeat: no-repeat;background-size: 100%; overflow: hidden; ">
						<span class="title-show-new"  style="font-size: 30px;color: white;font-weight: bold;margin-top: 500px;text-shadow: 3px 3px #222222;">
							<h0 align="left">{{$news->title}}</h0>
						</span><br>
					</span>
					<div class="" style="font-size: 15px;color: #B4B4B4;font-weight: bold;margin-bottom: 0px;float: left;">
						{{$news->user->full_name}}. {{date('Y-m-d',strtotime($news->created_at))}}
					</div>
					<div class="content-new" style="margin:0px;width: 100% ;overflow: auto;">
						<?php echo $news->content ?>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-3 news-item-3">
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
						<button class="btn btn-warning" style="font-size: 16px;"><a href="#">Xem chi tiết</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection