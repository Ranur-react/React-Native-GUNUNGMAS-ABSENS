<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<button class="btn btn-primary btncetak"><i class="fa fa-print"></i> Cetak Laporan</button>
			</div>
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Nama Karyawan</th>
							<th>Waktu Masuk</th>
							<th>Waktu Pulang</th>
							<th>Surat Izin</th>
							<th>Surat Sakit</th>
						</tr>
					</thead>
					
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.btncetak', function(e) {
		$.ajax({
			url: "<?= site_url('#') ?>",
			success: function(data) {
				$('#tampil_modal').html(data);
				$('#modal_tambah').modal('show');
			}
		});
	});

</script>

