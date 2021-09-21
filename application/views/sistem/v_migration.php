<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<?= form_open("#", array('id' => 'Frm')) ?>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="migration_name">Nama File</label>
							<input type="text" name="migration_name" id="migration_name" class="form-control form-control-sm" placeholder="Masukkan nama file..." autocomplete="off" required="true">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="migration_database">Nama Database</label>
							<input type="text" name="migration_database" id="migration_database" class="form-control form-control-sm" placeholder="Masukkan nama database..." autocomplete="off" required="true">
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-pen-square"></i> Create File</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<?php $this->load->view('sistem/js/js_migration') ?>