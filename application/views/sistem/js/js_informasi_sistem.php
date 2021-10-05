<script>
	var dataUrl = "<?= base_url('sistem/informasi_sistem/get_data/') ?>";
	requestEdit(dataUrl);

	var checkExist = setInterval(function() {
		if ($("#info_status_sosmed").val() == 1) {
			$("#info_status_sosmed_control").prop('checked', true);
		}
	}, 100)

	$('#Frm').submit(function(e) {
		e.preventDefault();
		var dataUrl = "<?= base_url('sistem/informasi_sistem/simpan/') ?>";
		var dataReq = new FormData(this);
		saveRequest(dataUrl, dataReq);
	});
</script>