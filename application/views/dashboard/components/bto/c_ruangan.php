<?php foreach ($ruangan as $lists) : ?>
	<div class="col-lg-3 col-6">
		<div class="small-box p-2" style="background:#<?= $this->m->colors() ?>">
			<div class="inner">
				<h3><?= rand(0, 100) ?>%</h3>
				<p>Ruang <?= $lists->nama_ruang ?>, kelas <?= $lists->kelas ?></p>
			</div>
			<div class="icon">
				<i class="fa fa-print"></i>
			</div>
		</div>
	</div>
<?php endforeach ?>
<div class="col-lg-3 col-6">
	<div class="small-box p-2" style="background:#B97A95">
		<div class="inner">
			<h3><?= rand(0, 100) ?>%</h3>
			<p>Total</p>
		</div>
		<div class="icon">
			<i class="fa fa-book-medical"></i>
		</div>
	</div>
</div>