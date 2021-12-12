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
		<td><?= $d['tdisplin'] ?></td>
		<td><?= $d['displin'] ?></td>
		<td><?= $d['izin'] ?></td>
	</tr>
<?php $no++;
} ?>
