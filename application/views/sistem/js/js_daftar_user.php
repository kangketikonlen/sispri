<script>
	$(document).ready(function() {
		$('#level_id').select2({
			theme: 'bootstrap4',
			placeholder: '-- PILIH LEVEL --',
			allowClear: true
		});

		$.ajax({
			type: "GET",
			url: "<?= base_url('sistem/daftar_level/options/') ?>",
			beforeSend: function(xhr) {
				$("#overlay").fadeIn(300);
			},
			success: function(data) {
				$("#overlay").fadeOut(300);
				var opts = $.parseJSON(data);
				$.each(opts, function(i, d) {
					$("#level_id").append('<option value="' + d.id + '">' + d.text + '</option>');
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
				"url": "<?= base_url('sistem/daftar_user/list_data/') ?>",
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
				text: "Klik CANCEL jika ingin membatalkan!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if (Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('sistem/daftar_user/simpan/') ?>",
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

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			jQuery.ajax({
				type: "POST",
				url: "<?= base_url('sistem/daftar_user/get_data/') ?>",
				dataType: 'json',
				data: {
					user_id: $(this).attr("data")
				},
				beforeSend: function(xhr) {
					$("#overlay").fadeIn(300);
				},
				success: function(data) {
					$("#overlay").fadeOut(300);
					$.each(data, function(key, value) {
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

		$(document).on('click', '#hapus', function() {
			swal({
				title: "Anda Yakin Ingin Menghapus Data?",
				text: "Klik CANCEL jika ingin membatalkan!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if (Oke) {
					$.ajax({
						type: "POST",
						url: "<?= base_url('sistem/daftar_user/hapus/') ?>",
						data: {
							user_id: $(this).attr("data")
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

		$(document).on('click', '#random-pass', function() {
			swal({
				title: "Anda Yakin Ingin Membuat Password Acak?",
				text: "Klik CANCEL jika ingin membatalkan!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if (Oke) {
					var pass = "PWD" + Math.floor(Math.random() * (999 - 100)) + 100;
					$("#user_pass_baru").val(pass);
					$("#user_pass_baru").attr('type', 'text');
				} else {
					swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

	});
</script>