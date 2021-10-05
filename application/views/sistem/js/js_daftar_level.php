<script>
	$(document).ready(function() {
		$('#level_type').select2({
			theme: 'bootstrap4',
			placeholder: '-- PILIH TIPE HALAMAN --',
			allowClear: true
		});

		var tableUrl = "<?= base_url('sistem/daftar_level/list_data/') ?>";

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
				"data": "3",
				"searchable": false
			}
		];

		dtTable(tableUrl, listsColumn);

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/daftar_level/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			var dataUrl = "<?= base_url('sistem/daftar_level/get_data/') ?>";
			var reqData = {
				level_id: $(this).attr("data")
			};
			requestEdit(dataUrl, reqData);
		});

		$(document).on('click', '#hapus', function() {
			var dataUrl = "<?= base_url('sistem/daftar_level/hapus/') ?>";
			var dataReq = {
				level_id: $(this).attr("data")
			};
			saveRequest(dataUrl, dataReq);
		});
	});
</script>