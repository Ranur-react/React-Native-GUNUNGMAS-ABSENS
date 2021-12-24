<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header with-border">
				
				<div class="row">
					<div class="col-xs-8">
					</div>
					<div class="col-xs-2">


						<div class="form-group">
							<label>Pilih Bulan</label>
							<select onchange="IsiTabel()" class="form-control pilBulan">
								<?php
								$i = 0;
								$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
								for ($i = 0; $i <= 11; $i++) { ?>
									<option value="<?= $i + 1 ?>" <?= date('m') == $i + 1 ? "selected" : null ?>><?= $months[$i] . "\n" ?></option>
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
							<th>Nama Karyawan</th>
							<th>Lokasi</th>
							<th>Hadir</th>
							<th>Alfa</th>
							<th>Sakit</th>
							<th>Izin</th>
							<th>Terlambat</th>
							<th>Gaji Pokok</th>
							<th>Nilai Tunjangan</th>
							<th>Tunjangan Dipatkan</th>
							<th>Nilai Potongan Terlambat</th>
							<th>Terpotong </th>
							<th>Gaji Diterima</th>
							<th>Slip Gaji Print</th>
						</tr>
					</thead>
					<tbody class="isiTabel">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	IsiTabel();

	function IsiTabel() {
		$.ajax({
			type: "post",
			url: "<?= site_url('Absens/LaporanAbsenGajiBulanan/TabelPeriode') ?>",
			data: "&PilBulan=" + $('.pilBulan').val(),
			cache: false,
			success: function(data) {
				$('.isiTabel').html(data);

			}
		});
	}


	$(document).on('click', '.btncetak', function(e) {
		let kode = "/" + $('.pilBulan').val();
		setTimeout(function() {
			window.location.href = '<?= site_url('Absens/LaporanAbsenGajiBulanan/cetak') ?>' + kode;
		}, 100);

	});
</script>
