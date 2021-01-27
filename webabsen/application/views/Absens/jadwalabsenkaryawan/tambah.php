<script>
let datakaryawan={};
let i=0
			function centang(e) {
				datakaryawan[i]=e;
				i++;
				console.log(datakaryawan);
					
			}


		$(document).on('click', '.btntambahTMP', function(e) {
		$.ajax({
			type: "post",
			url: "<?= site_url('Absens/TmpKaryawan') ?>",
			data: JSON.stringify(datakaryawan),
			dataType: "json",
			cache: false,
			success: function(response) {

			},
		});
		
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
			<div class="modal-body">
				<div class="row">
	<div class="col-xs-50">
		<div class="box">
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped ">
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
								<td><input type="checkbox"  onclick="centang('<?= $d['id_karyawan']   ?>')" /></td>
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
				<button type="button" class="btn btn-primary btntambahTMP" onclick="IsiTabel()"><i class="icon-plus-circle2"></i> Tambah</button>
				<button type="button" class="btn btn-danger"  onclick="IsiTabel()" data-dismiss="modal"><i class="icon-cross2"></i> Close</button>
			</div>
		</div>
	</div>
</div>

