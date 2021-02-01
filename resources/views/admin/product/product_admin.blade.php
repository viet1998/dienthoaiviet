@extends('admin.master-admin')
@section('content')

<script src="/admin/js/jquery2.0.3.min.js"></script>
<script src="/admin/js/raphael-min.js"></script>
<script src="/admin/js/morris.js"></script>
	<section id="container">
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Danh Sách Sản Phẩm <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
										<div style="overflow: auto">
										@if(Session::has('thanhcong'))
										<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
										@endif
										@if(Session::has('thatbai'))
										<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
										@endif
										</div>
										<div style="overflow: auto">
										<table class="table">
											<tr style="padding-left: 10px">
												<td colspan="7" width="">
													<input type="text" id="searchname" class="form-control"  name="name" placeholder="Search" >
												</td>
												<td colspan="2" width="10%">
													<input type="button" id="search" class="form-control" value="Tìm">
												</td>
												<td colspan="2" width="15%">
													<h3 style="font-size: 25px">
													<select name="sort" id="sort" class="form-control">
														<option value="0">Sắp Xếp</option>
														<option value="1">Tên</option>
														<option value="2">Loại</option>
														<option value="3">Hãng</option>
														<option value="4">Giá Tăng</option>
														<option value="5">Giá Giảm</option>
														<option value="6">Không Khuyến Mãi</option>
														<option value="7">Khuyến Mãi Giảm</option>
														<option value="8">Mới</option>
														<option value="9">Cũ</option>
														<option value="10">Ngày Tạo</option>
														<option value="11">Ngày Sửa Đổi</option>
													</select>
													</h3>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('product.index')}}" class="btn btn-primary">Thêm Loại</a>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('product.index')}}" class="btn btn-primary">Thêm Hãng</a>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('product.index')}}" class="btn btn-primary">Refresh</a>
												</td>
											</tr>
										</table>
										</div>
										<div style="overflow: auto">
										<table  class="table" >
											<thead>
												<tr>
													<th>ID</th>
													<th>Tên</th>
													<th>Loại Sản Phẩm</th>
													<th>Hãng</th>
													<th>Mô Tả</th>
													<th>Giá</th>
													<th>Khuyến Mãi</th>
													<th>Hình Ảnh</th>
													<th>Trạng Thái Mới</th>
													<th>Sửa Đổi Lần Cuối</th>
													<th>Ngày Tạo</th>
													<th>Ngày Sửa Đổi</th>
													<th>Chức Năng</th>
												</tr>
											</thead>
											<tbody id="getProduct">
												@foreach($products as $product)
												<tr>
													<td>{{$product->id}}</td>
													<td><a href="{{route('show',$product->id)}}" target="_blank">{{$product->name}}</a></td>
													<td>{{$product->product_type->name}}</td>
													<td>{{$product->company->name}}</td>
													<td width="200px"><?php echo $product->description; ?></td>
													<td >{{number_format($product->unit_price,0,'','.') }} VNĐ</td>
													<td>{{$product->promotion_price}}</td>
													<td >
														@foreach($product->images as $image)
														<img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/{{$image->link}}">
														@endforeach
													</td>
													<td>{{$product->new}}</td>
													<td>
														{{$product->last_modified_by_user}} - {{$product->user_modified->full_name}} 
													</td>
													<td>{{$product->created_at}}</td>
													<td>{{$product->updated_at}}</td>
													<td style="width: 160px">

														<form method="post" action="{{route('product.destroy',$product->id)}}">
															@csrf
															@method('DELETE')
															<a href="{{route('product.edit',$product->id)}}"class="btn btn-primary"><span class="glyphicon glyphicon-edit white"></span></a>
															<a href="{{route('product.createvariant',$product->id)}}"class="btn btn-success">
																<span class="glyphicon glyphicon-plus white"></span>
															</a>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Có xóa {{$product->name}} không?');" ><span class="glyphicon glyphicon-remove white"></span></button>
														</form>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="8"><div align="center">{{$products->links()}}</div></td>
												</tr>
											</tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
				<!--//agileinfo-grap-->
				</div>
			</div>
		</div>
		
		
	</section>
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <!-- <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p> -->
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="/admin/js/bootstrap.js"></script>
<script src="/admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/admin/js/scripts.js"></script>
<script src="/admin/js/jquery.slimscroll.js"></script>
<script src="/admin/js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="/admin/js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	

<!-- script đồ thị -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
		$("#search").on('click',function(){
			console.log();
			document.getElementById("sort").selectedIndex = 0;
			var searchname=document.getElementById("searchname").value;
			if(searchname === "") {searchname="null";}
			$.get('searchproduct/'+searchname,function(data){
				$("#getProduct").html(data);
			});
		})
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sortproduct/'+sort,function(data){
				$("#getProduct").html(data);
			});
		});
	</script>
<style type="text/css">
	.white {
		color: white;
	}
</style>

@endsection
