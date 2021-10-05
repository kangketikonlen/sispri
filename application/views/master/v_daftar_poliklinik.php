<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<table id="dtTable" class="table table-sm table-bordered">
					<thead>
						<th>No.</th>
						<th>Deskripsi</th>
						<th>Slug</th>
						<th>Color</th>
						<th>Icon</th>
						<th><i class="fa fa-cogs"></i></th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="card-footer">
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#frmData"><i class="fa fa-plus"></i> Tambah Data</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="frmData">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h4 class="modal-title">Formulir <?= $Title ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<?= form_open("#", array('id' => 'Frm')) ?>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="poliklinik_deskripsi">Deskripsi</label>
							<input type="hidden" name="poliklinik_id" id="poliklinik_id">
							<input type="text" name="poliklinik_deskripsi" id="poliklinik_deskripsi" class="form-control form-control-sm" placeholder="Masukkan deksripsi poliklinik..." autocomplete="off" required="true">
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="poliklinik_slug">Query</label>
							<input type="text" name="poliklinik_slug" id="poliklinik_slug" class="form-control form-control-sm" placeholder="Masukkan query api poliklinik..." autocomplete="off" required="true">
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="poliklinik_color">Warna</label>
							<input type="text" name="poliklinik_color" id="poliklinik_color" class="form-control form-control-sm" placeholder="Masukkan deksripsi poliklinik..." autocomplete="off" required="true">
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="poliklinik_icon">Icon</label>
							<input type="text" name="poliklinik_icon" id="poliklinik_icon" class="form-control form-control-sm" placeholder="Masukkan deksripsi poliklinik..." autocomplete="off" required="true">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>
<?php $this->load->view('master/js/js_daftar_poliklinik') ?>