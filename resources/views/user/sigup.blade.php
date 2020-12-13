@extends('master')
@section('content')
<div class="container">
	<div class="col-7">
		<div class="card">
				<div class="title"><strong>Đăng ký thành viên</strong></div>
			<form>
				<div class="grid-photo">
					<div class="user_file">
						<label for="fusk">
							<img src="/image/icon/profile-user512x512.png" class="image" />
						<p class="middle"><strong class="btn ">Thêm Avatar</strong></label>
						<input type="file" name="photo" id="fusk">
					</div>
				</div>
				<div><input type="text" name="Fullname" placeholder="Nhập họ tên!" required=""></div>
				<div><input type="email" name="Email" placeholder="Nhập tên đăng nhập tài khoản bằng Email!" required=""></div>
				<div><input type="password" name="Password" placeholder="Nhập mật khẩu!" required=""></div>
				<div><input type="tel" name="phone" placeholder="Nhập sổ điện thoại!" required=""></div>
				<div><input type="text" name="address" placeholder="Nhập địa chỉ!" required=""></div>
				<div><button class="btn btn-info" type="submit">Đăng ký</button></div>
			</form>
		</div>
	</div>
</div>
@endsection