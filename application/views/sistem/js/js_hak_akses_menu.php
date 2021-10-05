<script>
	$(document).ready(function() {
		var filterMenu = $("#filter_menu_id");
		var optUrl = "<?= base_url('sistem/menu_utama/options/') ?>";

		filterMenu.select2({
			theme: 'bootstrap4',
			placeholder: '-- FILTER MENU UTAMA --',
			allowClear: true
		});

		fetchOption(optUrl, filterMenu);

		var tableUrl = "<?= base_url('sistem/hak_akses_menu/list_data/') ?>";

		var tableReq = {
			'menu_id': filterMenu.val(),
		};

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

		dtTable(tableUrl, listsColumn, tableReq);

		filterMenu.change(function() {
			$("#dtTable").DataTable().ajax.url(tableUrl + "?menu_id=" + $(this).val()).load();
		});

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/hak_akses_menu/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$('input[type=checkbox]').click(function() {
			if ($(this).is(':checked')) {
				$("#submenu_roles").val($("#submenu_roles").val() + "," + $(this).val());
			} else {
				$("#submenu_roles").val($("#submenu_roles").val().replace("," + $(this).val(), ""));
			}
		});

		$('#FrmSetup').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/hak_akses_menu/simpan_menu/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$('input[type=checkbox]').click(function() {
			if ($(this).is(':checked')) {
				$("#menu_roles").val($("#menu_roles").val() + "," + $(this).val());
			} else {
				$("#menu_roles").val($("#menu_roles").val().replace("," + $(this).val(), ""));
			}
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			jQuery.ajax({
				type: "POST",
				url: "<?= base_url('sistem/hak_akses_menu/get_data/') ?>",
				dataType: 'json',
				data: {
					submenu_id: $(this).attr("data")
				},
				beforeSend: function(xhr) {
					$("#overlay").fadeIn(300);
				},
				success: function(data) {
					$("#overlay").fadeOut(300);
					split = data.submenu_roles.split(",");
					$.each(split, function(key, value) {
						ident = $("#submenu_roles_" + value);
						ident.prop('checked', true);
					})
					var n = $('input[type=checkbox]').length + 1;
					for (i = 1; i <= n; i++) {
						$("#submenu_roles_" + i).val(i);
					}
					$.each(data, function(key, value) {
						if (key == "submenu_nama") {
							$("#submenu_nama").text(">" + value + "<");
						}
						var ctrl = $('[name=' + key + ']', $('#Frm'));
						switch (ctrl.prop("type")) {
							case "select-one":
								ctrl.val(value).change();
								break;
							default:
								ctrl.val(value);
						}
					});
				},
				error: function(xhr, status, error) {
					swal(error, "Terjadi kegagalan saat memuat data. Sepertinya internetmu kurang stabil. Silahkan coba kembali saat internetmu stabil.", "error").then((value) => {
						$("#dtTable").DataTable().ajax.reload(function() {
							$("#overlay").fadeOut(300)
						}, false);
					})
				}
			});
		});

		$(document).on('click', '#setup', function() {
			$("#frmSetup").modal('show');
			jQuery.ajax({
				type: "POST",
				url: "<?= base_url('sistem/hak_akses_menu/get_data_menu/') ?>",
				dataType: 'json',
				data: {
					menu_id: $(this).attr("data")
				},
				beforeSend: function(xhr) {
					$("#overlay").fadeIn(300);
				},
				success: function(data) {
					$("#overlay").fadeOut(300);
					split = data.menu_roles.split(",");
					$.each(split, function(key, value) {
						ident = $("#menu_roles_" + value);
						ident.prop('checked', true);
					})
					var n = $('input[type=checkbox]').length + 1;
					for (i = 1; i <= n; i++) {
						$("#menu_roles_" + i).val(i);
					}
					$.each(data, function(key, value) {
						if (key == "menu_nama") {
							$("#menu_nama").text(">" + value + "<");
						}
						var ctrl = $('[name=' + key + ']', $('#FrmSetup'));
						switch (ctrl.prop("type")) {
							case "select-one":
								ctrl.val(value).change();
								break;
							default:
								ctrl.val(value);
						}
					});
				},
				error: function(xhr, status, error) {
					swal(error, "Terjadi kegagalan saat memuat data. Sepertinya internetmu kurang stabil. Silahkan coba kembali saat internetmu stabil.", "error").then((value) => {
						$("#dtTable").DataTable().ajax.reload(function() {
							$("#overlay").fadeOut(300)
						}, false);
					})
				}
			});
		});
	});
</script>