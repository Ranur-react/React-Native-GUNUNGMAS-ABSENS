<!DOCTYPE html>



<html>

<head>
	<title>Laporan Absensi Bulanan</title>
	<style>
		table {
			border-collapse: collapse;
			table-layout: fixed;
		}

		table td {
			word-wrap: break-word;
			text-align: left;
		}
	</style>
</head>


<body onload="window.print()">
	<h1 align="center">SLIP PEMBAYARAN GAJI
		<br>LORUS CELULER
	</h1>
	<h3 align="center">PERIODE : <?= '1- ' . $bulan . '-' . $tahun . ' s/d ' . '30-' . $bulan . '-' . $tahun ?></h3>
	<table align="center" border="1" class="table table-bordered table-striped data-tabel">
		<thead>
			<tr>
				<th class="text-center">No.</th>
				<th>Nama Karyawan</th>
				<th>Persentasi Hadir</th>
				<th>Gaji Pokok</th>
				<th>Tunjangan Dipatkan</th>
				<th>Terpotong </th>
				<th>Jummlah Hari Kerja</th>
				<th>Gaji Diterima</th>
			</tr>
		</thead>
		<tbody class="isiTabel">
			<?php $no = 1;
			$totsal = 0;
			foreach ($dataVar as $d) {
				$jumlhaAlfaKotor = alfaHitung($d['rentangSet']);
				$jumlhaAlfaKotorFull = alfaHitungBulanan($d['rentangSet']);
				if ($jumlhaAlfaKotorFull < 1) {
					$jumlhaAlfaKotorFull = 30;
				}
			?>
				<?php
				$persentasHadir = (($d['hadir'] + $d['sakit']) / $jumlhaAlfaKotorFull) * 100;
				?>
				<tr>
					<td class="text-center" width="40px"><?= $no . '.'; ?></td>
					<td><?= $d['nama_karyawan'] ?></td>
					<td><?= number_format($persentasHadir, 0) . '% ' ?></td>


					<td><?= 'Rp.' . rupiah($d['gapok']) ?></td>


					<td>

						<?php
						$tuk = 0;
						if ($persentasHadir < 80) {
							$tuk = 0;
						} else {
							$tuk = $d['tdisplin'];
						}
						?>
						<?= $persentasHadir < 80 ? '~ kehadiran belum cukup ' : 'Rp. ' . rupiah($d['tdisplin']) ?>
					</td>


					<?php
					//logika hadir dengan remisi libur
					$potongan = 0;
					$formula = $d['gapok']  + $tuk;

					if (($d['hadir'] + $d['sakit']) < $jumlhaAlfaKotorFull - 2) {
						$potongan = $d['status_displin'] * $d['pdisplin'];
						$formula = (($d['gapok'] / $jumlhaAlfaKotorFull) * ($d['hadir'] + $d['sakit'])) - ($d['status_displin'] * $d['pdisplin']) + $tuk;
					}
					$gajiDiterima = 'Rp.' . rupiah($formula);
					$totsal += $formula;

					?>
					<td>
						<table>
							<tr>
								<td>
									<?= 'Rp.' . rupiah($potongan) ?>
								</td>
							</tr>
						</table>

					</td>
					<td><?= "(" . ($jumlhaAlfaKotorFull) . ")  "  ?></td>
					<td>
						<?= $gajiDiterima;  ?>
					</td>
				</tr>
			<?php $no++;
				$totsal;
			} ?>
			<tr>
				<td colspan="7">
					<h3>
						Total Gaji Yang Dikeluarkan
					</h3>
				</td>
				<td>
					<h3>
						<?= 'Rp.' . rupiah($totsal); ?>
					</h3>
				</td>
			</tr>

		</tbody>
	</table>
	<center><br>Padang,
		<?php echo date('d-M-y') ?>
		<br><br><br><br>
		<u>(......................................)</u><br>
		<b>Owner Toko</b>
	</center>
</body>

</html>
