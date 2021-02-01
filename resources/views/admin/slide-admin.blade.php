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
									<h3>Danh Sách Slide <span id="getTotal"></span>
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
										<div style="overflow: auto">
										<table  class="table" style="overflow: auto">
											<thead >
												<tr >
													<th style="text-align: center;">ID</th>
													<th style="text-align: center;">Ảnh</th>
													<th style="text-align: center;">Sửa Đổi Lần Cuối Bởi</th>
													<th style="text-align: center;">Ngày Thêm</th>
													<th style="text-align: center;">Ngày Sửa</th>
													<th style="text-align: center;">Chức Năng</th>
												</tr>
											</thead>
											<tbody style="text-align: center" id="getslide">
												@foreach($slides as $slide)
												<tr>
													<td>{{$slide->id}}</td>
													<td><img src="/image/slide/{{$slide->image}}" width="400px" height="150px"></a></td>
													<td>{{$slide->last_modified_by_user}} - {{$slide->user_modified->full_name}}</td>
													<td>{{$slide->created_at}}</td>
													<td>{{$slide->updated_at}}</td>
													<td style="">
														<form method="post" action="{{route('slide.destroy',$slide->id)}}">
															@csrf
															@method('DELETE')
															
															<input type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn xóa slide {{$slide->id}} không?');"value="Xóa">
														</form>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="12">
														<form method="post" action="{{route('slide.store')}}" enctype="multipart/form-data" >
															@csrf
														<table width="100%">
															<tr>
																<td >
																	<label>Thêm Slide:</label>
																<td>
																<input type="file" name="image" class="form-control">
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
			$.get('searchslide/'+searchname,function(data){
				$("#getslide").html(data);
			});
		})
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sortslide/'+sort,function(data){
				$("#getslide").html(data);
			});
		});
	</script>
@endsection