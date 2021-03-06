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
									<h3>Danh Sách Đơn Hàng <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body" >
									<div class="col-md-12" >
										<div style="overflow: auto">
										@if(Session::has('thanhcong'))
										<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
										@endif
										@if(Session::has('thatbai'))
										<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
										@endif
										<table class="table">
											<tr style="padding-left: 10px">
												<td colspan="9" width="">
													<input type="text" id="searchname" class="form-control"  name="name" placeholder="Search" >
												</td>
												<td colspan="2" width="10%">
													<input type="button" id="search" class="form-control" value="Tìm">
												</td>
												<td colspan="2" width="15%">
													<h3 style="font-size: 25px">
													<select name="sort" id="sort" class="form-control">
														<option value="0">Sắp Xếp</option>
														<option value="1">Đã Giao Hàng</option>
														<option value="2">Chưa Giao Hàng</option>
														<option value="3">Đã Hủy</option>
														<option value="4">Tổng Tiền Giảm</option>
														<option value="5">Tổng Tiền Tăng</option>
													</select>
													</h3>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('bill.index')}}" class="btn btn-primary">Refresh</a>
												</td>
											</tr>
										</table>
										</div>
										<div style="overflow: auto">
										<table  class="table">
											<thead>
												<tr style="text-align: center;">
													<th>ID</th>
													<th>Tên Khách Hàng</th>
													<th>Số Điện Thoại</th>
													<th>ID User</th>
													<th>Ngày Đặt Hàng</th>
													<th>Tổng Tiền</th>
													<th>Hình Thức Thanh Toán</th>
													<th>Ghi Chú</th>
													<th>Sửa Đổi Lần Cuối Bởi</th>
													<th width="150px">Trạng Thái</th>
													<th>Ngày Sửa Đổi</th>
													<th>Chức Năng</th>
												</tr>
											</thead>
											<tbody  id="getBill">
												@foreach($bills as $bill)
												<tr style="text-align: center">
													<td>{{$bill->id}}</td>
													<td>{{$bill->customer->name}}</a></td>
													<td>{{$bill->customer->phone_number}}</td>
													<td>{{$bill->id_user}}</td>
													<td>{{$bill->date_order}}</td>
													<td>{{number_format($bill->total,0,'','.') }} VNĐ</td>
													<td>{{$bill->payment}}</td>
													<td>{{$bill->note}}</td>
													<td>
														@if($bill->last_modified_by_user!=null)
														{{$bill->last_modified_by_user}} - {{$bill->user_modified->full_name}}
														@endif
													</td>
													@if($bill->status==0) 
													<td>
														<div style="color:#6A6A6A;background-color: #FBF405;text-align: center;border-radius: 10px;padding: 3px"><b>Chưa Giao Hàng</b></div>
													</td>
													@elseif ($bill->status==2)
													<td >
														<div style="color:#6A6A6A;background-color: #48FB05;text-align: center;border-radius: 10px;padding: 3px"><b>Đã Giao Hàng</b></div>
													</td>
													@elseif ($bill->status==1)
													<td >
														<div style="color:#6A6A6A;background-color: red;text-align: center;border-radius: 10px;padding: 3px"><b>Đã Hủy</b></div>
													</td>
													@endif
													
													<td>{{$bill->updated_at}}</td>
													<td style="">
														<a href="{{route('bill.edit',$bill->id)}}"class="btn btn-primary">Sửa</a>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="12"><div align="center">{{$bills->links()}}</div></td>
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
			$.get('searchbill/'+searchname,function(data){
				$("#getBill").html(data);
			});
		})
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sortbill/'+sort,function(data){
				$("#getBill").html(data);
			});
		});
</script>

@endsection