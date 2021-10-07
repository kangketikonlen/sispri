<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		var url = "<?= base_url('indikator/pasien_non_covid/get_jumlah?') ?>";
		var urlChart = "<?= base_url('indikator/pasien_non_covid/chart_data?') ?>";
		var urlTable = "<?= base_url('indikator/pasien_non_covid/get_table?') ?>";
		// 
		var ruangan = "<?= $this->input->get('ruangan') ?>"
		var tgl_awal = $("#tanggal_awal").val();
		var tgl_akhir = $("#tanggal_akhir").val();
		// 
		getData(url, tgl_awal, tgl_akhir, ruangan);
		get_chart(urlChart, tgl_awal, tgl_akhir, ruangan);
		get_table(urlTable, tgl_awal, tgl_akhir, ruangan);
		// 
		$("#filter").click(function() {
			tgl_awal = $("#tanggal_awal").val();
			tgl_akhir = $("#tanggal_akhir").val();
			getData(url, tgl_awal, tgl_akhir, ruangan);
			get_chart(urlChart, tgl_awal, tgl_akhir, ruangan);
			get_table(urlTable, tgl_awal, tgl_akhir, ruangan);
		});
	});

	function getData(url, tgl_awal, tgl_akhir, ruangan) {
		var request = "tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir + "&ruangan=" + ruangan;
		requestGet(url + request).then(function(results) {
			var data = JSON.parse(results);
			$.each(data, function(i, d) {
				$("#" + i).text(number_format(d));
			});
		});
	}

	function get_chart(url, tgl_awal, tgl_akhir, ruangan) {
		var request = "tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir + "&ruangan=" + ruangan;
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

	function get_table(url, tgl_awal, tgl_akhir, ruangan) {
		$("#dtTable tbody").empty();
		var request = "tanggal_awal=" + tgl_awal + "&tanggal_akhir=" + tgl_akhir + "&ruangan=" + ruangan;
		$.ajax({
			url: url + request,
			method: "GET",
			success: function(data) {
				var opts = JSON.parse(data);
				$.each(opts, function(key, dt) {
					console.log(opts)
					for (let i = 0; i < dt.length; i++) {
						$("#dtTable tbody").append(
							"<tr>" +
							"<td>" + dt[i].dokter + "</td>" +
							"<td>Kelas " + dt[i].kelas + "</td>" +
							"<td class='text-right'>" + number_format(dt[i].pasien) + " pasien</td>" +
							"</tr>"
						);
					}
				});
			}
		});
	}
</script>