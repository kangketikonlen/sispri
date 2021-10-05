<script>
	bsCustomFileInput.init();

	var tableUrl = "<?= base_url('sistem/informasi_instansi/list_data/') ?>";

	var listsColumn = [{
			render: function(data, type, row, meta) {
				return meta.row + meta.settings._iDisplayStart + 1 + ".";
			}
		},
		{
			"data": "1"
		},
		{
			"data": "2"
		},
		{
			"data": "3"
		},
		{
			"data": "4"
		},
		{
			"data": "5",
			"searchable": false
		}
	];

	dtTable(tableUrl, listsColumn);

	$('#Frm').submit(function(e) {
		e.preventDefault();
		var dataUrl = "<?= base_url('sistem/informasi_instansi/simpan/') ?>";
		var dataReq = new FormData(this);
		saveRequest(dataUrl, dataReq);
	});

	$(document).on('click', '#edit', function() {
		$("#frmData").modal('show');
		var dataUrl = "<?= base_url('sistem/informasi_instansi/get_data/') ?>";
		var reqData = {
			instansi_id: $(this).attr("data")
		};
		requestEdit(dataUrl, reqData);
	});

	$(document).on('click', '#hapus', function() {
		var dataUrl = "<?= base_url('sistem/informasi_instansi/hapus/') ?>";
		var dataReq = {
			instansi_id: $(this).attr("data")
		};
		saveRequest(dataUrl, dataReq);
	});

	$('#FrmUnggah').submit(function(e) {
		e.preventDefault();
		var dataUrl = "<?= base_url('sistem/informasi_instansi/import/') ?>";
		var dataReq = new FormData(this);
		importRequest(dataUrl, dataReq);
	});
</script>