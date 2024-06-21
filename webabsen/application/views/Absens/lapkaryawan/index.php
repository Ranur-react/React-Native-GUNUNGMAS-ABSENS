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
							<th>Id Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Email</th>
							<th>No Handphone</th>
							<th>Alamat</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_karyawan'] ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['email'] ?></td>
								<td><?= $d['nohp'] ?></td>
								<td><?= $d['alamat'] ?></td>
							</tr>
						<?php $no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	
	$(document).on('click', '.btncetak', function(e) {
 		let kode= "/" +$('.pangkat').val();
                    	    setTimeout(function() {
                                window.location.href = '<?= site_url('Absens/LaporanKaryawan/cetak')?>'+kode;
                            }, 100);

	});

</script>

