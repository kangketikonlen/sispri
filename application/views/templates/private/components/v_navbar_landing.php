<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
	<a href="<?= base_url() ?>" class="navbar-brand">
		<i class="fa fa-info-circle brand-logo"></i>
		<span class="brand-text font-weight-light"><?= $this->session->userdata('AppInfo') ?></span>
	</a>

	<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Right navbar links -->
	<ul class="order-1 order-md-3 navbar-nav navbar-no-expand">
		<?php if ($this->session->userdata('level_tmp')) : ?>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('dashboard/landing/reset_akses') ?>" role="button"><i class="fa fa-home"></i> Halaman Utama</a>
			</li>
		<?php endif ?>
		<?php if (!empty($this->input->get('ruangan'))) : ?>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('dashboard/rawat_inap?') ?>" role="button"><i class="fa fa-chevron-circle-left"></i> Kembali ke Pilih Ruang</a>
			</li>
		<?php endif ?>
		<?php if (!empty($this->input->get('indikator'))) : ?>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('dashboard/rawat_inap?ruangan=') . $this->input->get('ruangan') ?>" role="button"><i class="fa fa-chevron-circle-left"></i> Kembali ke Indikator</a>
			</li>
		<?php endif ?>
	</ul>

	<!-- Right navbar links -->
	<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
		<li class="nav-item">
			<a id="updateDB" class="nav-link" href="#" role="button"><i class="fa fa-database"></i> Update</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('dashboard/landing/logout') ?>" role="button"><i class="fa fa-sign-out-alt"></i> Keluar</a>
		</li>
	</ul>
</nav>