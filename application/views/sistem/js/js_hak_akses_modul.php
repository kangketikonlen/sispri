<script>
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
			"url": "<?= base_url('sistem/hak_akses_modul/list_data/') ?>",
			"type": "POST",
			"beforeSend": function(xhr) {
				$("#overlay").fadeIn(300);
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
				"data": "2",
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

	$('input[type=checkbox]').click(function() {
		if ($(this).is(':checked')) {
			$("#level_show_landing").val($("#level_show_landing").val() + "," + $(this).val());
		} else {
			$("#level_show_landing").val($("#level_show_landing").val().replace("," + $(this).val(), ""));
		}
	});

	$('#Frm').submit(function(e) {
		e.preventDefault();
		swal({
			title: "Anda Yakin Ingin Menyimpan Data?",
			text: "",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((Oke) => {
			if (Oke) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('sistem/hak_akses_modul/simpan/') ?>",
					data: $("#Frm").serialize(),
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

	$(document).on('click', '#edit', function() {
		$("#frmData").modal();
		jQuery.ajax({
			type: "POST",
			url: "<?= base_url('sistem/hak_akses_modul/get_data/') ?>",
			dataType: 'json',
			data: {
				level_id: $(this).attr("data")
			},
			beforeSend: function(xhr) {
				$("#overlay").fadeIn(300);
			},
			success: function(data) {
				$("#overlay").fadeOut(300);
				split = data.level_show_landing.split(",");
				$.each(split, function(key, value) {
					ident = $("#level_show_landing_" + value);
					ident.prop('checked', true);
					console.log(value)
				})
				var n = $('input[type=checkbox]').length + 1;
				for (i = 1; i <= n; i++) {
					$("#level_show_landing_" + i).val(i);
				}
				$.each(data, function(key, value) {
					if (key == "level_nama") {
						$("#level_nama").text(">" + value + "<");
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
</script>