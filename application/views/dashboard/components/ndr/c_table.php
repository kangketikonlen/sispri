<div class="col-lg-6">
	<div id="cTable" class="card" style="height:400px;overflow:scroll">
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
						<th>Ruangan</th>
						<th class="text-right">Kapasitas</th>
						<th class="text-right">Isi</th>
						<th class="text-right">NDR</th>
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
						"<td>" + opts[i].ruangan + "</td>" +
						"<td class='text-right'>" + number_format(opts[i].kapasitas) + "</td>" +
						"<td class='text-right'>" + number_format(opts[i].isi) + "</td>" +
						"<td class='text-right'>" + opts[i].ndr + "</td>" +
						"</tr>"
					);
				}
			}
		});
	}
</script>