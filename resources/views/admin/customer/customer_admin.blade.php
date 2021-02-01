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
									<h3>Danh Sách Khách Hàng <span id="getTotal"></span>
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
												<td colspan="9" width="">
													<input type="text" id="searchname" class="form-control"  name="name" placeholder="Search" >
												</td>
												<td colspan="2" width="10%">
													<input type="button" id="search" class="form-control" value="Tìm">
												</td>
												<td colspan="2" width="10%">
													<h3 style="font-size: 25px">
													<select name="sort" id="sort" class="form-control">
														<option value="0">Sắp Xếp</option>
														<option value="1">Nam</option>
														<option value="2">Nữ</option>
														<option value="3">Tên</option>
														<option value="4">Email</option>
														<option value="5">Số Đơn Hàng</option>
													</select>
													</h3>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('customer.index')}}" class="btn btn-primary">Refresh</a>
												</td>
											</tr>
										</table>
										</div>
										<div style="overflow: auto">
										<table  class="table" >
											<thead >
												<tr >
													<th style="text-align: center;">ID</th>
													<th style="text-align: center;">Tên Khách Hàng</th>
													<th style="text-align: center;">Số Điện Thoại</th>
													<th style="text-align: center;">Số Đơn Hàng</th>
													<th style="text-align: center;">Giới Tính</th>
													<th style="text-align: center;">Email</th>
													<th style="text-align: center;">Địa Chỉ</th>
													<th style="text-align: center;">Ghi Chú</th>
													<th style="text-align: center;">Sửa Đổi Lần Cuối Bởi</th>
													<th style="text-align: center;">Ngày Tạo</th>
													<th style="text-align: center;">Ngày Sửa Đổi</th>
													<th style="text-align: center;">Chức Năng</th>
												</tr>
											</thead>
											<tbody id="getCustomer">
												@foreach($customers as $customer)
												<tr style="text-align: center">
													<td>{{$customer->id}}</td>
													<td>{{$customer->name}}</a></td>
													<td>{{$customer->phone_number}}</td>
													<td>{{count($customer->bill)}}</td>
													<td>{{$customer->gender}}</td>
													<td>{{$customer->email}}</td>
													<td>{{$customer->address}} VNĐ</td>
													<td>{{$customer->note}}</td>
													<td>
														@if($customer->last_modified_by_user!=null)
														{{$customer->last_modified_by_user}} - {{$customer->user_modified->full_name}}
														@endif
													</td>
													<td>{{$customer->created_at}}</td>
													<td>{{$customer->updated_at}}</td>
													<td style="">
														<a href="{{route('customer.edit',$customer->id)}}"class="btn btn-primary">Sửa</a>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="12"><div align="center">{{$customers->links()}}</div></td>
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
			$.get('searchcustomer/'+searchname,function(data){
				$("#getCustomer").html(data);
			});
		});
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sortcustomer/'+sort,function(data){
				$("#getCustomer").html(data);
			});
		});
	</script>
	<script src="/admin/js/bootstrap.js"></script>

@endsection