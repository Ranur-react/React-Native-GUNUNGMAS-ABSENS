<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Id Absen Masuk</th>
							<th>Nama Karyawan</th>
							<th>Waktu Masuk</th>
							<th>Jam Masuk Karyawan</th>
							<th>Tanggal Masuk Karyawan</th>
							<th>Foto</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_absen_masuk'] ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['waktu_mulai_masuk'] ?></td>
								<td><?= $d['jam_masuk'] ?></td>
								<td><?= $d['tanggal_masuk'] ?></td>
								<td><?= $d['foto_masuk'] ?></td>
								<td class="text-center" width="60px">
									<a href="<?= site_url('Absens/AbsenMasuk/destroy/' . $d['id_absen_masuk']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
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
