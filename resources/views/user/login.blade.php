
	@extends('master')
	@section('title')
		Đăng nhập tài khoản
	@endsection
	@section('content')
  	<section class="container">
  		<section class="col-5"> 
  			<div class="logo-login"><img src="/image/logo/LOGO.png" alt="LOGO"></div>
			<form class="form-style">
	 			<input type="text" name="Username" placeholder="Nhập tài khoản!"></br>
	 			<input type="password" name="Password" placeholder="Nhập mật khẩu!"></br>
	 			<button class="btn btn-warning"  type="submit"> Đăng nhập</button>
	 			<a class="btn btn-info" href="{{route('sigup')}}">Đăng ký</a></br>
	 			<a href="#">Quên mật khẩu?</a>
	 		</form>	
  		</section> 	
  	</section>
  	@endsection