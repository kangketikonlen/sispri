<script>
	$(document).ready(function() {
		var url = "<?= base_url('dashboard/igd/jumlah_pasien?') ?>";
		var urlTable = "<?= base_url('dashboard/igd/get_table?') ?>";
		var tgl_awal = $("#tanggal_awal").val();
		var tgl_akhir = $("#tanggal_akhir").val();
		// 
		getData(url, tgl_awal, tgl_akhir);
		get_table(urlTable, tgl_awal, tgl_akhir);
		// 
		$("#filter").click(function() {
			tgl_awal = $("#tanggal_awal").val();
			tgl_akhir = $("#tanggal_akhir").val();
			getData(url, tgl_awal, tgl_akhir);
			get_table(urlTable, tgl_awal, tgl_akhir);
		});
	});

	function getData(url, tgl_awal, tgl_akhir) {
		var request = "tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir;
		requestGet(url + request).then(function(results) {
			var data = JSON.parse(results);
			$.each(data, function(i, d) {
				$("#" + i).text(number_format(d));
			});
		});
	}

	function get_table(url, tgl_awal, tgl_akhir) {
		$("#dtTable tbody").empty();
		var request = "tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir;
		$.ajax({
			url: url + request,
			method: "GET",
			success: function(data) {
				var opts = JSON.parse(data);
				$.each(opts, function(key, dt) {
					for (let i = 0; i < dt.length; i++) {
						$("#dtTable tbody").append(
							"<tr>" +
							"<td class='text-center'>" + (i + 1) + "</td>" +
							"<td>" + dt[i].diagnosa + "</td>" +
							"<td class='text-right'>" + number_format(dt[i].pasien) + "</td>" +
							"</tr>"
						);
					}
				});
			}
		});
	}
</script>