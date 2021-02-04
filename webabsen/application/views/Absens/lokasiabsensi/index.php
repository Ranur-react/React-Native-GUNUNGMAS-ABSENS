<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<button class="btn bg-olive btntambah"><i class="icon-plus3"></i> Tambah Data</button>
			</div>
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Id Set Lokasi</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Lokasi</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_set_lokasi'] ?></td>
								<td><?= $d['latitude'] ?></td>
								<td><?= $d['longitude'] ?></td>
								<td><?= $d['lokasi'] ?></td>
								<td class="text-center" width="60px">
									<a href="javascript:void(0)" onclick="edit('<?= $d['id_set_lokasi'] ?>')"><i class="icon-pencil7 text-green" data-toggle="tooltip" data-original-title="Edit Data"></i></a>
									<a href="<?= site_url('Absens/LokasiAbsensi/destroy/' . $d['id_set_lokasi']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
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

<div id="tampil_modal"></div>
<script>
	$(document).on('click', '.btntambah', function(e) {
		$.ajax({
			url: "<?= site_url('Absens/LokasiAbsensi/create') ?>",
			success: function(data) {
				$('#tampil_modal').html(data);
				$('#modal_tambah').modal('show');
			}
		});
	});

	function edit(kode) {
		$.ajax({
			type: "post",
			url: "<?= site_url('Absens/LokasiAbsensi/edit') ?>",
			data: "&kode=" + kode,
			cache: false,
			success: function(response) {
				$('#tampil_modal').html(response);
				$('#modal_edit').modal('show');
			}
		});
	}
</script>
