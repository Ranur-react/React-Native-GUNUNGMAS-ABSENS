<style type="text/css">
	.foto{
		width: 80px;
		height: 80px; 
		border-radius: 50%
	}
</style>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Nama Karyawan</th>
							<th>Taggal Pulang</th>
							<th>Waktu Pulang</th>
							<th>Jam Pulang Karyawan</th>
							<th>Foto</th>
						
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['tanggal_keluar'] ?></td>
								<td><?= $d['waktu_mulai_keluar'] ?></td>
								<td><?= $d['jam_keluar'] ?></td>
								<td><img class="foto" src="<?= $d['foto_keluar'] ?>"></td>
							
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
