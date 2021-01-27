<section class="navbar-header">
			<section class="bg-nav-header">
				<nav class="nbar-style">
						<section class="nav-btn">
							<input type="checkbox" id="check" onclick="mymenu()"/>
							<label for="check" class="checkbtn" >
								<i class="glyphicon glyphicon-menu-hamburger"></i>
							</label>
						</section>
						<section class="nav-col1">
							<a class="logo" href="{{route('trangchu')}}"><img src="/image/logo/LOGO.png" alt="" width="150px" height="auto" /></a>
						</section>
						
						<section class="nav-col2">
							<div class="search-form">
							<form action="{{route('search')}}" role="search" method="get" >
								<input type="text" name="key" placeholder="Bạn muốn tìm gì?">
								<button type="submit"><i class="fas fa-search"></i></button>
							</form>
							</div>
						</section>
						<section class="nav-col2-hidden">
							
						</section>
						<section class="nav-col3" >
							<a class="btn btn-outline-light" href="call">Hotline: 19001080</a>
		<!-- ---------------------giỏ hàng--------------- -->
						</section>
						<section class="nav-col4">
							<div class="dropdown"><a class="icon-sping" id="drd-shopping" data-toggle="dropdown" aria-haspopup="true" aria-exspanded="false"  href="Giohang"><img  src="/image/icon/shopping-cart.png" /></a><span class="notif-shipping">
										@if(Session::has('cart'))
										({{count($product_cart)}})
										@endif </span>
										<div class="dropdown-menu">
										<div class="tab-sping"  aria-labelledby="drd-shopping">
											<i class="fa fa-chevron-down"></i>
										<table>
											@if(Session::has('cart'))
											@foreach($product_cart as $product_variant)
											<tr>
												<td class="img-prd">
													<a class="pull-left" href="{{route('show',$product_variant['item']['id_product'])}}">
														<img src="/image/product/{{$product_variant['item']['image']['link']}}" />
													</a>
												</td>
												<td class="name_product">
													<a class="pull-left" href="{{route('show',$product_variant['item']['id_product'])}}">
														<p>{{$product_variant['item']['product']['name']}} {{$product_variant['item']['version']}} {{$product_variant['item']['color']}}</p>
													</a>
												</td>
												<td class="price">{{number_format($product_variant['totalPriceItem'])}}<u>đ</u></td>
												<td class="sl">{{$product_variant['qty']}}</td>
												<td class="btn-del"><a href="{{route('del_cart',$product_variant['item']['id'])}}"><button >X</button></a></td>
											</tr>
											@endforeach
											@else
											<tr style="width: 100%">
												<td>
													Giỏ Hàng Trống
												</td>
											</tr>
											@endif
										</table>
										<div>
											<strong>Tạm tính:  @if(Session::has('cart')){{number_format($totalPrice)}} <u>đ</u> @endif</strong>
											<button class="btn-pay"><a href="{{route('checkout')}}">Thanh toán</a></button>
										</div>
									</div>
								</div>
							</div>
							
						</section>
				</nav>
			</section>
			<!-- Phần menu có css  là menu-top.css -->
				<section class="bg-top_menu" id="menutype">
					<section class="grid-top_menu">
						<div class="row" style="margin: 0;">
							<div class="col-lg-2 home" style="padding: 8px;"><a href="{{route('trangchu')}}"><i class="fas fa-home"></i>&nbsp TRANG CHỦ</a></div>
							<div class="col-lg-2" style="padding: 8px;"><a href="{{route('smartphone')}}"><i class="fas fa-mobile"></i>&nbsp ĐIỆN THOẠI</a></div>
							<div class="col-lg-2" style="padding: 8px;"><a href=""><i class="fas fa-piggy-bank"></i>&nbsp TRẢ GÓP</a></div>
							<div class="col-lg-2" style="padding: 8px;"><a href=""><i class="fas fa-tools"></i>&nbsp SỬA CHỮA</a></div>
							<div class="col-lg-2" style="padding: 8px;"><a href=""><i class="fas fa-gift"></i>&nbsp KHUYẾN MÃI</a></div>
							<div class="col-lg-2 dropdown" style="padding: 8px;"><a style="text-decoration: none;" class=" dropdown-toggle" id="dropdowntk" data-toggle="dropdown" aria-haspopup="true" aria-exspanded="false" href="taikhoan"><i class="fas fa-user"></i>@if(Auth::check()) Xin chào {{Auth::user()->full_name}} @else Tài khoản @endif</a>
								@if(Auth::check())
									@if(Auth::user()->level>0)
									<div class="dropdown-menu " aria-labelledby="dropdowntk">
										<a class="dropdown-item fs-14" href="{{route('admin_dashboard')}}">Trang Quản Lý</a>
										<a class=" dropdown-item fs-14"href="{{route('dangxuat')}}">Đăng xuất</a>
									</div>
									@else
									<div class="dropdown-menu" aria-labelledby="dropdowntk">

										<a class="dropdown-item fs-14" href="{{route('profile')}}">Trang Cá Nhân</a>

										<a class=" dropdown-item fs-14"href="{{route('dangxuat')}}">Đăng xuất</a>
									</div>
									@endif
								@else
								<div class="dropdown-menu" aria-labelledby="dropdowntk">
									<a class="dropdown-item fs-14" href="{{route('login')}}">Đăng nhập</a>
									<a class=" dropdown-item fs-14"href="{{route('sigup')}}">Đăng ký</a>
								</div>
								@endif</div>
								<div class="col-lg-2 form-check-phone">
									<!-- Tìm đơn hàng -->
									<form action="{{route('checkorder')}}" method="get">
										@csrf
									<label style="color: #fff; " for="checkphone">Tìm đơn hàng</label>
									<div style="border-radius: 2px; background-color: #fff;">
									<input type="phone" name="checkphone" placeholder="Nhập số điện thoại mua hàng" />
									<button type="submit"><i class="fas fa-search"></i></button>
									</div>
									</form>
									
								</div>
							</div>
					</section>	
				</section>
			</section>
		</section>

<script type="text/javascript">
	function mymenu(){
		var checkBox = document.getElementById("check")
		var menutype = document.getElementById("menutype")
		if (checkBox.checked == true ) {
		menutype.style.display = "block";
		}else{
		menutype.style.display = "none";
		}
	}
</script>
		
