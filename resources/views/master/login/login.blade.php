
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	{{-- lay ra ten mien va bo sung duong dan css --}}
    <base href="{{ asset('') }}">
	<link rel="stylesheet" href="css/login.css">
	<link rel="icon" href="img/logo.png">
</head>
<body class="login">
	<nav class="navbar">
		<p class="title">Sổ liên lạc điện tử</p>
		<p class="title">Trường trung học cơ sở Cát Quế A</p>
	</nav>

	@if(session('thongbao'))
		<div class="messErr">
			<strong>{{ session('thongbao') }}</strong>
		</div>
	@endif

	<div class="main-content">
		<div class="login-box">
			<form action="{{route('handleLogin')}}" method="POST" class="login-form">
				@csrf
				<p class="title-form">Phụ huynh đăng nhập</p>
				<input type="text" name="username" id="username" class="form-control" placeholder="Tên đăng nhập" value="{{session('username')}}">
				@if($errors->has('username'))
					<p class="title-form mess-err">{{$errors->first('username')}}</p>
				@endif
				<input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
				@if($errors->has('password'))
					<p class="title-form mess-err">{{$errors->first('password')}}</p>
				@endif
				<button type="submit" name="btnLogin" class="form-control btn-login">Đăng nhập</button>
				<a href="{{ route('viewForgetPassword') }}" class="form-control">Lấy lại mật khẩu</a>
			</form>
		</div>
	</div>
	
	@if($errors->any())
		@if($errors->has('username'))
			<script type="text/javascript">
				document.getElementById('username').style.border = '2px solid red';
			</script>
		@endif
		@if($errors->has('password'))
			<script type="text/javascript">
				document.getElementById('password').style.border = '2px solid red';
			</script>
		@endif
	@endif
</body>
</html>