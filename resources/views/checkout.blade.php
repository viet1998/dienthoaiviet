@extends('master')
@section('content')
	<style type="text/css">
		
		.title-checkout{ display: flex; width: 100%; height: 10px;}
		
		.product-item-cart .img-item img{width: 100%;}
		.product-item-cart .img-item{text-align: center;}
		.product-item-cart .img-item button{border: none; background: transparent; color: red;}
		.product-item-cart .col-6 p{cursor: pointer; color: #00a5f7;}
		.price-product td{ padding: 5px; width: 100%;}

		.product-item-cart .buttons_added {opacity:1; display:inline-block; display:-ms-inline-flexbox; display:inline-flex;
    white-space:nowrap; vertical-align:top;}
		.is-form { overflow:hidden; position:relative; background-color:#f9f9f9; height:2.2rem; width:1.9rem; padding:0;
    text-shadow:1px 1px 1px #fff; border:1px solid #ddd;}
		.is-form:focus,.input-text:focus { outline:none;}
		.is-form.minus {border-radius:4px 0 0 4px;}
		.is-form.plus {border-radius:0 4px 4px 0;}
		.input-qty {background-color:#fff; height:2.2rem;text-align:center;font-size:1rem;display:inline-block;vertical-align:top;
		    margin:0; border-top:1px solid #ddd;border-bottom:1px solid #ddd;border-left:0; border-right:0; padding:0;}
		.input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {  -webkit-appearance:none; margin:0;}

		.form-block{width: 100%;}
		.form-block input{width: 100%;padding: 5px;border-radius: 5px; border: none;background-color: #f0f0f0;}
		.form-block textarea{width: 100%; height: 100px; padding: 5px;border-radius: 5px; border: none;background-color: #f0f0f0;}
		.book-now button{width: 100%; color: #fff; font-size: 20px; font-weight: bold;background-color: #ff8519;  background-image: linear-gradient(#ff8519, #f00); height: 50px; border: none;border-radius: 5px;}
		.book-now button:hover{opacity: 0.8;}

		.row{ margin: 0; padding:0; }

	</style>
	<section class="contai-grid" style="font-size: 14px;">
			<div class="top-130"> 
				<div class=" row">
					<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row">
					<div class="title-checkout">

					<div class="col-7 col-md-9"><a href="{{route('trangchu')}}" style="text-decoration: none;"><i class="fas fa-chevron-left"></i> Mua thêm sản phẩm khác</a></div>

					<div class="col-5 col-md-3" style="padding: 0;"><p style="float: right;"><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn<p></div>
				</div>
				<hr width="100%" align="center">
				<form action="{{route('savecheckout')}}" method="post" class="beta-form-checkout">
					@csrf
					<div class="row">
						@if(Session::has('thanhcong'))
						<div class="alert alert-success" style="width: 100%;">{{Session::get('thanhcong')}}</div>
						@endif
						@if(Session::has('thatbai'))
						<div class="alert alert-danger" style="width: 100%;">{{Session::get('thatbai')}}</div>
						@endif
					</div>
					@if(Session::has('cart'))
					@foreach($product_cart as $item)
						<div class="row product-item-cart">
							<div class="col-2 col-md-1 img-item" style="margin: 0; padding: 0;">
								<img src="/image/product/{{$item['item']['image']['link']}}" alt="loading"><br>
								<a href="{{route('del_cart',$item['item']['id'])}}"><i class="fas fa-times-circle"></i> xóa</a>
							</div>
							<div class="col-6 col-md-7">
								<strong>{{$item['item']['name']}}</strong><br>
								<span>Phiên bản: {{$item['item']['version']}}</span><br>
								<span>Màu: {{$item['item']['color']}}</span>
							</div>
							<div class="col-4 col-md-4">
								<div class="price-product"><strong style="color: #f80;">{{number_format($item['totalPriceItem'], 0, '', '.')}}<u>đ</u></strong><br>
									
								</div>
								<div class="buttons_added">
									<a href="{{route('reduceitemcart',$item['item']['id'])}}"><input class="minus is-form" type="button" value="-"></a>
									<input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="{{$item['qty']}}">
									<a href="{{route('increaseitemcart',$item['item']['id'])}}"><input class="plus is-form" type="button" value="+"></a>
								</div>
							</div>
						</div>
					@endforeach
					@else 
						Hãy chọn sản phẩm
					@endif

					<!-- end -->
					<hr  width="100%" align="center" />
					<!-- Tổng giá trong giỏ -->
					
					<div class="price-product">
						<div class="row">
							<div class="col-7 col-md-6">	
								<span>Tạm tính</span>
							</div>
							<div class="col-5 col-md-4">	
								<span>@if(Session::has('cart')) {{number_format($totalPrice, 0, '', '.')}} <u>đ</u> @endif</span>
							</div>
						</div>
						<div class="row">
							<div class="col-7 col-md-6">	
								<span>Tổng tiền</span>
							</div>
							<div class="col-5 col-md-4">	
								<strong style="color: #f00;">@if(Session::has('cart')) {{number_format($totalPrice, 0, '', '.')}} <u>đ</u> @endif</strong>
							</div>
						</div>
					</div>
					
					<!-- end -->
					<hr  width="100%" align="center" />
					<!-- Phần điền thông tin đặt hàng -->
					<h5>THÔNG TIN KHÁCH HÀNG</h5>
					<div class="row">
						<div style="width: 80%; margin: 0 auto;">
							<div class="form-block">
								<input id="gender" type="radio" class="input-radio" name="gender" value="Nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Anh</span>
								<input id="gender" type="radio" class="input-radio" name="gender" value="Nữ" style="width: 10%"><span>Chị</span>			
							</div>
							<div class="form-block">							
								<label for="name">Họ tên*</label>
								<input type="text" id="name" name="name" @if(Auth::check()) value="{{Auth::user()->full_name}}" @endif placeholder="Họ tên" required>
							</div>
							
							<div class="form-block">
								<label for="email">Email*</label>
								<input type="email" id="email" name="email" @if(Auth::check()) value="{{Auth::user()->email}}" @endif required placeholder="expample@gmail.com">
							</div>

							<div class="form-block">
								<label for="adress">Địa chỉ*</label>
								<input type="text" id="address" name="address" @if(Auth::check()) value="{{Auth::user()->address}}" @endif placeholder="Tên đường" required>
							</div>
							

							<div class="form-block">
								<label for="phone">Điện thoại*</label>
								<input type="text" id="phone" name="phone_number" @if(Auth::check()) value="{{Auth::user()->phone}}" @endif required>
							</div>
							
							<div class="form-block">
								<label for="notes">Ghi chú</label>
								<textarea id="notes" name="note" ></textarea>
							</div>
							<div class="form-block">
								<label>Phương thức thanh toán</label>	<br>
								<input id="gender" type="radio" class="input-radio" name="payment" value="COD" checked="checked" style="width: 10%"><span style="margin-right: 10%">Khi nhận hàng</span>
								<input id="gender" type="radio" class="input-radio" name="payment" value="ATM" style="width: 10%"><span>ATM</span>			
							</div>
						</div>
						</div>
						<hr  width="100%" align="center" />
					<!-- nút đặt hàng -->
					<div class="row book-now" style="text-align: center;">
						<p>Tổng tiền: <strong style="color: #f00;">@if(Session::has('cart')) {{number_format($totalPrice, 0, '', '.')}} <u>đ</u> @endif</strong></p><br>
						@if(Session::has('cart')) @if($totalQty>0) <button type="submit">Đặt ngay</button> @endif @endif
					</div>
					<!-- end -->	
				</form>		
				
				</div>
				<div class="col-md 2"></div>
				</div>
			</div>	
	</section>
	<script type="text/javascript">
			$('input.input-qty').each(function() {
  			var $this = $(this),
		  	qty = $this.parent().find('.is-form'),
		    min = Number($this.attr('min')),
		    max = Number($this.attr('max'))
		  if (min == 0) {
		    var d = 0
		  } else d = min
		  $(qty).on('click', function() {
		    if ($(this).hasClass('minus')) {
		      if (d > min) d += -1
		    } else if ($(this).hasClass('plus')) {
		      var x = Number($this.val()) + 1
		      if (x <= max) d += 1
		    }
		    $this.attr('value', d).val(d)
		  })
		})
	</script>
@endsection