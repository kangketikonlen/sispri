<script>
	$(document).ready(function() {
		var tableUrl = "<?= base_url('master/daftar_poliklinik/list_data/') ?>";

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
				"searchable": false,
				"orderable": false
			}
		];

		dtTable(tableUrl, listsColumn);

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('master/daftar_poliklinik/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			var dataUrl = "<?= base_url('master/daftar_poliklinik/get_data/') ?>";
			var reqData = {
				poliklinik_id: $(this).attr("data")
			};
			requestEdit(dataUrl, reqData);
		});

		$(document).on('click', '#hapus', function() {
			e.preventDefault();
			var dataUrl = "<?= base_url('master/daftar_poliklinik/hapus/') ?>";
			var dataReq = {
				poliklinik_id: $(this).attr("data")
			};
			updateRequest(dataUrl, dataReq);
		});
	});
</script>