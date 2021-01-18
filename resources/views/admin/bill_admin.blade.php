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
									<h3>Danh Sách Đơn Hàng <span id="getTotal"></span>
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
										<table id="getbill" class="table">
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
											<tbody style="text-align: center">
												@foreach($bills as $bill)
												<tr>
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