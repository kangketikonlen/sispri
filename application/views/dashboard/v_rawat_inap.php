<div class="row justify-content-center">
	<div class="col-lg-4">
		<div class="form-group">
			<input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control form-control-sm" autocomplete="off" value="<?= date('Y-m-01') ?>">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control form-control-sm" autocomplete="off" value="<?= date('Y-m-d') ?>">
		</div>
	</div>
	<div class="col-lg-1">
		<div class="form-group">
			<button id="filter" class="btn btn-sm btn-success">Filter Data</button>
		</div>
	</div>
</div>
<div class="row justify-content-around">
	<?php $i = 0; ?>
	<?php foreach ($ruangan as $list) : ?>
		<div class="col-lg-3 col-6">
			<a href="<?= base_url('dashboard/rawat_inap?ruangan=') . urlencode($list->nama_ruang) ?>" class='text-light'>
				<div id="poliklinik" class="small-box" style="background: <?= ($i++ % 2 == 0) ? '#39A388' : '#6ECB63'; ?>">
					<div class="inner">
						<h4><?= $list->nama_ruang ?></h4>
						<p><span id="<?= $list->id ?>">0</span> Pasien</p>
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