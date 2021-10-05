<script>
	var tableUrl = "<?= base_url('sistem/hak_akses_modul/list_data/') ?>";

	var listsColumn = [{
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
	];

	dtTable(tableUrl, listsColumn);

	$('input[type=checkbox]').click(function() {
		if ($(this).is(':checked')) {
			$("#level_show_landing").val($("#level_show_landing").val() + "," + $(this).val());
		} else {
			$("#level_show_landing").val($("#level_show_landing").val().replace("," + $(this).val(), ""));
		}
	});

	$('#Frm').submit(function(e) {
		e.preventDefault();
		var dataUrl = "<?= base_url('sistem/hak_akses_modul/simpan/') ?>";
		var dataReq = new FormData(this);
		saveRequest(dataUrl, dataReq);
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