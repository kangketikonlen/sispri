<script>
	$(document).ready(function() {
		var url = "<?= base_url('dashboard/rawat_inap/jumlah_pasien?') ?>";
		var tgl_awal = $("#tanggal_awal").val();
		var tgl_akhir = $("#tanggal_akhir").val();
		// 
		<?php if (empty($this->input->get('ruangan'))) : ?>
			getData(url, tgl_awal, tgl_akhir);
			// 
			$("#filter").click(function() {
				tgl_awal = $("#tanggal_awal").val();
				tgl_akhir = $("#tanggal_akhir").val();
				getData(url, tgl_awal, tgl_akhir);
			});
		<?php endif ?>
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
</script>