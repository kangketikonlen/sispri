<div class="row">
	<div class="col-12">
		<div class="row justify-content-center">
			<div class="col-lg-4">
				<div class="form-group">
					<input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control form-control-sm" autocomplete="off" value="<?= date('Y-m-d') ?>">
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
		<div class="row">
			<?php $this->load->view('dashboard/components/toi/c_poli') ?>
		</div>
		<div class="row">
			<?php $this->load->view('dashboard/components/toi/c_table') ?>
			<?php $this->load->view('dashboard/components/toi/c_chart') ?>
		</div>
	</div>
</div>
<script>
	$("#filter").click(function() {
		location.reload();
	});
</script>