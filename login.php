<?php

session_start();

require "functions/functions-dashboard.php";
function regis($data)
{

	global $conn;

	$nama = htmlspecialchars($_POST["nama"]);
	$email = strtolower($_POST["email"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);

	// validate email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$pesan = "Invalid email format";
		echo "<script>
				alert('$pesan')
			  </script>";
		return false;
	}
	// var_dump($password);die;
	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('email sudah terdaftar!')
			  </script>";
		return false;
	}
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES(null, '$email', '$password', '$nama', 'default.png', 0)");

	return mysqli_affected_rows($conn);
	// var_dump(mysqli_fetch_assoc($result));die;
}
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}


}

if( isset($_SESSION["login"]) ) {
	header("Location: 1-Dashboard-Home.php");
	exit;
}

if (isset($_POST['regis'])) {
	if (regis($_POST) > 0) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}
}
if (isset($_POST["login"])) {

	$email = $_POST["email"];
	$password = $_POST["password"];
	// var_dump($_POST);die;
	$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

	// cek email
	if (mysqli_num_rows($result) === 1) {
		
		// cek password
		$row = mysqli_fetch_assoc($result);
		$hash = $row['password'];
		// var_dump(password_verify($password, $hash));die;
		if (password_verify($password, $hash)) {
			// var_dump($row["password"]);die;
			// set session
			$_SESSION["login"] = true;
			$_SESSION["user"] = ['nama' => $row['nama'], 'gambar' => $row['gambar']];
			// var_dump(isset($_SESSION['login']));die;
			// cek remember me
			if (isset($_POST['remember'])) {
				// buat cookie
				setcookie('id', $row['id'], time() + 60);
				setcookie('key', hash('sha256', $row['email']), time() + 60);
			}

			header("Location: 1-Dashboard-Home.php");
			exit;
		}
	}

	$error = true;
}
// var_dump(isset($_COOKIE['id']) && isset($_COOKIE['key']));die;


?>


<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Klorofil - Free Bootstrap Dashboard Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<!-- TABBED CONTENT -->
							<div class="custom-tabs-line tabs-line-bottom">
								<ul class="nav" role="tablist">
									<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Sign In</a></li>
									<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Sign Up</a></li>
								</ul>
							</div>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-bottom-left1">
									<div class="header">
										<div class="logo text-center"><img src="assets/img/logo-dark.png" alt="Klorofil Logo"></div>
										<p class="lead">Login to your account</p>
									</div>
									<form class="form-auth-small" action="" method="POST">
										<div class="form-group">
											<label for="signin-email" class="control-label sr-only">Email</label>
											<input type="email" name="email" class="form-control" id="signin-email" placeholder="Email" required>
										</div>
										<div class="form-group">
											<label for="login-password" class="control-label sr-only">Password</label>
											<input type="password" name="password" class="form-control" id="login-password" placeholder="Password" required>
											<div class="form-group clearfix">
												<label class="fancy-checkbox element-left">
													<input type="checkbox" onclick="myFunction('login-password')">
													<span>Show password</span>
												</label>
											</div>
										</div>

										<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">LOGIN</button>
										<div class="bottom">
											<?php if (isset($error)) : ?>
												<p style="color: red; font-style: italic;">username / password salah</p>
											<?php endif; ?>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="tab-bottom-left2">
									<div class="header">
										<div class="logo text-center"><img src="assets/img/logo-dark.png" alt="Klorofil Logo"></div>
										<p class="lead">Regis to your account</p>
									</div>
									<form class="form-auth-small" action="" method="POST">
										<div class="form-group">
											<label for="regis-nama" class="control-label sr-only">Nama</label>
											<input type="text" name="nama" class="form-control" id="regis-nama" placeholder="Masukan Nama" required>
										</div>
										<div class="form-group">
											<label for="signin-email" class="control-label sr-only">Email</label>
											<input type="email" name="email" class="form-control" id="signin-email" placeholder="Email">
										</div>
										<div class="form-group">
											<label for="regis-password" class="control-label sr-only">Password</label>
											<input type="password" name="password" class="form-control" id="regis-password" placeholder="Password">
											<div class="form-group clearfix">
												<label class="fancy-checkbox element-left">
													<input type="checkbox" onclick="myFunction('regis-password')">
													<span>Show password</span>
												</label>
											</div>
										</div>

										<button type="submit" name="regis" class="btn btn-primary btn-lg btn-block">Sign Up</button>

									</form>
								</div>
							</div>
							<!-- END TABBED CONTENT -->

						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Free Bootstrap dashboard template</h1>
							<p>by The Develovers</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
	<script>
		function myFunction(hmmmm) {
			var x = document.getElementById(hmmmm);
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script> -->
</body>

</html>