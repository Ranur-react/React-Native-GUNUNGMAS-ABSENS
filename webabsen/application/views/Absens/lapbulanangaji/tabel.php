<?php $no = 1;
foreach ($dataVar as $d) { ?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir'] ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= $d['izin'] ?></td>
		<td><?= $d['gapok'] ?></td>
		<?php
		$persentasHadir = ($d['hadir'] / 30) * 100;
		?>
		<td><?= 'Persentasi Kehadiran'.$persentasHadir.'% '.$d['tdisplin'] ?></td>

		<td><?= $d['pdisplin'] ?></td>
		<td><?= $d['izin'] ?></td>
	</tr>
<?php $no++;
} ?>