@extends('admin.master-admin')
@section('content')
<script type="text/javascript" src="/admin/js/nicEdit.js"></script>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
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
									<h3>Sửa Bài Viết <span id="getTotal"></span>
									</h3>
								</header>
								<div class="panel-body">
									<div class="col-md-12">
										<form action="{{route('news.update',$news->id)}}" method="post" enctype="multipart/form-data">
											@csrf
											@method('PUT')
											<div class="form-group row">
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
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Tiêu Đề</label>
												<div class="col-sm-10">
													<input placeholder="Tiêu Đề" type="text" name="title" class="form-control" value="{{$news->title}}">

												</div>
											</div>
											
											<div class="form-group row">
												<label  class="col-sm-2 col-form-label">Hình Ảnh</label>
												<div class="col-sm-10">
													<input type="file" name="image" class="form-control"  placeholder="" >
													<img src="/image/news/{{$news->image}}" width="140px" height="80px"></a>
												</div>
											</div>

											<div class="form-group row">
												<script type="text/javascript">
													bkLib.onDomLoaded(function() {
													        new nicEditor({maxHeight : 1000}).panelInstance('content');
													});
												</script>
												<label  class="col-sm-2 col-form-label">Nội Dung</label>
												<div class="col-sm-10">
													<div style="overflow: auto">
													<textarea name="content" style="min-height: 300px;background-color: #FFF " id="content" class="form-control"  placeholder="" >
														{{$news->content}}
													</textarea> 
													</div>
												</div>
											</div>
											
											
											<div class="form-group row">
												<div  align="center">
													<input type="submit" class="btn btn-primary" value="Lưu">
													<a href="{{route('news.index')}}" class="btn btn-primary">Quay Lại</a>
												</div>

											</div>
										</form>

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