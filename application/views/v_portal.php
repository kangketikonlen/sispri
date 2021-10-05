<div class="d-flex align-items-center" style="min-height: 100vh">
	<div class="col-12 p-0">
		<section class="login-block">
			<div class="container">
				<div class="row h-100">
					<div class="col-md-4 login-sec">
						<h2 class="text-center mb-2">
							Login<br />
							<small style="font-size:80%;font-weight:bold">
								<span class=" d-block d-sm-none justify-content-center pt-1">
									<?= $Instansi->instansi_nama ?>
								</span>
							</small>
						</h2>
						<p class="text-center" style="font-size:small">Silahkan Anda login disini jika sudah memiliki username dan password</p>
						<form id="Frm" class="login-form" method="post">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="user_login" class="text-uppercase">Username</label>
										<input type="text" name="user_login" id="user_login" class="form-control" placeholder="Masukan username di sini..." autocomplete="off" required="true">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label for="user_pass" class="text-uppercase">Password / PIN</label>
										<input type="password" name="user_pass" id="user_pass" class="form-control" placeholder="Masukkan password di sini..." autocomplete="off" required="true">
									</div>
								</div>
								<div class="col-lg-12">
									<button type="submit" class="btn btn-login btn-block">Submit</button>
								</div>
							</div>
						</form><br />
						<div class="text-center mt-1" style="font-size:small">
							<?php if (!empty($Info->info_status_sosmed)) : ?>
								<div class="text-center my-1" style="font-size:small">
									Anda bisa masuk dengan menggunakan link dari platform
									<a href="<?= create_github_url() ?>" class="text-dark"><i class="fab fa-github"></i> Github</a>,
									<a href="<?= create_google_url() ?>" class="text-success"><i class="fab fa-google"></i> Google</a> dan
									<a href="<?= create_twitter_url() ?>" class="text-info"><i class="fab fa-twitter"></i> Twitter</a>
								</div>
							<?php endif ?>
							Crafted with <i class="fa fa-heart text-danger"></i> by <a href="<?= $Info->info_devs_url; ?>" target="_blank"><?= $Info->info_devs; ?></a>.<br /><?= $Info->info_registered; ?> @ <?= date('Y') ?> <span class="d-none d-sm-block">All rights reserved</span>
							<?php if (!empty($Info->info_sponsor)) : ?>
								<span class="d-block d-sm-none justify-content-center pt-1">
									Sponsored by<br /><a href="<?= $Info->info_sponsor_url ?>" target="_blank"><img src="<?= base_url($Info->info_sponsor) ?>" alt="" width="100px"></a>
								</span>
							<?php endif ?>
						</div>
					</div>
					<div class="col-md-8 banner-sec d-none d-sm-block">
						<div class="banner-text rounded-right p-3">
							<div class="d-flex align-items-center">
								<div class="col w-auto">
									<img src="<?= base_url($Instansi->instansi_logo) ?>" alt="" width="100px">
								</div>
								<div class="w-100">
									<h3 style="font-size:150%;text-transform:uppercase"><?= $Info->info_name; ?> <?= $Instansi->instansi_nama ?> <br />
										<small style="font-size:60%;text-transform:capitalize"><?= $Instansi->instansi_alamat ?> (<?= $Instansi->instansi_kontak ?>)</small>
									</h3>
								</div>
							</div>
							<p class="m-0 text-justify">
								Silahkan mengisi formulir di samping menggunakan username dan password yang telah di berikan oleh administrator atau anda buat sebelumnya.
								<?php if (!empty($Info->info_sponsor)) : ?>
									Sistem ini di sponsori oleh : <br />
									<span class="d-flex justify-content-center pt-1">
										<a href="<?= $Info->info_sponsor_url ?>" target="_blank"><img src="<?= base_url($Info->info_sponsor) ?>" alt="" width="200px"></a>
									</span>
								<?php endif ?>
							</p>
						</div>
					</div>
				</div>
		</section>
	</div>
</div>
<script>
	$("#Frm").submit(function(e) {
		e.preventDefault();
		var form = $(this);
		var url = "<?= base_url('portal/proses_login') ?>";
		$.ajax({
			type: "POST",
			url: url,
			data: form.serialize(),
			beforeSend: function() {
				Pace.restart();
			},
			success: function(data) {
				var response = JSON.parse(data);
				swal(response.warning, response.pesan, response.kode).then((value) => {
					if (response.kode == "success") {
						location.reload();
					}
				})
			},
			error: function(xhr, httpStatusMessage, customErrorMessage) {
				$.toast({
					text: "Terjadi kesalahan! " + xhr.status + " " + xhr.statusText,
					bgColor: '#011627'
				});
			}
		})
	})
</script>