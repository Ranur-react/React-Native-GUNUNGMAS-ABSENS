<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Id Absen Pulang</th>
							<th>Nama Karyawan</th>
							<th>Waktu Pulang</th>
							<th>Jam Pulang Karyawan</th>
							<th>Tanggal Pulang Karyawan</th>
							<th>Foto</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_absen_keluar'] ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['waktu_mulai_keluar'] ?></td>
								<td><?= $d['jam_keluar'] ?></td>
								<td><?= $d['tanggal_keluar'] ?></td>
								<td><?= $d['foto_keluar'] ?></td>
								<td class="text-center" width="60px">
									<a href="<?= site_url('Absens/AbsenPulang/destroy/' . $d['id_absen_keluar']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
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
