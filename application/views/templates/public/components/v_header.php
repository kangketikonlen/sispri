<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.ico') ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url('assets/images/logo/favicon.ico') ?>" type="image/x-icon">
	<title><?= strtoupper($Title) ?> - <?= $this->m->get_instansi()->instansi_nama ?></title>
	<link rel="stylesheet" href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
	<link href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/pace-progress/themes/white/pace-theme-material.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/plugins/animate.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/select2/css/select2.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('vendor/almasaeed2010/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
	<style>
		.login-block {
			/* height: 100vh !important; */
			float: left;
			width: 100%;
			padding: 50px;
		}

		.banner-sec {
			background: url(<?= base_url($this->m->get_instansi()->instansi_background) ?>) no-repeat left bottom;
			background-size: cover;
			min-height: 500px;
			border-radius: 0 10px 10px 0;
			padding: 0;
		}

		.container {
			height: 100% !important;
			background: rgba(253, 250, 246);
			border-radius: 10px;
			box-shadow: 15px 20px 0px rgba(0, 0, 0, 0.3);
		}

		.carousel-inner {
			border-radius: 0 10px 10px 0;
		}

		.carousel-caption {
			text-align: left;
			left: 5%;
		}

		.login-sec {
			padding: 50px 30px;
		}

		.login-sec .copy-text i {
			color: dimgrey;
		}

		.login-sec .copy-text a {
			color: dimgrey;
		}

		.login-sec h2 {
			margin-bottom: 30px;
			font-weight: 800;
			font-size: 30px;
			color: dimgrey;
		}

		.login-sec h2:after {
			content: " ";
			width: 100px;
			height: 5px;
			background: dimgrey;
			display: block;
			margin-top: 20px;
			border-radius: 3px;
			margin-left: auto;
			margin-right: auto
		}

		.btn-login {
			background: dimgrey;
			color: #fff;
			font-weight: 600;
		}

		.banner-text {
			width: 70%;
			position: absolute;
			bottom: 15%;
			padding-left: 20px !important;
			background-color: rgba(248, 245, 241, 0.8);
		}

		.banner-text h3 {
			color: dimgrey;
			font-weight: 600;
		}

		.banner-text h3:after {
			content: " ";
			width: 100%;
			height: 5px;
			background: dimgrey;
			display: block;
			margin-top: 20px;
			border-radius: 3px;
		}

		.banner-text p {
			color: dimgrey;
		}

		.swal-modal .swal-text {
			text-align: center;
		}
	</style>
	<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
	<script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js') ?>"></script>
	<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/toastr/toastr.min.js') ?>"></script>
	<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
	<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/pace-progress/pace.min.js') ?>"></script>
	<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/sweetalert.min.js') ?>"></script>
	<script>
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});

		function number_format(nStr) {
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2;
		}

		function tandaPemisahTitik(b) {
			var _minus = false;
			if (b < 0) _minus = true;
			b = b.toString();
			b = b.replace(".", "");
			b = b.replace("-", "");
			c = "";
			panjang = b.length;
			j = 0;
			for (i = panjang; i > 0; i--) {
				j = j + 1;
				if (((j % 3) == 1) && (j != 1)) {
					c = b.substr(i - 1, 1) + "." + c;
				} else {
					c = b.substr(i - 1, 1) + c;
				}
			}
			if (_minus) c = "-" + c;
			return c;
		}

		function numbersonly(ini, e) {
			if (e.keyCode >= 49) {
				if (e.keyCode <= 57) {
					a = ini.value.toString().replace(".", "");
					b = a.replace(/[^\d]/g, "");
					b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
					ini.value = tandaPemisahTitik(b);
					return false;
				} else if (e.keyCode <= 105) {
					if (e.keyCode >= 96) {
						//e.keycode = e.keycode - 47;
						a = ini.value.toString().replace(".", "");
						b = a.replace(/[^\d]/g, "");
						b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
						ini.value = tandaPemisahTitik(b);
						//alert(e.keycode);
						return false;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else if (e.keyCode == 48) {
				a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
				b = a.replace(/[^\d]/g, "");
				if (parseFloat(b) != 0) {
					ini.value = tandaPemisahTitik(b);
					return false;
				} else {
					return false;
				}
			} else if (e.keyCode == 95) {
				a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
				b = a.replace(/[^\d]/g, "");
				if (parseFloat(b) != 0) {
					ini.value = tandaPemisahTitik(b);
					return false;
				} else {
					return false;
				}
			} else if (e.keyCode == 8 || e.keycode == 46) {
				a = ini.value.replace(".", "");
				b = a.replace(/[^\d]/g, "");
				b = b.substr(0, b.length - 1);
				if (tandaPemisahTitik(b) != "") {
					ini.value = tandaPemisahTitik(b);
				} else {
					ini.value = "";
				}

				return false;
			} else if (e.keyCode == 9) {
				return true;
			} else if (e.keyCode == 17) {
				return true;
			} else {
				//alert (e.keyCode);
				return false;
			}

		}
	</script>
</head>