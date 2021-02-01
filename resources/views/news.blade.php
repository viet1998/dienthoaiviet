@extends('master')
@section('content')
<!-- phần nội dung -->
<section class="contai-grid" style="font-size: 14px;">
		<div style="margin-left: 0; margin-right: 0;" class=" row top-130">
			
			<!-- phan noi dung san pham ten vs gia -->
			<div class="col-12 col-sm-4 col-md-6 col-lg-8 col-md-6">
					
					<div class="card bg-light" style="padding: 0px;">
						<table class="table" style="width: 100%;">
							<tr style="width: 100%;">
								<td></td>
							</tr>
							@foreach($news as $n)
							<tr style="padding: 5px;width: 100%;">
								<td width="40%">
									<img src="/image/news/{{$n->image}}" style="display: block;width: 100%;height: 140px">
								</td>
								<td>
									<h3 align="left"><a href="{{route('shownews',$n->id)}}" style="color: #222222;">{{$n->title}}</a></h3>
									<h4 align="left" style="color:#B4B4B4">{{$n->user->full_name}}.  {{date('Y-m-d',strtotime($n->created_at))}}</h3>
								</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="2">
									<div align="center">{{$news->links()}}</div>
								</td>
							</tr>
						</table>
					</div></br>
			</div>
			<div class="col-12 col-lg-3 col-md-4 item-3">
					<div class="banner">
						@foreach($slides as $slide)
						<a href="1"><img src="/image/slide/{{$slide->image}}" alt="" /></a>
						@endforeach
					</div>
					<div class="extend">
						<div class="extend-titel">
							<span>Chế độ bảo hành</span>
						</div>
						<div class="subex-titel">
							<span>Bảo hành chính hãng</span>
							<div class="border">
							<p>1 đổi 1, 15 ngày</p>
							<p>Bảo hành 12 tháng</p>
							<p>Xử lý trong 30 ngày</p>
							</div>
							<img style="padding: 6px;" src="/image/icon/chedobaohanh.png" alt="" />
							<p>Sửa chữa bảo hành theo chính sách hiện hành của hãng sản xuất</p>
							<p><strong>THÔNG TIN BẢO HÀNH CAO CẤP</strong></p>
							<button class="btn btn-warning" style="font-size: 16px;">Xem chi tiết</a></button>
						</div>
					</div>
			</div>
		
	</section>	
@endsection