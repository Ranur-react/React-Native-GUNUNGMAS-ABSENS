<script>
	$(function() {
		$('.datepicker').datepicker({
			autoclose: true
		});
		$('input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		})
	});
</script>
<div class="modal fade" id="modal_tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Pilih Karyawan</h4>
			</div>
			<?= form_open('Absens/DataKaryawan/store', ['class' => 'form_create']) ?>
			<div class="modal-body">

				<div class="row">
	<div class="col-xs-50">
		<div class="box">
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Pilih</th>
							<th>Id Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Email</th>
							<th>Nohp</th>
							<th>Alamat</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="80px"><?= $no . '.'; ?></td>
								<td><input type="checkbox"></td>
								<td><?= $d['id_karyawan'] ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['email'] ?></td>
								<td><?= $d['nohp'] ?></td>
								<td><?= $d['alamat'] ?></td>
								<td class="text-center" width="80px">
									
								</td>
							</tr>
						<?php $no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btnStore"><i class="icon-floppy-disk"></i> Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Close</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

