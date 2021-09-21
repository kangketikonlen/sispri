<script>
	bsCustomFileInput.init();

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
			"url": "<?= base_url('sistem/informasi_instansi/list_data/') ?>",
			"type": "POST",
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
			text: "",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((Oke) => {
			if (Oke) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('sistem/informasi_instansi/simpan/') ?>",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
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
		$("#frmData").modal('show');
		jQuery.ajax({
			type: "POST",
			url: "<?= base_url('sistem/informasi_instansi/get_data/') ?>",
			dataType: 'json',
			data: {
				instansi_id: $(this).attr("data")
			},
			beforeSend: function(xhr) {
				$("#overlay").fadeIn(300);
			},
			success: function(data) {
				$("#overlay").fadeOut(300);
				$.each(data, function(key, value) {
					if (key != "instansi_logo" && key != "instansi_background") {
						var ctrl = $('[name=' + key + ']', $('#Frm'));
						switch (ctrl.prop("type")) {
							case "select-one":
								ctrl.val(value).change();
								break;
							default:
								ctrl.val(value);
						}
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

	$(document).on('click', '#hapus', function() {
		swal({
			title: "Anda Yakin Ingin Menghapus Data?",
			text: "",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((Oke) => {
			if (Oke) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('sistem/informasi_instansi/hapus/') ?>",
					data: {
						instansi_id: $(this).attr("data")
					},
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
		})
	});

	$('#FrmUnggah').submit(function(e) {
		e.preventDefault();
		swal({
			title: "Anda Yakin Ingin Import Data?",
			text: "",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((Oke) => {
			if (Oke) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('sistem/informasi_instansi/import/') ?>",
					data: new FormData(this),
					cache: false,
					contentType: false,
					processData: false,
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
						$("#overlay").fadeOut(300);
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
</script>