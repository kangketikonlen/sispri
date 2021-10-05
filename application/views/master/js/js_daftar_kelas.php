<script>
	$(document).ready(function() {
		// var levelMenu = $('#level_id');
		// var optUrl = "<?= base_url('master/daftar_kelas/options/') ?>";

		// levelMenu.select2({
		// 	theme: 'bootstrap4',
		// 	placeholder: '-- FILTER MENU UTAMA --',
		// 	allowClear: true
		// });

		// fetchOption(optUrl, levelMenu);

		// var tableUrl = "<?= base_url('master/daftar_kelas/list_data/') ?>";

		// var listsColumn = [{
		// 		render: function(data, type, row, meta) {
		// 			return meta.row + meta.settings._iDisplayStart + 1 + ".";
		// 		}
		// 	},
		// 	{
		// 		"data": "1"
		// 	},
		// 	{
		// 		"data": "2"
		// 	},
		// 	{
		// 		"data": "3",
		// 		"searchable": false
		// 	}
		// ];

		// dtTable(tableUrl, listsColumn);

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('master/daftar_kelas/simpan/') ?>";
			var dataReq = new FormData(this);
			updateRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			var dataUrl = "<?= base_url('master/daftar_kelas/get_data/') ?>";
			var reqData = {
				samples_id: $(this).attr("data")
			};
			requestEdit(dataUrl, reqData);
		});

		$(document).on('click', '#hapus', function() {
			e.preventDefault();
			var dataUrl = "<?= base_url('master/daftar_kelas/hapus/') ?>";
			var dataReq = {
				samples_id: $(this).attr("data")
			};
			updateRequest(dataUrl, dataReq);
		});
	});
</script>