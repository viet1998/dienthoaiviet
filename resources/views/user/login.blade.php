
	@if(Session::has('flag'))
	@if(Session::get('flag')=='admin_danger')
	 	<?php
			echo '<script type="text/javascript"> window.alert("'.Session::get('thongbao').'"); </script>';
		?>
  	@endif
  	@endif
	@extends('master')
	@section('title')
		Đăng nhập tài khoản
	@endsection
	@section('content')
  	<section class="container">
  		<section class="col-5"> 
  			<div class="logo-login"><img src="/image/logo/LOGO.png" alt="LOGO"></div>

  			@if(Auth::check())

  				<?php
					echo '<script type="text/javascript"> window.location.href ="'.route('trangchu').'"; </script>';
				?>
  			@endif
  			@if(count($errors)>0)
					@foreach($errors->all() as $err)
					<?php
					echo '<script type="text/javascript">
						window.alert("'.$err.'");
					</script>';
					?>
					@endforeach
				
			@endif
			@if(Session::has('flag'))
				@if(Session::get('flag')=='success')
					<?php
						echo '<script type="text/javascript"> window.alert("'.Session::get('thongbao').'"); window.location.href ="'.route('trangchu').'"; </script>';
					?>
				@else
					<?php
						echo '<script type="text/javascript"> window.alert("'.Session::get('thongbao').'"); </script>';
					?>
				@endif

			@endif
			<form action="{{route('dangnhap')}}" method="post" class="form-style">
				@csrf
	 			<input type="text" name="email" placeholder="Nhập tài khoản!"></br>
	 			<input type="password" name="password" placeholder="Nhập mật khẩu!"></br>
	 			<button class="btn btn-warning"  type="submit"> Đăng nhập</button>
	 			<a class="btn btn-info" href="{{route('sigup')}}">Đăng ký</a></br>
	 			<a href="#">Quên mật khẩu?</a>
	 		</form>	
  		</section> 	
  	</section>
  	@endsection
