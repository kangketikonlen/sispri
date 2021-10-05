<div class="row">
	<div class="col-12">
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
					<button id="filter" class="btn btn-sm btn-info">Filter Data</button>
				</div>
			</div>
		</div>
		<div class="row justify-content-around">
			<?php foreach ($poliklinik as $list) : ?>
				<div class="col-lg-3 col-6">
					<div id="poliklinik" class="small-box p-2" style="background:<?= $list->poliklinik_color ?>">
						<div class="inner">
							<h3><span id="<?= $list->poliklinik_kode ?>">0</span> Pasien</h3>
							<p><?= $list->poliklinik_deskripsi ?></p>
						</div>
						<div class="icon">
							<i class="fa <?= $list->poliklinik_icon ?>"></i>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<div class="col-lg-3 col-6">
				<div id="poliklinik" class="small-box p-2" style="background:#E99497">
					<div class="inner">
						<h3><span id="total">0</span> Pasien</h3>
						<p>Total</p>
					</div>
					<div class="icon">
						<i class="fa fa-user"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div id="cTable" class="card" style="height:400px;overflow:scroll">
					<div class="card-header">
						<h5 class="card-title">Tabel <?= $Title ?></h5>
					</div>
					<div class="card-body p-0">
						<div class="chart">
							<table id="dtTable" class="table table-sm table-striped">
								<thead class="bg-success">
									<th class='text-center'>No.</th>
									<th>Dokter</th>
									<th>Pasien</th>
									<th>Poli</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Grafik Lingkaran <?= $Title ?></h5>
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
<?php $this->load->view('dashboard/js/js_rawat_jalan') ?>