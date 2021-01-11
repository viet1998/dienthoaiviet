@extends('master')
@section('content')
	<style type="text/css">
		.contai-grid{width: 700px;}
		.block-col{font-size: 16px; width: 100%; margin-top: 120px;border-radius: 5px; padding: 15px; box-shadow: 0 0 5px 5px rgba(0,0,0,0.2);}
		.title-checkout{ display: flex; width: 100%; }
		.title-checkout li{ flex-basis: 50%; list-style-type: none; }
		.product-item-cart img{width: 100px;}
		.product-item-cart .img-item{text-align: center;}
		.product-item-cart .img-item button{border: none; background: transparent; color: red;}
		.product-item-cart .col-6 p{cursor: pointer; color: #00a5f7;}
		.product-item-cart .buttons_added {
    opacity:1;
    display:inline-block;
    display:-ms-inline-flexbox;
    display:inline-flex;
    white-space:nowrap;
    vertical-align:top;
}
.is-form {
    overflow:hidden;
    position:relative;
    background-color:#f9f9f9;
    height:2.2rem;
    width:1.9rem;
    padding:0;
    text-shadow:1px 1px 1px #fff;
    border:1px solid #ddd;
}
.is-form:focus,.input-text:focus {
    outline:none;
}
.is-form.minus {
    border-radius:4px 0 0 4px;
}
.is-form.plus {
    border-radius:0 4px 4px 0;
}
.input-qty {
    background-color:#fff;
    height:2.2rem;
    text-align:center;
    font-size:1rem;
    display:inline-block;
    vertical-align:top;
    margin:0;
    border-top:1px solid #ddd;
    border-bottom:1px solid #ddd;
    border-left:0;
    border-right:0;
    padding:0;
}
.input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {
    -webkit-appearance:none;
    margin:0;
}
	</style>
	<section class="contai-grid">
		<section class="block-col">
			<div class="w-100">
				<div class="row w-100">
					<ul class="title-checkout">
							<li><a href="" style="text-decoration: none;">< Mua thêm sản phẩm khác</a></li>
						<li><p style="float: right;">Giỏ hàng của bạn<p></li>
					</ul>
				</div>
				<!-- hiển thi sản phẩm trong giỏ hàng giỏ hàng  -->
				<div class="row w-100 product-item-cart">
					<div class="col-3 img-item">
						<img src="/image/product/iphone-11-pro-max-green.jpg" alt="loading"><br>
						<button style="border: none;"><i class="fas fa-times-circle"></i> xóa</button>
					</div>
					<div class="col-6">
						<strong>iphone 11 pro max 128gb</strong><br>
						<p data-toggle="collapse" data-target="#myKM">3 khuyến mãi <i class="fa fa-chevron-down"></i></p>
						  <div id="myKM" class="collapse">
						  	<li>Pin sạc dự phòng giảm 30% khi mua kèm. (click xem chi tiết)</li>
							<li>Giá hoặc khuyến mãi không áp dụng khi mua trả góp 0% qua nhà tài chính</li>
							<li>Mua Đồng hồ thời trang giảm 40% (không kèm khuyến mãi khác)</li>
						  </div>
					</div>
					<div class="col-3">
						<div class="price-product"><strong style="color: #f80;">giá sản phẩm<u>đ</u></strong><br>
							<s>Giá khuyến mãi<u>đ</u></s>
						</div>
						<div class="buttons_added">
							<input class="minus is-form" type="button" value="-">
							<input aria-label="quantity" class="input-qty" max="10" min="1" name="" type="number" value="1">
							<input class="plus is-form" type="button" value="+">
						</div>
					</div>
				</div>
				<!-- end -->
				<hr  width="100%" align="center" />
				<!-- Tổng giá trong giỏ -->
				<div class="row w-100">
					<div class="row price-product">
						<ul style="display: flex;list-style-type: none;">
							<li class="col-9">Tạm tính:</li>
							<li class="col-3"><span style="float: right;">25.690.000<u>đ</u><span></span></li>
						</ul>
						<ul style="display: flex;list-style-type: none;">
							<li class="col-9">Tổng tiền:</li>
							<li class="col-3"><strong style="color: #f00; float: right;">25.690.000<u>đ</u></strong></li>
						</ul>
					</div>
				</div>
				<!-- end -->
				<hr  width="100%" align="center" />
				<!-- Phần điền thông tin đặt hàng -->
				<div class="row w-100">
					<h5>THÔNG TIN KHÁCH HÀNG</h5>
					<div class="space20">&nbsp;</div>
					<div class="form-block">
						<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Anh</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Chị</span>
										
						</div>
						<div class="form-block">							
							<label for="name">Họ tên*</label>
							<input type="text" id="name" name="name" value="" placeholder="Họ tên" required>
						</div>
						
						<div class="form-block">
							<label for="email">Email*</label>
							<input type="email" id="email" name="email" value="" required placeholder="expample@gmail.com">
						</div>

						<div class="form-block">
							<label for="adress">Địa chỉ*</label>
							<input type="text" id="address" name="address" value="" placeholder="Tên đường" required>
						</div>
						

						<div class="form-block">
							<label for="phone">Điện thoại*</label>
							<input type="text" id="phone" name="phone" value="" required>
						</div>
						
						<div class="form-block">
							<label for="notes">Ghi chú</label>
							<textarea id="notes" name="notes" ></textarea>
						</div>
					</div>
					<div class="form-block">
							<label>Phương thức thanh toán</label>	<br>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Khi nhận hàng</span>
							<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>ATM</span>			
					</div>
				</div>

				<!-- end -->
				<hr  width="100%" align="center" />
				<!-- nút đặt hàng -->
				<div class="row w-100" style="text-align: center;">
					<p>Tổng tiền: <strong style="color: #f00;">25.690.000<u>đ</u></strong></p>
					<button class="btn btn-warning" style="color: #fff; font-size: 20px; font-weight: bold;margin: 10px;">Đặt ngay</button>
				</div>
				<!-- end -->
			</div>
		</section>
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