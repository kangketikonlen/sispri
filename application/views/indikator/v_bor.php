<div class="row">
	<div class="col-12">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="callout callout-success">
					<h5>Halaman Indikator <strong><?= strtoupper($indikator) ?></strong> Ruang <strong><?= $ruangan ?></strong></h5>
					<p>Anda telah memilih ruangan <strong><?= $ruangan ?></strong> dengan indikator <strong><?= strtoupper($indikator) ?></strong>. Silahkan ubah atau filter data periode menggunakan form di bawah ini, atau klik kembali ke pilih ruang atau indikator pada navbar di atas.</p>
				</div>
			</div>
		</div>
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
			<?php foreach ($kelas as $list) : ?>
				<div class="col-lg-3 col-6">
					<div id="kelas" class="small-box p-2" style="background: <?= ($i++ % 2 == 0) ? '#39A388' : '#6ECB63'; ?>">
						<div class="inner">
							<h3><span id="<?= $list->id ?>">0</span>%</h3>
							<p>Kelas <?= $list->kelas ?></p>
						</div>
						<div class="icon">
							<i class="fa fa-procedures"></i>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div id="cTable" class="card card-success" style="height:400px;overflow:scroll">
					<div class="card-header">
						<h5 class="card-title">Tabel <?= strtoupper($indikator) . ' ' . $ruangan ?></h5>
					</div>
					<div class="card-body p-0">
						<div class="chart">
							<table id="dtTable" class="table table-sm table-striped">
								<thead class="bg-secondary">
									<th>Kelas</th>
									<th class='text-right'>Kapasitas</th>
									<th class='text-right'>Periode</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-success">
					<div class="card-header">
						<h5 class="card-title">Grafik Lingkaran <?= strtoupper($indikator) . ' ' . $ruangan ?></h5>
					</div>
					<div class="card-body">
						<div class="chart">
							<canvas id="pieChart" class="text-light"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('indikator/js/js_bor') ?>