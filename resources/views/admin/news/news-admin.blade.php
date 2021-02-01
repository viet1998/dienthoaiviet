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
									<h3>Danh Sách Bài Viết <span id="getTotal"></span>
									</h3>
									
										
								</header>
								<div class="panel-body">
									<div class="col-md-12">
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
														<option value="1">Tiêu Đề</option>
														<option value="2">Người Thêm</option>
														<option value="3">Ngày Thêm</option>
														<option value="4">Ngày Sửa Đổi</option>
													</select>
													</h3>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('news.create')}}" class="btn btn-primary">Thêm</a>
												</td>
												<td colspan="1" width="10%">
													<a href="{{route('news.index')}}" class="btn btn-primary">Refresh</a>
												</td>
											</tr>
										</table>
										</div>
										<div style="overflow: auto">
										<table  class="table" >
											<thead >
												<tr >
													<th style="text-align: center;">ID</th>
													<th style="text-align: center;">Hình Ảnh</th>
													<th style="text-align: center;">Tiêu Đề</th>
													<th style="text-align: center;">Người Thêm</th>
													<th style="text-align: center;">Người Sửa</th>
													<th style="text-align: center;">Ngày Thêm</th>
													<th style="text-align: center;">Ngày Sửa</th>
													<th style="text-align: center;">Chức Năng</th>
												</tr>
											</thead>
											<tbody style="text-align: center" id="getnews">
												@foreach($news as $n)
												<tr>
													<td>{{$n->id}}</td>
													<td><img src="/image/news/{{$n->image}}" width="140px" height="80px"></a></td>
													<td>{{$n->title}}</td>
													<td>{{$n->created_by_user}} - {{$n->user->full_name}}</td>
													<td>{{$n->last_modified_by_user}} - {{$n->user_modified->full_name}}</td>
													<td>{{$n->created_at}}</td>
													<td>{{$n->updated_at}}</td>
													<td style="">
														<form method="post" action="{{route('news.destroy',$n->id)}}">
															@csrf
															@method('DELETE')
															<a href="{{route('news.edit',$n->id)}}"class="btn btn-primary"><span class="glyphicon glyphicon-edit white"></span></a>
															<button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa news {{$n->id}} không?');" ><span class="glyphicon glyphicon-remove white"></span></button>
														</form>
													</td>
												</tr>
												@endforeach
												<tr>
													<td colspan="7"><div align="center">{{$news->links()}}</div></td>
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
			$.get('searchnews/'+searchname,function(data){
				$("#getnews").html(data);
			});
		})
		$("#sort").on('change',function(e){
			console.log(e);
			var sort= e.target.value;

			$.get('sortnews/'+sort,function(data){
				$("#getnews").html(data);
			});
		});
	</script>
	<style type="text/css">
	.white {
		color: white;
	}
</style>
@endsection