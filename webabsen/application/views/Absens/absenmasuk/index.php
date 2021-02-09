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
							<th>Tanggal Masuk</th>
							<th>Waktu Masuk</th>
							<th>Jam Masuk Karyawan</th>
							<th>Foto</th>
							
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['tanggal_masuk'] ?></td>
								<td><?= $d['waktu_mulai_masuk'] ?></td>
								<td><?= $d['jam_masuk'] ?></td>
								<td><img class="foto" src="<?= $d['foto_masuk'] ?>"></td>
							
								
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
