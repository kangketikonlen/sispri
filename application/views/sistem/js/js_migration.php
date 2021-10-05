<script>
	$(document).ready(function() {
		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/migration/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
			$("#migration_name").focus();
		});
	});
</script>