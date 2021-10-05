<div class="row justify-content-center">
	<div class="col-lg-6">
		<div class="callout callout-info">
			<h5>Halaman Indikator Pelayanan Ruang <strong><?= $ruangan ?></strong></h5>
			<p>Anda telah memilih ruangan <strong><?= $ruangan ?></strong>. Silahkan pilih salah satu indikator di bawah ini, atau klik kembali ke pilih ruang pada navbar di atas.</p>
		</div>
	</div>
</div>
<div class="row justify-content-around">
	<?php foreach ($indikator as $list) : ?>
		<div class="col-lg-3 col-6">
			<a href="<?= base_url('dashboard/rawat_inap?ruangan=') . $ruangan . '&indikator=' . $list->indikator_kode ?>" class='text-light'>
				<div id="poliklinik" class="small-box p-5 text-center" style="background:<?= $list->indikator_color ?>">
					<div class="inner">
						<h3><?= $list->indikator_deskripsi ?></h3>
					</div>
					<div class="icon">
						<i class="fa <?= $list->indikator_icon ?>"></i>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>
<?php $this->load->view('dashboard/js/js_rawat_inap') ?>