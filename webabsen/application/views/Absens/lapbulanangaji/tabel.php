<?php $no = 1;
foreach ($dataVar as $d) { ?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir'] ?></td>
		<td><?= (30 - $d['hadir']) ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= $d['izin'] ?></td>
		<td><?= $d['status_displin'] ?></td>
		<td><?= 'Rp.' . rupiah($d['gapok']) ?></td>
		<td><?= 'TUK (PH>80%) = ' . 'Rp. ' . rupiah($d['tdisplin']) ?></td>

		<?php
		$persentasHadir = ($d['hadir'] / 30) * 100;
		?>
		<td>
			<table>
				<tr>
					<td><?= 'PH = ' ?></td>
					<td>
						<?= number_format($persentasHadir, 0) . '% ' ?>
					</td>
				</tr>
				<tr>
					<?php
					$tuk = 0;
					if ($persentasHadir < 80) {
						$tuk = 0;
					} else {
						$tuk = $d['tdisplin'];
					}
					?>
					<td>
						<?= $persentasHadir < 80 ? '~ kehadiran belum cukup ' : 'Rp. ' . rupiah($d['tdisplin']) ?>
					</td>
				</tr>
			</table>
		</td>

		<td>
			<?= 'Rp.' . rupiah($d['pdisplin']) . " / Telat" ?>
		</td>
		<td>
			<table>
				<tr>
					<td>
						<?= 'Rp.' . rupiah($d['status_displin'] * $d['pdisplin']) ?>
					</td>
				</tr>
			</table>

		</td>
		<td>
			<?= 'Rp.' . rupiah($d['gapok'] - ($d['status_displin'] * $d['pdisplin']) + $tuk)  ?>
		</td>
		<td>
			<button class="btn btn-primary btncetak"><i class="fa fa-print"></i> PaySlip Print</button>
		</td>
	</tr>
<?php $no++;
} ?>
