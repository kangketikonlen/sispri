<div class="col-lg-6">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Grafik <?= $Title ?></h5>
		</div>
		<div class="card-body">
			<div class="chart">
				<canvas id="barChart" class="text-light"></canvas>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url('vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
	get_chart();

	function get_chart() {
		$.ajax({
			url: "<?= base_url('dashboard/ndr/chart_data') ?>",
			method: "GET",
			success: function(data) {
				$("#barChart").height($("#cTable").height() - 85);
				areaChartData = {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sept', 'Okt', 'Nov', 'Des'],
					datasets: JSON.parse(data)
				}
				//-------------
				//- BAR CHART -
				//-------------
				var lineChartCanvas = $('#barChart').get(0).getContext('2d')
				var barChartData = jQuery.extend(true, {}, areaChartData)
				var temp0 = areaChartData.datasets.data
				barChartData.datasets[0].fill = temp0

				var barChartOptions = {
					legend: {
						labels: {
							fontColor: "white",
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								fontColor: "white",
								beginAtZero: true
							}
						}],
						xAxes: [{
							ticks: {
								fontColor: "white",
								beginAtZero: true
							}
						}]
					},
					responsive: true,
					maintainAspectRatio: false,
					datasetFill: false
				}

				var barChart = new Chart(lineChartCanvas, {
					type: "bar",
					data: barChartData,
					options: barChartOptions
				})
			}
		});
	}
</script>