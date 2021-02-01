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
				<div class="col-md-6 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Danh Sách Loại<span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12" >
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
										@if(Session::has('thatbai'))
										<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
										@endif
										</div>
										<table class="table">
											<tr>
												<td>
													<div style="overflow: auto">
													<table  class="table">
														<thead >
															<tr >
																<th style="text-align: center;">ID</th>
																<th style="text-align: center;">Tên</th>
																<th style="text-align: center;">Ngày Thêm</th>
																<th style="text-align: center;">Ngày Sửa</th>
																<th style="text-align: center;">Chức Năng</th>
															</tr>
														</thead>
														<tbody style="text-align: center" id="gettype">
															@foreach($types as $type)
															<tr>
																<td>{{$type->id}}</td>
																<td>{{$type->name}}</td>
																<td>{{$type->created_at}}</td>
																<td>{{$type->updated_at}}</td>
																<td style="">
																	<form method="post" action="{{route('type.destroy',$type->id)}}">
																		@csrf
																		@method('DELETE')
																		<input type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn xóa loại {{$type->name}} không?');"value="Xóa">
																	</form>
																</td>
															</tr>
															@endforeach
															<tr>
																<td colspan="12">
																	<form method="post" action="{{route('type.store')}}" enctype="multipart/form-data" >
																		@csrf
																	<table width="100%">
																		<tr>
																			<td >
																				<label>Thêm Loại:</label>
																			<td>
																			<input type="text" name="name" class="form-control">
																			</td>
																			<td>
																			<input type="submit" class="btn btn-primary" value="Lưu">
																			</td>
																		</tr>
																	</table>
																	</form>
																	
																</td>
															</tr>
														</tbody>
													</table>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						
				<!--//agileinfo-grap-->
				</div>
				<div class="col-md-6 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Danh Sách Hãng <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12" >
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
										@if(Session::has('thatbai'))
										<div class="alert alert-danger">{{Session::get('thatbai')}}</div>
										@endif
										</div>
										<table class="table">
											<tr>
												<td>
													<div style="overflow: auto">
													<table  class="table">
														<thead >
															<tr >
																<th style="text-align: center;">ID</th>
																<th style="text-align: center;">Tên</th>
																<th style="text-align: center;">Ngày Thêm</th>
																<th style="text-align: center;">Ngày Sửa</th>
																<th style="text-align: center;">Chức Năng</th>
															</tr>
														</thead>
														<tbody style="text-align: center" id="gettype">
															@foreach($companies as $company)
															<tr>
																<td>{{$company->id}}</td>
																<td>{{$company->name}}</td>
																<td>{{$company->created_at}}</td>
																<td>{{$company->updated_at}}</td>
																<td style="">
																	<form method="post" action="{{route('brand.destroy',$company->id)}}">
																		@csrf
																		@method('DELETE')
																		<input type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn xóa loại {{$company->name}} không?');"value="Xóa">
																	</form>
																</td>
															</tr>
															@endforeach
															<tr>
																<td colspan="12">
																	<form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data" >
																		@csrf
																	<table width="100%">
																		<tr>
																			<td >
																				<label>Thêm Hãng:</label>
																			<td>
																			<input type="text" name="name" class="form-control">
																			</td>
																			<td>
																			<input type="submit" class="btn btn-primary" value="Lưu">
																			</td>
																		</tr>
																	</table>
																	</form>
																	
																</td>
															</tr>
														</tbody>
													</table>
													</div>
												</td>
											</tr>
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
			$.get('searchtype/'+searchname,function(data){
				$("#gettype").html(data);
			});
		})
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sorttype/'+sort,function(data){
				$("#gettype").html(data);
			});
		});
	</script>
@endsection