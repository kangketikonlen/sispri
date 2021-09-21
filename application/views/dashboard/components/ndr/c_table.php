<div class="col-lg-6">
	<div id="cTable" class="card" style="height:400px">
		<div class="card-header">
			<h5 class="card-title">Tabel <?= $Title ?></h5>
			<div class="card-tools">
				<ul class="pagination pagination-sm float-right">
					<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
				</ul>
			</div>
		</div>
		<div class="card-body p-0">
			<div class="chart">
				<table id="dtTable" class="table table-sm table-striped">
					<thead>
						<th class='text-center'>No.</th>
						<th>Tanggal</th>
						<th>Pasien</th>
						<th>Dokter</th>
						<th>Poli</th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	get_table();

	function get_table() {
		$.ajax({
			url: "<?= base_url('dashboard/ndr/get_table') ?>",
			method: "GET",
			success: function(data) {
				var opts = JSON.parse(data);
				for (let i = 0; i < opts.length; i++) {
					$("#dtTable tbody").append(
						"<tr>" +
						"<td class='text-center'>" + opts[i].nomor + "</td>" +
						"<td>" + tanggal_indonesian(opts[i].tanggal) + "</td>" +
						"<td>" + opts[i].pasien + "</td>" +
						"<td>" + opts[i].dokter + "</td>" +
						"<td>" + opts[i].poli + "</td>" +
						"</tr>"
					);
				}
			}
		});
	}
</script>