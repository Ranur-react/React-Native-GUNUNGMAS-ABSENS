<?php $no = 1;
foreach ($dataVar as $d) { ?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir'] ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= $d['izin'] ?></td>
		<td><?= rupiah($d['gapok']) ?></td>
		<?php
		$persentasHadir = ($d['hadir'] / 30) * 100;
		?>
		<td>
			<table>
				<tr>
					<td><?= 'Persentasi Kehadiran: ' ?></td>
					<td>
						<?= number_format($persentasHadir, 0) . '% ' ?>
					</td>
				</tr>
				<tr>
					<td><?= 'Tunjangan Kehadiran: ' ?></td>
					<td>
						<?= $persentasHadir < 80 ? '~ kehadiran belum cukup ~ Belum Mendapat Tukin' : 'Rp. ' . rupiah($d['tdisplin']) ?>
					</td>
				</tr>
			</table>
		</td>

		<td>
			<table>
				<tr>
					<td><?= 'TD' ?></td>
					<td>
						<?= 'Rp.'.($d['pdisplin']) . " X" ?>

					</td>
				</tr>
				<tr>
					<td><?= 'Nilai Potongan (TD X ' . 'Rp.'.rupiah($d['pdisplin']) . '): ' ?></td>
					<td>
						<?= 'Rp.'.rupiah($d['status_displin'] * $d['pdisplin']) ?>
					</td>
				</tr>
			</table>

		</td>
		<td>
			<table>
				<tr>
					<td><?= 'Diterima (Hadir X ('. 'Rp.'.rupiah($d['gapok']).' /30) = ' ?></td>
					<td>
						<?= 'Rp.'.rupiah($d['hadir'] * ($d['gapok'] / 30) - ($d['status_displin'] * $d['pdisplin'])) ?>
					</td>
				</tr>
			</table>

		</td>
	</tr>
<?php $no++;
} ?>
