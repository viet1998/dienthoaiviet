@extends('admin.master-admin')
@section('content')
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
		font-family: sans-serif;
	}
	.container{ width: 1050px; margin: 0 auto; }
	.row-title{ width: 100%; background-color: #333; margin-bottom: 5px; border-radius: 5px;}
	.row-title ul{  display: flex; height: 26px; }
	.row-title ul li{ text-align: center; list-style-type: none;color: #fff; font-weight: bold; margin: auto 0; }
	.col1{width:35px;}
	.col2{width: 120px;}
	.col2 img{width: 100%; margin-top:5px; border-radius: 5px;}
	.col3{ width: 200px; border-right: 1px solid #fff;}
	.col4{ width: 200px; }
	.col5{ width: 80px; }
	.col6{ width: 100px; }
	.col7{ width: 50px; }
	.col8{ width: 100px; }
	.col{ padding: 0 10px; }
	.row-sub { list-style-type: none; background-color: #f0f0f0; margin-bottom: 2px;
	 border-radius: 10px ;}
	.row-sub ul{list-style-type: none; display: flex; text-align: center;}
	.row-sub ul li{ margin: auto 0; }
	.glyphicon-wrench {font-size: 14px; color: #fff;}
	h2{ margin: 10px; }

	/*.row-title ul li{ background-color: #00CC33; display: inline-block;}

	.row-sub ul { display: flex; }*/
</style>
<script src="/adminjs/jquery2.0.3.min.js"></script>
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>

	<section class="container">
		<section id="main-content">
			<section class="wrapper">
				<div class="row">
			<div class="panel-body">
		<h2 style="text-align: center; background-color: #9999CC; border-top-right-radius: 20px; border-bottom-left-radius: 20px; color: #fff; padding: 10px 0; "><b>DANH SÁCH SẢN PHẨM</b></h2>
		<div class="row">
			<form style="margin-left: 20px;" role="search" method="get" id="searchform" action="">
					        <input type="text" value="" name="key" id="key" placeholder="Nhập từ khóa..." />
					        <button class="btn-info" type="submit" ><i class="fa fa-search"></i></button>
				</form>
		</div>
		@if(Session::has('flag'))
						<div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
					@endif
		<div class="row-title">
			<ul>
				<li class="col1">STT</li>
				<li class="col2">HÌNH ẢNH</li>
				<li class="col3">TÊN SẢN PHẨM</li>
				<li class="col4">MÔ TẢ</li>
				<li class="col5">GIÁ BÁN</li>
				<li class="col6">GIÁ SALE</li>
				<li class="col7">ĐƠN VỊ</li>
				<li class="col8">NGÀY NHẬP</li>
				<li class="col"></li>
				<li class="col"></li>

			</ul>
		</div>
			@foreach($products as $pdt)
		<div class="row-sub">
			<ul>
				<li class="col1">{{$pdt->id}}</li>
				<li class="col2"><a href="{{action([App\Http\Controllers\ProductController::class, 'show'] ,$pdt['id'])}}"><img src="/source/image/product/{{$pdt->image}}" /></a></li>
				<li class="col3">{{$pdt->name}}</li>
				<li class="col4">{{$pdt->description}}</li>
				<li class="col5">{{number_format($pdt->unit_price,0,',','.')}}<u>đ</u></li>
				<li class="col6">{{number_format($pdt->promotion_price,0,',','.')}}<u>đ</u></li>
				<li class="col7">{{$pdt->unit}}</li>
				<li class="col8	">{{$pdt->created_at}}</li>
				<li class="col"><button class="btn btn-warning"><a href="{{action([App\Http\Controllers\ProductController::class, 'edit'], $pdt['id']) }}"><i class="glyphicon glyphicon-wrench"></i></a></button></li>
				<li class="col">
				<form action="{{action([App\Http\Controllers\ProductController::class, 'destroy'], $pdt['id']) }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="DELETE">
					<button class="btn btn-danger" value="PATCH" id="xoa" type="submit" ><i class="	glyphicon glyphicon-trash"></i></a></button>
				</form>
				</li>

			</ul>
		</div>
			@endforeach
		
		<div class="row" style=" text-align: center; margin: 20px;">{{$products->links('vendor.pagination.bootstrap-4')}}</div>
	</div>
</div>
	</section>
	</section>

	<section>
	 <!-- footer -->
			  <div class="footer">
				<div class="wthree-copyright">
				  <!-- <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p> -->
				</div>
			  </div>
	  <!-- / footer -->
	</section>
</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
		$("document").ready(function(){
		$("button#xoa").click(function(){
			return confirm("Bạn có thực sự muốn xóa?");
		});
	});
</script>
@endsection