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
							<th>Nama</th>
							<th>Email</th>
							<th>Level</th>
							<th class="text-center" width="80px">Status</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) {
							$kode = $d['kode_user'];
							if ($d['level_user'] == '1') {
								$iduser = null;
								$nama = 'Administrator';
							} else if ($d['level_user'] == '2') {
								$row = $this->db->where('idguru', $kode)->get('guru')->row_array();
								$iduser = $row['nipguru'] . ' | ';
								$nama = $row['namaguru'];
							} else if ($d['level_user'] == '3') {
								$row = $this->db->where('id_siswa', $kode)->get('siswa')->row_array();
								$iduser = $row['nisn_siswa'] . ' | ';
								$nama = $row['nama_siswa'];
							}
						?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $iduser . $nama ?></td>
								<td><?= $d['email'] ?></td>
								<td>
									<?php if ($d['level_user'] == '1')
										echo 'Administrator';
									else if ($d['level_user'] == '2')
										echo 'Guru';
									else if ($d['level_user'] == '3')
										echo 'Siswa'; ?>
								</td>
								<td class="text-center">
									<div class="status_layout">
										<a href="<?= site_url('master/user/status/' . $d['id_user']) ?>" class="btn <?= $d['status_user'] == '1' ? 'btn-primary' : 'btn-danger' ?> btn-xs"><?= $d['status_user'] == '1' ? 'Aktif' : 'Tidak Aktif' ?></a>
									</div>
								</td>
								<td class="text-center" width="60px">
									<a href="javascript:void(0)" onclick="edit('<?= $d['id_user'] ?>')"><i class="icon-pencil7 text-green" data-toggle="tooltip" data-original-title="Edit Data"></i></a>
									<a href="<?= site_url('master/user/destroy/' . $d['id_user']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
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
			url: "<?= site_url('master/user/create') ?>",
			success: function(data) {
				$('#tampil_modal').html(data);
				$('#modal_tambah').modal('show');
			}
		});
	});

	function edit(kode) {
		$.ajax({
			type: "post",
			url: "<?= site_url('master/user/edit') ?>",
			data: "&kode=" + kode,
			cache: false,
			success: function(response) {
				$('#tampil_modal').html(response);
				$('#modal_edit').modal('show');
			}
		});
	}
</script>