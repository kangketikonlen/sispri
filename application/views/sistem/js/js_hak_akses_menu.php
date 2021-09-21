<script>
	$(document).ready(function() {
		$('#filter_menu_id').select2({
			theme: 'bootstrap4',
			placeholder: '-- FILTER MENU UTAMA --',
			allowClear: true
		});

		$.ajax({
			type: "GET",
			url: "<?= base_url('sistem/menu_utama/options/') ?>",
			beforeSend: function(xhr) {
				$("#overlay").fadeIn(300);
			},
			success: function(data) {
				$("#overlay").fadeOut(300);
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
					$("#filter_menu_id").append('<option value="' + d.id + '">' + d.text + '</option>');
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

		$("#filter_menu_id").change(function() {
			$("#dtTable").DataTable().ajax.reload(function() {
				$("#overlay").fadeOut(300)
			}, true);
		});

		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};

		var table = $("#dtTable").dataTable({
			initComplete: function() {
				$("#overlay").fadeOut(300);
				var api = this.api();
				$('#dtTable_filter input').off('.DT').on('input.DT', function() {
					api.search(this.value).draw();
					$("#overlay").fadeOut(300);
				});
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= base_url('sistem/hak_akses_menu/list_data/') ?>",
				"type": "POST",
				"data": function(d) {
					return $.extend({}, d, {
						'menu_id': $('#filter_menu_id').val(),
					});
				},
				"error": function(xhr, status, error) {
					swal(error, "Terjadi kegagalan saat memuat data. Sepertinya internetmu kurang stabil. Silahkan coba kembali saat internetmu stabil.", "error").then((value) => {
						$("#dtTable").DataTable().ajax.reload(function() {
							$("#overlay").fadeOut(300)
						}, false);
					})
				}
			},
			columns: [{
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
			],
			rowCallback: function(row, data, iDisplayIndex) {
				$("#overlay").fadeOut(300);
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				$('td:eq(0)', row).html();
			}
		});

		$('#Frm').submit(function(e) {
			e.preventDefault();
			swal({
				title: "Anda Yakin Ingin Menyimpan Data?",
				text: "Klik CANCEL jika ingin membatalkan!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if (Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('sistem/hak_akses_menu/simpan/') ?>",
						data: $("#Frm").serialize(),
						timeout: 5000,
						beforeSend: function(xhr) {
							$("#overlay").fadeIn(300);
						},
						success: function(response) {
							$("#overlay").fadeOut(300);
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								if (data.kode == "success") {
									$("#dtTable").DataTable().ajax.reload(function() {
										$("#overlay").fadeOut(300)
									}, false);
									$("#frmData").modal('hide');
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								$("#dtTable").DataTable().ajax.reload(function() {
									$("#overlay").fadeOut(300)
								}, false);
							})
						}
					})
				} else {
					swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
						location.reload();
					})
				}
			});
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
			swal({
				title: "Anda Yakin Ingin Menyimpan Data?",
				text: "Klik CANCEL jika ingin membatalkan!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if (Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('sistem/hak_akses_menu/simpan_menu/') ?>",
						data: $("#FrmSetup").serialize(),
						timeout: 5000,
						beforeSend: function(xhr) {
							$("#overlay").fadeIn(300);
						},
						success: function(response) {
							$("#overlay").fadeOut(300);
							var data = JSON.parse(response);
							swal(data.warning, data.pesan, data.kode).then((value) => {
								if (data.kode == "success") {
									$("#dtTable").DataTable().ajax.reload(function() {
										$("#overlay").fadeOut(300)
									}, false);
									$("#frmSetup").modal('hide');
								}
							})
						},
						error: function(xhr, status, error) {
							swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
								$("#dtTable").DataTable().ajax.reload(function() {
									$("#overlay").fadeOut(300)
								}, false);
							})
						}
					})
				} else {
					swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
						location.reload();
					})
				}
			});
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