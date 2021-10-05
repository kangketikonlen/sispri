function tanggal_indonesian(tgl) {
	var parts = tgl.split('-');
	var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
	var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	var tanggal = new Date(parts[0], parts[1] - 1, parts[2]).getDate();
	var _hari = new Date(parts[0], parts[1] - 1, parts[2]).getDay();
	var _bulan = new Date(parts[0], parts[1] - 1, parts[2]).getMonth();
	var _tahun = new Date(parts[0], parts[1] - 1, parts[2]).getFullYear();
	var hari = hari[_hari];
	var bulan = bulan[_bulan];
	var tahun = (_tahun < 1000) ? _tahun + 1900 : _tahun;
	return hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun;
}

function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function number_format(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();
	$("#overlay").fadeOut(300);
	$('.modal').on('hidden.bs.modal', function () {
		$(this).find('form').trigger('reset');
		$(this).find('select').val('').trigger('change');
		$('#Frm').find('input:checkbox').removeAttr('checked');
		$('#Frm').find('input').removeAttr('disabled');
		$('#Frm').find('select').removeAttr('disabled');
		$('#Frm').find('#simpan').removeAttr('disabled');
		$('#Frm').find('input').val('');
	});
});

function dtTable(dataUrl, listsColumn) {
	$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
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

	$("#dtTable").dataTable({
		initComplete: function () {
			$("#overlay").fadeOut(300);
			var api = this.api();
			$('#dtTable_filter input').off('.DT').on('input.DT', function () {
				api.search(this.value).draw();
				$("#overlay").fadeOut(300);
			});
		},
		processing: true,
		serverSide: true,
		ajax: {
			"url": dataUrl,
			"type": "POST",
			"error": function (xhr, status, error) {
				swal(error, "Terjadi kegagalan saat memuat data. Sepertinya internetmu kurang stabil. Silahkan coba kembali saat internetmu stabil.", "error").then((value) => {
					$("#dtTable").DataTable().ajax.reload(function () {
						$("#overlay").fadeOut(300)
					}, false);
				})
			}
		},
		columns: listsColumn,
		rowCallback: function (row, data, iDisplayIndex) {
			$("#overlay").fadeOut(300);
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			$('td:eq(0)', row).html();
		}
	});
}

function fetchOption(optUrl, optId) {
	$.ajax({
		type: "GET",
		url: optUrl,
		beforeSend: function (xhr) {
			$("#overlay").fadeIn(300);
		},
		success: function (data) {
			$("#overlay").fadeOut(300);
			var opts = $.parseJSON(data);
			$.each(opts, function (i, d) {
				optId.append('<option value="' + d.id + '">' + d.text + '</option>');
			});
		},
		error: function (xhr, status, error) {
			swal(error, "Terjadi kegagalan saat memuat data. Sepertinya internetmu kurang stabil. Silahkan coba kembali saat internetmu stabil.", "error").then((value) => {
				$("#dtTable").DataTable().ajax.reload(function () {
					$("#overlay").fadeOut(300)
				}, false);
			})
		}
	});
}

function requestGet(dataUrl, dataReq) {
	return new Promise(function (resolve, reject) {
		var xhr = new XMLHttpRequest();
		xhr.onload = function () {
			resolve(this.responseText);
		};
		xhr.onerror = reject;
		xhr.open('GET', dataUrl);
		xhr.setRequestHeader("Content-type", "application/json");
		xhr.send(dataReq);
	});
}

function requestPost(dataUrl, dataReq) {
	$.ajax({
		type: "POST",
		url: dataUrl,
		data: dataReq,
		processData: false,
		contentType: false,
		cache: false,
		beforeSend: function (xhr) {
			$("#overlay").fadeIn(300);
		},
		success: function (response) {
			$("#overlay").fadeOut(300);
			var data = JSON.parse(response);
			swal(data.warning, data.pesan, data.kode).then((value) => {
				if (data.kode == "success") {
					$("#dtTable").DataTable().ajax.reload(function () {
						$("#overlay").fadeOut(300)
					}, false);
					$("#frmData").modal('hide');
				}
			})
		},
		error: function (xhr, status, error) {
			swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
				$("#dtTable").DataTable().ajax.reload(function () {
					$("#overlay").fadeOut(300)
				}, false);
			})
		}
	})
}

function requestNormalPost(dataUrl, dataReq) {
	$.ajax({
		type: "POST",
		url: dataUrl,
		data: dataReq,
		beforeSend: function (xhr) {
			$("#overlay").fadeIn(300);
		},
		success: function (response) {
			$("#overlay").fadeOut(300);
			var data = JSON.parse(response);
			swal(data.warning, data.pesan, data.kode).then((value) => {
				if (data.kode == "success") {
					$("#dtTable").DataTable().ajax.reload(function () {
						$("#overlay").fadeOut(300)
					}, false);
					$("#frmData").modal('hide');
				}
			})
		},
		error: function (xhr, status, error) {
			swal(error, "Please Ask Support or Refresh the Page!", "error").then((value) => {
				$("#dtTable").DataTable().ajax.reload(function () {
					$("#overlay").fadeOut(300)
				}, false);
			})
		}
	})
}

function requestEdit(dataUrl, reqData) {
	jQuery.ajax({
		type: "POST",
		url: dataUrl,
		dataType: 'json',
		data: reqData,
		beforeSend: function (xhr) {
			$("#overlay").fadeIn(300);
		},
		success: function (data) {
			$("#overlay").fadeOut(300);
			$.each(data, function (key, value) {
				var ctrl = $('[name=' + key + ']', $('#Frm'));
				if (ctrl.prop("type") != "file") {
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
		error: function (xhr, status, error) {
			swal(error, "Terjadi kegagalan saat memuat data. Sepertinya internetmu kurang stabil. Silahkan coba kembali saat internetmu stabil.", "error").then((value) => {
				$("#dtTable").DataTable().ajax.reload(function () {
					$("#overlay").fadeOut(300)
				}, false);
			})
		}
	});
}

function saveRequest(dataUrl, dataReq) {
	swal({
		title: "Anda Yakin Ingin Menyimpan Data?",
		text: "Klik CANCEL jika ingin membatalkan!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((Oke) => {
		if (Oke) {
			requestPost(dataUrl, dataReq);
		} else {
			swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
				location.reload();
			})
		}
	});
}

function updateRequest(dataUrl, dataReq) {
	swal({
		title: "Anda Yakin Ingin Merubah Data?",
		text: "Klik CANCEL jika ingin membatalkan!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((Oke) => {
		if (Oke) {
			requestNormalPost(dataUrl, dataReq);
		} else {
			swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
				location.reload();
			})
		}
	});
}

function deleteRequest(dataUrl, dataReq) {
	swal({
		title: "Anda Yakin Ingin Menghapus Data?",
		text: "Klik CANCEL jika ingin membatalkan!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((Oke) => {
		if (Oke) {
			requestPost(dataUrl, dataReq);
		} else {
			swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
				location.reload();
			})
		}
	})
}

function importRequest(dataUrl, dataReq) {
	swal({
		title: "Anda Yakin Ingin Import Data?",
		text: "",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((Oke) => {
		if (Oke) {
			requestPost(dataUrl, dataReq);
		} else {
			swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
				location.reload();
			})
		}
	});
}