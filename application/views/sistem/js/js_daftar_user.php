<script>
	$(document).ready(function() {
		var levelMenu = $('#level_id');
		var optUrl = "<?= base_url('sistem/daftar_level/options/') ?>";

		levelMenu.select2({
			theme: 'bootstrap4',
			placeholder: '-- FILTER MENU UTAMA --',
			allowClear: true
		});

		fetchOption(optUrl, levelMenu);

		var tableUrl = "<?= base_url('sistem/daftar_user/list_data/') ?>";

		var listsColumn = [{
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1 + ".";
				}
			},
			{
				"data": "1"
			},
			{
				"data": "2"
			},
			{
				"data": "3"
			},
			{
				"data": "4"
			},
			{
				"data": "5",
				"searchable": false
			}
		];

		dtTable(tableUrl, listsColumn);

		$('#Frm').submit(function(e) {
			e.preventDefault();
			var dataUrl = "<?= base_url('sistem/daftar_user/simpan/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#edit', function() {
			$("#frmData").modal('show');
			var dataUrl = "<?= base_url('sistem/daftar_user/get_data/') ?>";
			var reqData = {
				user_id: $(this).attr("data")
			};
			requestEdit(dataUrl, reqData);
		});

		$(document).on('click', '#hapus', function() {
			var dataUrl = "<?= base_url('sistem/daftar_user/hapus/') ?>";
			var dataReq = new FormData(this);
			saveRequest(dataUrl, dataReq);
		});

		$(document).on('click', '#random-pass', function() {
			swal({
				title: "Anda Yakin Ingin Membuat Password Acak?",
				text: "Klik CANCEL jika ingin membatalkan!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			}).then((Oke) => {
				if (Oke) {
					var pass = "PWD" + Math.floor(Math.random() * (999 - 100)) + 100;
					$("#user_pass_baru").val(pass);
					$("#user_pass_baru").attr('type', 'text');
				} else {
					swal("Poof!", "Penyimpanan Data Dibatalkan", "error").then((value) => {
						location.reload();
					})
				}
			})
		});

	});
</script>