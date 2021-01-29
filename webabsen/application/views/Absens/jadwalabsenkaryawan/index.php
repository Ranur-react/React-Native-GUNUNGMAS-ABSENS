<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				<button class="btn bg-olive btntambah"><i class="icon-plus3"></i> Tambah Data</button>
				<div class="row">
					<div class="col-xs-10">
					</div>
					<div class="col-xs-2">
						<div class="form-group">
									<label>Lokasi Absensi</label>
									<select onchange="IsiTabel()" class="form-control pilLokasi" name="lokasi">
										<option value="" selected>-- Pilih --</option>
										<?php foreach ($dlokasi as $d) : ?>
											<option  value="<?php echo $d['id_set_lokasi']; ?>"><?php echo $d['lokasi']; ?></option>
										<?php endforeach; ?>
									</select>
									<span class="error lokasi text-red"></span>
						</div>

					<div class="form-group">
					<label>Bulan</label>
					<select onchange="IsiTabel()" class="form-control pilBulan">
						<?php 
						$i = 0; 
						$months = array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
						for($i = 0; $i <= 11; $i++){?>
						<option value="<?= $i+1 ?>" <?= date('m')== $i+1 ? "selected" : null ?> ><?= $months[$i] . "\n" ?></option>
						<?php  } ?>

					</select>
				</div>

					</div>

				</div>
			</div>
			<div class="box-body table-responsive">
				<?= $this->session->flashdata('pesan'); ?>
				<table class="table table-bordered table-striped data-tabel">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th>Id Jadwal</th>
							<th>Tanggal</th>
							<th>Shift Karyawan</th>
							<th>Lokasi Absensi</th>
							<th>Nama Karyawan</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody class="isiTabel">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="tampil_modal"></div>
<script>
	function IsiTabel() {
			$.ajax({
			type: "post",
			url: "<?= site_url('Absens/JadwalAbsenKaryawan/TabelJadwal') ?>",
			data: "&PilBulan="+ $('.pilBulan').val()+"&pilLokasi=" + $('.pilLokasi').val(),
			cache: false,
			success: function(data) {
				$('.isiTabel').html(data);

			}
		});
}
IsiTabel();
	$(document).on('click', '.btntambah', function(e) {
		window.location=("<?= site_url('Absens/JadwalAbsenKaryawan/HalamanCreate') ?>")
	});

	function edit(kode) {
		$.ajax({
			type: "post",
			url: "<?= site_url('Absens/JadwalAbsenKaryawan/edit') ?>",
			data: "&kode=" + kode,
			cache: false,
			success: function(response) {
				$('#tampil_modal').html(response);
				$('#modal_edit').modal('show');
			}
		});
	}
</script>
