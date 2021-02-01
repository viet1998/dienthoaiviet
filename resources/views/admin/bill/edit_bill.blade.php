@extends('admin.master-admin')
@section('content')
<style type="text/css">
	.contai{ margin: 0 15px; }
	.card{ background-color: ; padding: 20px; border-radius: 10px; overflow: auto;}
	h4{ margin: 10px; }
	.list1 td{ border: 1px solid #fff;width: 200px; padding: 10px;}
	.list2 {width: 100%; padding: 10px; margin-top: 20px;}
	.list2 td{ border: 1px solid #fff; padding: 10px;}
	.price_total { color: #EE0000; }
	.status{ float: right; margin: 10px 0;}
	.sl_stt{ width: 200px; height: 35px; }
</style>
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
									<h3>Chi Tiết Đơn Hàng<span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
									<section class="contai">
											<div style="overflow: auto">
											@if(count($errors)>0)
											<div class="alert alert-danger">
												@foreach($errors->all() as $err)
												{{$err}}<br>
												@endforeach
											</div>
											@endif
											@if(Session::has('thanhcong'))
											<div class="alert alert-success">{{Session::get('thanhcong')}}</div>
											@endif
											</div>
											<div class="card">
												<p style="margin: 10px; font-weight: bold;">Thông tin khách hàng</p>
												<div style="overflow: auto">
													<table class="list1">
														<tr>
															<td>Thông tin người đặt hàng</td>
															<td>{{$bill->customer->name}}</td>
														</tr>
														<tr>
															<td>Ngày đặt</td>
															<td>{{$bill['date_order']}}</td>
														</tr>
														<tr>
															<td>Điện thoại</td>
															<td>{{ $bill->customer->phone_number}}</td>
														</tr>
														<tr>
															<td>Địa chỉ</td>
															<td>{{$bill->customer->address }}</td>
														</tr>
														<tr>
															<td>Email</td>
															<td>{{$bill->customer->email}}</td>
														</tr>
														<tr>
															<td>Ghi chú</td>
															<td>{{$bill->customer->note}}</td>
														</tr>

													</table>
												</div>
												<div style="overflow: auto">
													<table class="list2">
														<tr>
															<td width="30">STT</td>
															<td width="60">Mã SP</td>
															<td>Tên sản phẩm</td>
															<td>Số lượng</td>
															<td>Giá tiền</td>
														</tr>
														@foreach($bill->bill_detail as $i => $bdt)
														<tr>
															<td>{{ $i+1 }}</td>
															<td>{{$bdt->id_product_variant}}</td>
															<td>{{ $bdt->product_variant->product->name }}</td>
															<td>{{ $bdt->quantity }}</td>
															<td> {{ number_format($bdt->unit_price* $bdt->quantity,0,',','.')}} VNĐ</td>
														</tr>
														@endforeach
														<tr>
															<td colspan="4"><strong>Tổng tiền:</strong></td>
															<td><strong class="price_total">{{number_format($bill->total,0,',','.')}} VNĐ</strong></td>
														</tr>
													</table>
												</div>
												<div style="float:right;width: 100%">
													<div style="overflow: auto;float:right;">
													<strong>Trạng thái giao hàng: </strong>
													<form action="{{route('bill.update',$bill->id)}}" method="post" enctype="multipart/form-data">
														@csrf
														@method('PUT')
														<SELECT class="sl_stt" name="status">
															<option value="0"  @if($bill->status==0) selected @endif >Chưa Giao Hàng</option>
															<option value="2" @if($bill->status==2) selected @endif>Đã Giao Hàng</option>
															<option value="1" @if($bill->status==1) selected @endif>Hủy</option>
														</SELECT>
														<input type="submit" class="btn btn-primary" value="Xử lý">
													</form>
													</div>
												</div>
												<br>
												<div style="clear:right;overflow: auto" align="center"><a href="{{route('bill.index')}}" class="btn btn-primary" >Quay Lại</a></div>
											</div>

										</section>
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
@endsection