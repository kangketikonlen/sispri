<script>
	$(document).ready(function() {
		var menuId = $("#menu_id");
		var filterMenu = $("#filter_menu_id");
		var optUrl = "<?= base_url('sistem/menu_utama/options/') ?>";

		menuId.select2({
			theme: 'bootstrap4',
			placeholder: '-- PILIH MENU UTAMA --',
			allowClear: true
		});

		fetchOption(optUrl, menuId);

		filterMenu.select2({
			theme: 'bootstrap4',
			placeholder: '-- FILTER MENU UTAMA --',
			allowClear: true
		});

		fetchOption(optUrl, filterMenu);

		$('#frmData').on('show.bs.modal', function(event) {
			var modal = $(this)
			var data = filterMenu.val();
			modal.find('#menu_id').val(data).change();
		})

		var tableUrl = "<?= base_url('sistem/submenu/list_data/') ?>";

		function dataParam(d) {
			return $.extend({}, d, {
				"menu_id": filterMenu.val()
			});
		}

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
				"data": "4"
			},
			{
				"data": "5"
			},
			{
				"data": "6",
				"searchable": false
			}
		];

		dtTable(tableUrl, listsColumn, dataParam);

		filterMenu.change(function() {
			$("#dtTable").DataTable().ajax.url(tableUrl + "?menu_id=" + $(this).val()).load();
		});

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/submenu/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			var dataUrl = "<?= base_url('sistem/submenu/get_data/') ?>";
			var reqData = {
				submenu_id: $(this).attr("data")
			};
			requestEdit(dataUrl, reqData);
		});

		$(document).on('click', '#hapus', function() {
			var dataUrl = "<?= base_url('sistem/submenu/hapus/') ?>";
			var dataReq = {
				submenu_id: $(this).attr("data")
			};
			saveRequest(dataUrl, dataReq);
		});
	});
</script>