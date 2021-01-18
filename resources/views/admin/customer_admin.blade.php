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
									<h3>Danh Sách Khách Hàng <span id="getTotal"></span>
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
										<table id="getcustomer" class="table" >
											<thead >
												<tr >
													<th style="text-align: center;">ID</th>
													<th style="text-align: center;">Tên Khách Hàng</th>
													<th style="text-align: center;">Số Điện Thoại</th>
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
											<tbody style="text-align: center">
												@foreach($customers as $customer)
												<tr>
													<td>{{$customer->id}}</td>
													<td>{{$customer->name}}</a></td>
													<td>{{$customer->phone_number}}</td>
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