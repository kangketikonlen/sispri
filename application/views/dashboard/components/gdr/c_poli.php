<?php foreach ($poli as $lists) : ?>
	<div class="col-lg-3 col-6">
		<div class="small-box p-2" style="background:#<?= $lists->poli_color ?>">
			<div class="inner">
				<h3><?= rand(0, 50) ?> Pasien</h3>
				<p><?= $lists->poli_deskripsi ?></p>
			</div>
			<div class="icon">
				<i class="fa <?= $lists->poli_icon ?>"></i>
			</div>
		</div>
	</div>
<?php endforeach ?>
<div class="col-lg-3 col-6">
	<div class="small-box p-2" style="background:#B97A95">
		<div class="inner">
			<h3><?= rand(0, 50) ?> Pasien</h3>
			<p>Total</p>
		</div>
		<div class="icon">
			<i class="fa fa-book-medical"></i>
		</div>
	</div>
</div>