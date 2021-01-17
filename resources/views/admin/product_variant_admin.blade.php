@extends('admin.master-admin')
@section('content')
<script src="/adminjs/jquery2.0.3.min.js"></script>
<script src="js/jquery2.0.3.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
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
									<h3>Danh Sách Sản Phẩm trong kho<span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
										@if(Session::has('thanhcong'))
										<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
										@endif
										@if(Session::has('thatbai'))
										<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
										@endif
										<table id="getProduct" class="table">
											<thead>
												<tr>
													<th>ID</th>
													<th>Tên</th>
													<th>Phiên Bản</th>
													<th>Màu</th>
													<th>Loại Sản Phẩm</th>
													<th>Hãng</th>
													<th>Số Lượng</th>
													<th>Mô Tả</th>
													<th>Giá</th>
													<th>Hình Ảnh</th>
													<th>Sửa Đổi Lần Cuối</th>
													<th>Ngày Thêm</th>
													<th>Ngày Sửa Đổi</th>
													<th>Chức Năng</th>
												</tr>
											</thead>
											<tbody >
												@foreach($product_variants as $product)
												<tr>
													<td>{{$product->id}}</td>
													<td><a href="{{route('show',$product->id_product)}}">{{$product->product->name}}</a></td>
													<td>{{$product->version}}</td>
													<td>{{$product->color}}</td>
													<td>{{$product->product->product_type->name}}</td>
													<td>{{$product->product->company->name}}</td>
													<td>{{$product->quantity}}</td>
													<td width="200px">{{$product->product->description}}</td>
													<td >{{number_format($product->unit_price,0,'','.') }} VNĐ</td>
													<td><img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/{{$product->image->link}}"></td>
													<td>@if($product->last_modified_by_user!=null) 
														{{$product->last_modified_by_user}} - {{$product->user_modified->full_name}} @endif</td>
													<td>{{$product->created_at}}</td>
													<td>{{$product->updated_at}}</td>
													<td style="">

														<form method="post" action="{{route('product.destroy',$product->id)}}">
															@csrf
															@method('DELETE')
															<a href="{{route('product.edit',$product->id)}}"class="btn btn-primary">Sửa</a>
															<input type="submit" class="btn btn-primary" onclick="return confirm('Có xóa {{$product->name}} không?');"value="Xóa">
														</form>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="8"><div align="center">{{$product_variants->links()}}</div></td>
												</tr>
											</tbody>
										</table>

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

@endsection