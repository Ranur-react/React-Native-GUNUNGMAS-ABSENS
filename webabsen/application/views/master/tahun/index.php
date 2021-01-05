<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<button class="btn bg-olive btntambah"><i class="icon-plus3"></i> Tambah Data</button>
			</div>
			<div class="box-body table-responsive">
				<?php echo $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Tahun Ajaran</th>
							<th class="text-center">Status</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?php echo $no . '.'; ?></td>
								<td><?php echo $d['nama_tahun'] ?></td>
								<td width="130px" class="text-center">
									<?php if ($d['status_tahun'] == '1') { ?>
										<a href="<?php echo site_url('master/tahunajaran/status/' . $d['id_tahun']) ?>" class="btn btn-primary btn-xs">Tahun Aktif</a>
									<?php } else { ?>
										<a href="<?php echo site_url('master/tahunajaran/status/' . $d['id_tahun']) ?>" class="btn btn-danger btn-xs">Tidak Aktif</a>
									<?php } ?>
								</td>
								<td class="text-center" width="60px">
									<a href="javascript:void(0)" onclick="edit('<?= $d['id_tahun'] ?>')"><i class="icon-pencil7 text-green" data-toggle="tooltip" data-original-title="Edit Data"></i></a>
									<a href="<?php echo site_url('master/tahunajaran/destroy/' . $d['id_tahun']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
									</a>
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
			url: "<?= site_url('master/tahunajaran/create') ?>",
			success: function(data) {
				$('#tampil_modal').html(data);
				$('#modal_tambah').modal('show');
			}
		});
	});

	function edit(kode) {
		$.ajax({
			type: "post",
			url: "<?= site_url('master/tahunajaran/edit') ?>",
			data: "&kode=" + kode,
			cache: false,
			success: function(response) {
				$('#tampil_modal').html(response);
				$('#modal_edit').modal('show');
			}
		});
	}
</script>
