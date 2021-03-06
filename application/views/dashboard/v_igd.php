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
			<?php foreach ($parameter as $list) : ?>
				<div class="col-lg-3 col-6">
					<div id="poliklinik" class="small-box p-1" style="background:<?= $list['background'] ?>" onclick="showModal('<?= $list['deskripsi'] ?>', '<?= $list['query'] ?>')">
						<div class="inner">
							<h4><span id="<?= $list['kode'] ?>">0</span> Pasien</h4>
							<p><?= $list['deskripsi'] ?></p>
						</div>
						<div class="icon">
							<i class="fa <?= $list['icon'] ?>"></i>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div id="cTable" class="card" style="height:400px;overflow:scroll">
					<div class="card-header">
						<h5 class="card-title">Pasien per Diagnosa</h5>
					</div>
					<div class="card-body p-0">
						<div class="chart">
							<table id="dtTable" class="table table-sm table-striped">
								<thead class="bg-success">
									<th class='text-center'>No.</th>
									<th>Diagnosa</th>
									<th>Pasien</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="caraBayar" tabindex="-1" aria-labelledby="caraBayarLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title">Detail Cara Pembayaran Pasien <span id="cb-poli"></span></h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<div id="sktm" class="small-box p-2" style="background:#FF7777">
							<div class="inner">
								<h4><span id="sktm-value">0</span> Pasien</h4>
								<p>SKTM</p>
							</div>
							<div class="icon">
								<i class="fa fa-medkit"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div id="bpjs" class="small-box p-2" style="background:#FDA65D">
							<div class="inner">
								<h4><span id="bpjs-value">0</span> Pasien</h4>
								<p>BPJS</p>
							</div>
							<div class="icon">
								<i class="fa fa-medkit"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div id="tunai" class="small-box p-2 mb-0" style="background:#4E9F3D">
							<div class="inner">
								<h4><span id="tunai-value">0</span> Pasien</h4>
								<p>TUNAI</p>
							</div>
							<div class="icon">
								<i class="fa fa-medkit"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('dashboard/js/js_igd') ?>