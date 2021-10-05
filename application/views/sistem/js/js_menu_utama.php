<script>
	$(document).ready(function() {
		var tableUrl = "<?= base_url('sistem/menu_utama/list_data/') ?>";

		var listsColumn = [{
				"data": "1"
			},
			{
				"data": "2"
			},
			{
				"data": "3"
			},
			{
				"data": "4",
				"searchable": false
			}
		];

		dtTable(tableUrl, listsColumn);

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/menu_utama/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			var dataUrl = "<?= base_url('sistem/menu_utama/get_data/') ?>";
			var reqData = {
				menu_id: $(this).attr("data")
			};
			requestEdit(dataUrl, reqData);
		});

		$(document).on('click', '#hapus', function() {
			var dataUrl = "<?= base_url('sistem/menu_utama/hapus/') ?>";
			var dataReq = {
				menu_id: $(this).attr("data")
			};
			saveRequest(dataUrl, dataReq);
		});
	});
</script>