<div class="row justify-content-around">
	<?php $i = 0; ?>
	<?php foreach ($ruangan as $list) : ?>
		<div class="col-lg-3 col-6">
			<a href="<?= base_url('dashboard/rawat_inap?ruangan=') . urlencode($list->nama_ruang) ?>" class='text-light'>
				<div id="poliklinik" class="small-box p-5 text-center" style="background: <?= ($i++ % 2 == 0) ? '#39A388' : '#6ECB63'; ?>">
					<div class="inner">
						<h3><?= $list->nama_ruang ?></h3>
					</div>
					<div class="icon">
						<i class="fa fa-procedures"></i>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>
<?php $this->load->view('dashboard/js/js_rawat_inap') ?>