
@if(Session::has('flag'))
	@if(Session::get('flag')=='admin_danger')
	 	<?php
			echo '<script type="text/javascript"> window.alert("'.Session::get('thongbao').'"); </script>';
		?>
  	@endif
  	@endif
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
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Tổng Số</h4>
					<h3>{{$products_count}}</h3>
					<p>Sản Phẩm</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Thành viên</h4>
						<h3>{{$users_count}}</h3>
						<p>Tổng người dùng</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Đã bán</h4>
						<h3>{{$bills_count}}</h3>
						<p>Đơn dàng đã bán ra</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Đơn hàng</h4>
						<h3>{{$newbills_count}}</h3>
						<p>Đơn hàng mới</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" style="overflow: auto">
					<div class="panel-heading">
						Thống Kê Doanh Thu <span id="getTotal"></span>
						<div style="float:right">
							<select id="dateselect" class="form-control" style="font-size: 17px">
								<option value="90">Quý</option>
								<option value="30">Tháng</option>
								<option value="365">Năm</option>
								<option value="400">Tháng Trước</option>
								<option value="401">Năm Trước</option>
							</select>
						</div>
					</div>
						
					<div class="panel-body">
						<div class="col-md-12 no-padding">
								<div class="canvas-wrapper" style="width: 100%">
									<div id="stats-container" style="height: 250px;"></div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Thống Kê Truy Cập
					</div>
						
					<div class="panel-body">
						<div class="col-md-12 no-padding">
								<table class="table table-bordered table-dark" style="width: 100%">
									<thead>
										<tr>
											<td scope="col">Truy Cập Mới Hôm Nay</td>
											<td scope="col">Tổng tháng trước</td>
											<td scope="col">Tổng tháng này</td>
											<td scope="col">Tổng một năm</td>
											<td scope="col">Tổng truy cập</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{$visitor_count[0]}}</td>
											<td>{{$visitor_count[1]}}</td>
											<td>{{$visitor_count[2]}}</td>
											<td>{{$visitor_count[3]}}</td>
											<td>{{$visitor_count[4]}}</td>
										</tr>
									</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Tình Trạng Đơn Hàng
						</div>
						
					<div class="panel-body">
						<div class="col-md-12 no-padding" >
							<div class="row progress-labels" style="width: 100%">
								<div class="col-sm-6">Đơn Hàng Đã Giao</div>
								<div class="col-sm-6" style="text-align: right;">{{round($chart_bill[0])}}%</div>
							</div>
							<div class="progress" style="width: 100%">
								<div data-percentage="0%" style="width: {{round($chart_bill[0])}}%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="row progress-labels" style="width: 100%">
								<div class="col-sm-6">Đơn Hàng Chưa Giao</div>
								<div class="col-sm-6" style="text-align: right;">{{round($chart_bill[1])}}%</div>
							</div>
							<div class="progress" style="width: 100%">
								<div data-percentage="0%" style="width: {{round($chart_bill[1])}}%;" class="progress-bar progress-bar-orange" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="row progress-labels" style="width: 100%">
								<div class="col-sm-6">Đơn Hàng Đã Hủy</div>
								<div class="col-sm-6" style="text-align: right;">{{round($chart_bill[2])}}%</div>
							</div>
							<div class="progress" style="width: 100%">
								<div data-percentage="0%" style="width: {{round($chart_bill[2])}}%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default ">
					<div class="panel-heading">
						Đơn Hàng Mới
					</div>
					<div class="panel-body">
						<div class="col-md-12" style="overflow: auto">
							<table class="table" style="width: 100%"> 
								<thead>
								<tr>
									<th>ID</th>
									<th>Tên Khách Hàng</th>
									<th>Ngày Đặt Hàng</th>
									<th>Tổng Tiền</th>
									<th>Số Điện Thoại</th>
									<th >Tình Trạng</th>
								</tr>
								</thead>
								<tbody id="getProduct">
									@foreach($bills as $key => $bill)
									<tr>
										<td>{{$bill->id}}</td>
										<td>{{$bill->customer->name}}</a></td>
										<td>{{$bill->date_order}}</td>
										<td>{{number_format($bill->total,0,'','.')}} VNĐ</td>
										<td>{{$bill->customer->phone_number}}</td>
										@if($bill->status==0) 
										<td><span class="label label-warning">Chưa Giao Hàng</span></td>
										@elseif ($bill->status==2)
										<td ><span class="label label-success">Đã Giao Hàng</span></td>
										@elseif ($bill->status==1)
										<td ><span class="label label-danger">Đã Hủy</span></td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="panel panel-default ">
					<div class="panel-heading">
						Sảm Phẩm Mới</div>
					<div class="panel-body">
						<div class="col-md-12 no-padding" style="overflow: auto">
							<table class="table" style="width: 100%"> 
								<thead>
								<tr>
									<th>ID</th>
									<th>Tên</th>
									<th>Loại</th>
									<th>Hãng</th>
									<th>Hình Ảnh</th>
									<th>Giá</th>
								</tr>
								</thead>
								<tbody id="getProduct">
									@foreach($product_news as $key => $product)
									<tr>
										<td>{{$product->id}}</td>
										<td>{{$product->name}}</td>
										<td>{{$product->product_type->name}}</td>
										<td>{{$product->company->name}}</td>
										<td><img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/{{$product->image}}"></td>
										<td>{{$product->unit_price}}</td>
										
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>


			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Top 5 Sản Phẩm Bán Chạy
					</div>
					<div class="panel-body" style="overflow: auto">
						<table id="getProduct" class="table" style="width: 100%">
										<thead>
										<tr>
											<th>ID</th>
											<th>Tên</th>
											<th>Phiên Bản</th>
											<th>Màu</th>
											<th>Hình Ảnh</th>
											<th>Số Lượng Bán</th>
										</tr>
										</thead>
										<tbody >
										@foreach($products as $product)
										<tr>
											<td>{{$product->id}}</td>
											<td><a href="{{route('show',$product->id)}}">{{$product->product->name}}</a></td>
											<td>{{$product->version}}</td>
											<td>{{$product->color}}</td>
											<td><img style="width:80px;height:80px;vertical-align: middle;" src="/image/product/{{$product->image->link}}"> </td>
											<td>{{$product->product_count}}</td>
										</tr>
										@endforeach
										</tbody>
							</table>
					</div>
				</div><!-- /.panel-->
				<div class="panel panel-default ">
					<div class="panel-heading" style="overflow: auto">
						Khách Hàng Mua Nhiều
					</div>
					<div class="panel-body">
						<div class="col-md-12 no-padding" style="overflow: auto">
							<table id="getProduct" class="table" style="width: 100%">
								<thead style="width: 100%">
								<tr >
									<th>ID</th>
									<th>Tên Khách Hàng</th>
									<th>Email</th>
									<th>Địa Chỉ</th>
									<th>Điện Thoại</th>
									<th>Số Đơn Hàng</th>
									<th>Tiền Đã Mua</th>
								</tr>
								</thead>
								<tbody style="width: 100%">
								@foreach($customers as $customer)
								<tr>
									<td >{{$customer->id}}</td>
									<td>{{$customer->name}}</a></td>
									<td >{{$customer->email}}</td>
									<td >{{$customer->address}} </td>
									<td>{{$customer->phone_number}}</td>
									<td>{{$customer->bills_count}}</td>
									<td>{{number_format($customer->totalpaid)}} VNĐ</td>
									
								</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div>
				
		
	
		
			<div class="clearfix"> </div>
			<!-- tasks -->
			
		<!-- //tasks -->
		<div class="agileits-w3layouts-stats">
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">thống kê hãng</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled" style="width: 100%">
									<li>Apple<span class="pull-right">{{($brand_data[1]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:{{($brand_data[1]*100)/$total}}%;"></div> 
										</div>
									</li>
									<li>Samsung<span class="pull-right">{{($brand_data[2]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:{{($brand_data[2]*100)/$total}}%;"></div>
										</div>
									</li>
									<li>Oppo<span class="pull-right">{{($brand_data[3]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:{{($brand_data[3]*100)/$total}}%;"></div>
										</div>
									</li>
									<li>Xiaomi<span class="pull-right">{{($brand_data[4]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:{{($brand_data[4]*100)/$total}}%;"></div>
										</div>
									</li>
									<li>Vivo<span class="pull-right">{{($brand_data[5]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:{{($brand_data[5]*100)/$total}}%;"></div>
										</div>
									</li>
									<li>Realme <span class="pull-right">{{($brand_data[6]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar orange" style="width:{{($brand_data[6]*100)/$total}}%%;"></div>
										</div>
									</li>
									<li class="last">Oneplus <span class="pull-right">{{($brand_data[7]*100)/$total}}%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar orange" style="width:{{($brand_data[7]*100)/$total}}%%;"></div>
										</div>
									</li> 
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<div class="stats-last-agile">
							<table class="table stats-table ">
								<thead>
									<tr>
										<th>Tên Bảng</th>
										<th>ID Item</th>
										<th>Người Thay Đổi</th>
										<th>Phương Thức</th>
										<th>Ngày Thay Đổi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($histories as $history)
									<tr>
										<td>{{$history->table_change}}</td>
										<td>{{$history->id_item}}</td>
										<td>{{$history->id_user}} - {{$history->user->full_name}}</td>
										<td>{{$history->method}}</td>
										<td>{{$history->date_change}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
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
	$(function() {

	  // Create a function that will handle AJAX requests
	  function requestTotal(days){
	    $.ajax({
	      type: "GET",
	      dataType: 'html',
	      url: "./tinhtongtien", // This is the URL to the API
	      data: { days: days }
	    })
	    .done(function( data ) {
	      // When the response to the AJAX request comes back render the chart with new data
	      $("#getTotal").html(data);
	      
	    })
	    .fail(function() {
	      // If there is no communication between the server, show an error
	      alert( "không thấy tổng tiền được" );
	    });
	  }
	  function requestData(days, chart){
	    $.ajax({
	      type: "GET",
	      dataType: 'json',
	      url: "./thongkedoanhthu", // This is the URL to the API
	      data: { days: days }
	    })
	    .done(function( data ) {
	      // When the response to the AJAX request comes back render the chart with new data
	      chart.setData(data);

	    })
	    .fail(function() {
	      // If there is no communication between the server, show an error
	      alert( "không lấy dữ liệu được" );
	    });
	  }

	  var chart = new Morris.Bar({
	    // ID of the element in which to draw the chart.
	    element: 'stats-container',
	    data: [0, 0], // Set initial data (ideally you would provide an array of default data)
	    xkey: 'date_order', // Set the key for X-axis
	    ykeys: ['tongtien'], // Set the key for Y-axis
	    labels: ['Doanh Thu'] // Set the label when bar is rolled over
	  });

	  // Request initial data for the past 7 days:
	  requestData(90, chart);
	  requestTotal(90);
	  $("#dateselect").on('change',function(e){
	  	console.log(e);
		var days= e.target.value;
		requestData(days, chart);
		requestTotal(days);
	  })
	  
	});
	$("#search").on('click',function(){
		console.log();
		var searchname=document.getElementById("searchname").value;
		$.get('timkhachhang/'+searchname,function(data){
			$("#getProduct").html(data);
		});
	})
	$("#sort").on('change',function(e){
		console.log(e);
		var sort= e.target.value;

		$.get('lockhachhang/'+sort,function(data){
			$("#getProduct").html(data);
		});
	});
</script>
@endsection