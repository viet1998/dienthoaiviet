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
							<form action="" method="post">
								<input type="text" placeholder="Bạn muốn tìm gì?">
								<button type="submit"><i class="fas fa-search"></i></button>
							</form>
							</div>
						</section>
						<section class="nav-col2-hidden">
							
						</section>
						<section class="nav-col3" >
							<a class="btn btn-outline-light" href="call">Hotline: 19001080</a>
							<!-- giỏ hàng -->
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
											@foreach($product_cart as $product)
											<tr>
												<td class="img-prd">
													<a class="pull-left" href="{{route('product.show',$product['item']['id'])}}">
														<img src="/image/product/iphone-11-pro-max-green.jpg" /></a></td>
												<td class="name_product"><p>{{$product['item']['name']}}</p></td>
												<td class="price">{{number_format($product['price'])}}<u>đ</u></td>
												<td class="sl">{{$product['qty']}}</td>
												<td class="btn-del"><a href="{{route('del_cart',$product['item']['id'])}}"><button >X</button></a></td>
											</tr>
											@endforeach
											@endif
										</table>
										<div>
											<strong>Tạm tính:  @if(Session::has('cart')){{number_format($totalPrice)}} <u>đ</u> @endif</strong>
											<button class="btn-pay"><a href="#">Thanh toán</a></button>
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
						<ul>
							<div></div>
							<li></li>
							<li><a href="{{route('smartphone')}}"><i class="icon"><img src="/image/icon/smartphone.png"/></i>ĐIỆN THOẠI </a></li>	
							<li><i class="icon"><img src="/image/icon/piggy-bank.png"/><a href=""></i>TRẢ GÓP</a></li>	
							<li><i class="icon"><img src="/image/icon/settings.png"/><a href=""></i>SỬA CHỮA</a></li>
							<li><i class="icon"><img src="/image/icon/giftbox.png"/><a href="KHUYENMAI"></i>KHUYẾN MÃI</a></li>
							<li class="dropdown"><i class="icon"><img src="/image/icon/user.png"/></i><a class=" dropdown-toggle" id="dropdowntk" data-toggle="dropdown" aria-haspopup="true" aria-exspanded="false" href="taikhoan">@if(Auth::check()) Xin chào {{Auth::user()->full_name}} @else Tài khoản @endif</a>
								@if(Auth::check())
									@if(Auth::user()->level=='admin')
									<div class="dropdown-menu" aria-labelledby="dropdowntk">
										<a class="dropdown-item" href="{{route('login')}}">Trang Quản Lý</a>
										<a class=" dropdown-item"href="{{route('dangxuat')}}">Đăng xuất</a>
									</div>
									@else
									<div class="dropdown-menu" aria-labelledby="dropdowntk">
										<a class="dropdown-item" href="{{route('login')}}">Trang Cá Nhân</a>
										<a class=" dropdown-item"href="{{route('dangxuat')}}">Đăng xuất</a>
									</div>
									@endif
								@else
								<div class="dropdown-menu" aria-labelledby="dropdowntk">
									<a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a>
									<a class=" dropdown-item"href="{{route('sigup')}}">Đăng ký</a>
								</div>
								@endif
							</li>
							
							<li></li>

						</ul>
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
		
