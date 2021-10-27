<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		var url = "<?= base_url('dashboard/rawat_jalan/jumlah_pasien?') ?>";
		var urlChart = "<?= base_url('dashboard/rawat_jalan/chart_data?') ?>";
		var urlTable = "<?= base_url('dashboard/rawat_jalan/get_table?') ?>";
		var tgl_awal = $("#tanggal_awal").val();
		var tgl_akhir = $("#tanggal_akhir").val();
		// 
		getData(url, tgl_awal, tgl_akhir);
		get_chart(urlChart, tgl_awal, tgl_akhir);
		get_table(urlTable, tgl_awal, tgl_akhir);
		// 
		$("#filter").click(function() {
			tgl_awal = $("#tanggal_awal").val();
			tgl_akhir = $("#tanggal_akhir").val();
			getData(url, tgl_awal, tgl_akhir);
			get_chart(urlChart, tgl_awal, tgl_akhir);
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

	function get_chart(url, tgl_awal, tgl_akhir) {
		var request = "tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir;
		$.ajax({
			url: url + request,
			method: "GET",
			success: function(response) {
				var data = JSON.parse(response)
				$("#pieChart").height($("#cTable").height() - 85);
				var donutData = {
					labels: data.labels,
					datasets: [{
						data: data.data,
						backgroundColor: data.backgroundColor,
					}]
				}
				var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
				var pieData = donutData;
				var pieOptions = {
					maintainAspectRatio: false,
					responsive: true,
					legend: {
						labels: {
							fontColor: "white",
						}
					},
				}
				new Chart(pieChartCanvas, {
					type: 'pie',
					data: pieData,
					options: pieOptions
				})
			}
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
					$("#dtTable tbody").append(
						"<tr>" +
						"<td id='" + key + "' colspan='4' class='bg-info'><strong>" + key + "</strong></td>" +
						"</tr>"
					);
					for (let i = 0; i < dt.length; i++) {
						$("#dtTable tbody").append(
							"<tr>" +
							"<td class='text-center'>" + (i + 1) + "</td>" +
							"<td>" + dt[i].dokter + "</td>" +
							"<td class='text-right'>" + number_format(dt[i].pasien) + "</td>" +
							"<td>" + dt[i].poliklinik + "</td>" +
							"</tr>"
						);
					}
				});
			}
		});
	}

	function showModal(slug, deskripsi) {
		$('#caraBayar').modal({
			backdrop: "static",
			keyboard: false
		})
		$("#cb-poli", $('#caraBayar')).html(deskripsi)
		// 
		var tgl_awal = $("#tanggal_awal").val();
		var tgl_akhir = $("#tanggal_akhir").val();
		// 
		var url_sktm = "<?= base_url('dashboard/rawat_jalan/jumlah_pembayaran_sktm?') ?>";
		var url_bpjs = "<?= base_url('dashboard/rawat_jalan/jumlah_pembayaran_bpjs?') ?>";
		var url_tunai = "<?= base_url('dashboard/rawat_jalan/jumlah_pembayaran_tunai?') ?>";
		// 
		var request = "poli=" + slug + "&tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir;
		// 
		requestGet(url_sktm + request).then(function(results) {
			$("#sktm-value").html(results)
		});
		// 
		requestGet(url_bpjs + request).then(function(results) {
			$("#bpjs-value").html(results)
		});
		// 
		requestGet(url_tunai + request).then(function(results) {
			$("#tunai-value").html(results)
		});
	}
</script>