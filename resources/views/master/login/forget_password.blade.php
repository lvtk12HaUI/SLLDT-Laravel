
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

	<div class="main-content">
		<div class="login-box">
			<form action="{{ route('handleForgetPassword') }}" method="POST" class="login-form">
				@csrf
				<p class="title-form">Vui lòng nhập mã học sinh để lấy lại mật khẩu</p>
				<input type="text" name="maHS" id="maHS" class="form-control" placeholder="Mã học sinh" value="{{ old('maHS') }}">
				@if($errors->has('maHS'))
					<p class="title-form mess-err">{{$errors->first('maHS')}}</p>
				@endif
				@if(session('notification'))
					<p class="title-form mess-err">{{session('notification')}}</p>
				@endif
				<button type="submit" name="btnSubmit" class="form-control" style="background-color: #67ae55;border: none;">Lấy lại mật khẩu</button>
				
			</form>
		</div>
	</div>

	@if($errors->any())
		@if($errors->has('maHS'))
			<script type="text/javascript">
				document.getElementById('maHS').style.border = '2px solid red';
			</script>
		@endif
	@endif
</body>
</html>