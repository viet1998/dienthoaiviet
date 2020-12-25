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
							<div class="dropdown"><a class="icon-sping" id="drd-shopping" data-toggle="dropdown" aria-haspopup="true" aria-exspanded="false"  href="Giohang"><img  src="/image/icon/shopping-cart.png" /></a><span class="notif-shipping">5</span>
								<div class="dropdown-menu">
									<div class="tab-sping"  aria-labelledby="drd-shopping">
										<table>
											<tr>
												
												<td class="img-prd"><img src="/image/product/iphone-11-pro-max-green.jpg" /></td>
												<td class="name_product"><p>Iphone 11 Pro max(green) 64GB - Chính hãng</p></td>
												<td class="price">25.000.000<u>đ</u></td>
												<td class="sl">2</td>
												<td class="btn-del"><button >X</button></td>
											</tr>
											<tr>
												
												<td class="img-prd"><img src="/image/product/iphone-11-pro-max-green.jpg" /></td>
												<td class="name_product"><p>Iphone 11 Pro max(green) 64GB - Chính hãng</p></td>
												<td class="price">25.000.000<u>đ</u></td>
												<td class="sl">2</td>
												<td class="btn-del"><button >X</button></td>
											</tr>
											<tr>
												
												<td class="img-prd"><img src="/image/product/mi-10-lite.jpg" /></td>
												<td class="name_product"><p>Xiaomi MI 10 Lite</p></td>
												<td class="price">6.700.000<u>đ</u></td>
												<td class="sl">1</td>
												<td class="btn-del"><button >X</button></td>
											</tr>
											
					
										</table>
										<div>
											<strong>Tạm tính:  56.700.000<u>đ</u></strong>
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
							<li><i class="icon"><img src="/image/icon/smartphone.png"/></i><a href="{{route('phone')}}">ĐIỆN THOẠI </a></li>	
							<li><i class="icon"><img src="/image/icon/tablet.png"/><a href="{{route('tablet')}}"></i>TABLET</a></li>	
							<li><i class="icon"><img src="/image/icon/headphones.png"/><a href="{{route('accessories')}}"></i>PHỤ KIỆN</a></li>	
							<li><i class="icon"><img src="/image/icon/smartwatch.png"/><a href="{{route('watch')}}"></i>ĐỒNG HỒ</a></li>	
							<li><i class="icon"><img src="/image/icon/sim-card.png"/><a href="THESIM"></i>THẺ SIM</a></li>	
							<li><i class="icon"><img src="/image/icon/piggy-bank.png"/><a href="TRAGOP"></i>TRẢ GÓP</a></li>	
							<li><i class="icon"><img src="/image/icon/settings.png"/><a href="SUACHUA"></i>SỬA CHỮA</a></li>
							<li><i class="icon"><img src="/image/icon/giftbox.png"/><a href="KHUYENMAI"></i>KHUYẾN MÃI</a></li>
							<li class="dropdown"><i class="icon"><img src="/image/icon/user.png"/></i><a class=" dropdown-toggle" id="dropdowntk" data-toggle="dropdown" aria-haspopup="true" aria-exspanded="false" href="taikhoan">TÀI KHOẢN</a>
								<div class="dropdown-menu" aria-labelledby="dropdowntk">
									<a class="dropdown-item" href="{{route('login')}}">Đăng nhập</a>
									<a class=" dropdown-item"href="{{route('sigup')}}">Đăng ký</a>
								</div>
							</li>

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
		
