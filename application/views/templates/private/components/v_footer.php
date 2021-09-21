<footer class="main-footer">
	<strong>Copyright &copy; <?= date('Y') ?> <a href="<?= $this->session->userdata('UrlDev') ?>"><?= $this->session->userdata('DevInfo') ?></a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> <?= CI_VERSION ?> | Halaman dimuat dalam {elapsed_time} detik
	</div>
</footer>