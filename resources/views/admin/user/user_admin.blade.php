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
									<h3>Danh Sách Tài Khoản <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12" >
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
												<td colspan="2" width="15%">
													<h3 style="font-size: 25px">
													<select name="sort" id="sort" class="form-control">
														<option value="0">Sắp Xếp</option>
														<option value="1">Tên</option>
														<option value="2">Email</option>
														<option value="3">Khách Hàng</option>
														<option value="4">Nhân Viên</option>
														<option value="5">Quản Lý</option>
													</select>
													</h3>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('user.index')}}" class="btn btn-primary">Refresh</a>
												</td>
											</tr>
										</table>
										</div>
										<div style="overflow: auto">
										<table  class="table">
											<thead >
												<tr >
													<th style="text-align: center;">ID</th>
													<th style="text-align: center;">Tên</th>
													<th style="text-align: center;">Email</th>
													<th style="text-align: center;">Số Điện Thoại</th>
													<th style="text-align: center;">Địa Chỉ</th>
													<th style="text-align: center;">Phân Quyền</th>
													<th style="text-align: center;">Sửa Đổi Lần Cuối Bởi</th>
													<th style="text-align: center;">Ngày Tạo</th>
													<th style="text-align: center;">Ngày Sửa Đổi</th>
													<th style="text-align: center;">Chức Năng</th>
												</tr>
											</thead>
											<tbody style="text-align: center" id="getUser">
												@foreach($users as $user)
												<tr>
													<td>{{$user->id}}</td>
													<td>{{$user->full_name}}</a></td>
													<td>{{$user->email}}</td>
													<td>{{$user->phone}}</td>
													<td>{{$user->address}}</td>
													<td>
														@switch($user->level)
														@case(0) Khách Hàng @break 
														@case(1) Nhân Viên @break
														@case(2) Quản Lý @break
														@endswitch
													</td>
													<td>
														@if($user->last_modified_by_user!=null)
														{{$user->last_modified_by_user}} - {{$user->parent->full_name}}
														@endif
													</td>
													<td>{{$user->created_at}}</td>
													<td>{{$user->updated_at}}</td>
													<td style="">
														<form method="post" action="{{route('user.destroy',$user->id)}}">
															@csrf
															@method('DELETE')
															<a href="{{route('user.edit',$user->id)}}"class="btn btn-primary">Sửa</a>
															<input type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn xóa tài khoản {{$user->email}} không?');"value="Xóa">
														</form>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="12"><div align="center">{{$users->links()}}</div></td>
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
			$.get('searchuser/'+searchname,function(data){
				$("#getUser").html(data);
			});
		})
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sortuser/'+sort,function(data){
				$("#getUser").html(data);
			});
		});
	</script>
@endsection