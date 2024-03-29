<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">

<head>
	<base href="{{ site_url('assets/templates/backend/./') }}">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
	<title>Login Page</title>
	<!-- Icons-->
	<link href="{{ site_url('assets/templates/backend/vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
	<link href="{{ site_url('assets/templates/backend/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
	<link href="{{ site_url('assets/templates/backend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ site_url('assets/templates/backend/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
	<!-- Main styles for this application-->
	<link href="{{ site_url('assets/templates/backend/css/style.css') }}" rel="stylesheet">
	<link href="{{ site_url('assets/templates/backend/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
<style>
</style>
	<script>
		const SITE_URL = "{{ site_url() }}";
	</script>
</head>

<body class="app flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card-group">
					<div class="card p-2">
						<div class="card-body" style="">
							<form method="POST" id="frm-login">
								<div class="text-center">
									<div class="logo ">
										<img class="img-fluid" style="width: 150px; margin:0px; padding:0px;" src="{{ site_url('assets/images/logo backend edu.png') }}" alt="">
									</div>
									<hr>
									<p style="font-size: 22px; font-family: Segoe UI Emoji, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI, Segoe UI Symbol, Noto Color Emoji;" >
										<strong>Sistem Peminjaman & Inventory Sarana Prasarana</strong>
									</p>

								</div>
								<hr/>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="icon-user"></i>
										</span>
									</div>
									<input required class="form-control" type="text" name="username" id="username" placeholder="Username">
								</div>
								<div class="input-group mb-4">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="icon-lock"></i>
										</span>
									</div>
									<input required class="form-control" type="password" name="password" id="password" placeholder="Password">
								</div>
								<div class="text-center">
									<button class="btn btn-primary btn-block" type="submit">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- CoreUI and necessary plugins-->
	<script src="{{ site_url('assets/templates/backend/vendors/jquery/js/jquery.min.js') }}"></script>
	<script src="{{ site_url('assets/templates/backend/vendors/popper.js/js/popper.min.js') }}"></script>
	<script src="{{ site_url('assets/templates/backend/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ site_url('assets/templates/backend/vendors/pace-progress/js/pace.min.js') }}"></script>
	<script src="{{ site_url('assets/plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

	<script src="{{ site_url('assets/templates/backend/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ site_url('assets/templates/backend/vendors/@coreui/coreui/js/coreui.min.js') }}"></script>

	<script>
		$form = $("#frm-login");
		$inUsername = $("#username");
		$inPassword = $("#password");
		$form.on('submit', function(event) {
			event.preventDefault();

			$.ajax({
					url: SITE_URL + 'auth/doLogin',
					type: 'POST',
					dataType: 'json',
					data: $form.serializeArray(),
				})
				.done(function(res) {
					if (res.status == 'error') {
						Swal.fire({
							title: 'Gagal',
							type: 'error',
							text: 'Login Gagal',
							timer: '1000',
							showCancelButton: false,
							showConfirmButton: false,
							allowOutsideClick: false,
						});
					} else {
						Swal.fire({
								title: 'Berhasil',
								type: 'success',
								text: 'Login berhasil',
								timer: '500',
								showCancelButton: false,
								showConfirmButton: false,
								allowOutsideClick: false,
							})
							.then(r => {
								location.href = SITE_URL + 'private';
							});
					}
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});


		});
	</script>
</body>

</html>