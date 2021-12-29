<?php $no = 1;
foreach ($dataVar as $d) { ?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir'] ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= number_format(($d['hadir'] / 30) * 100, 0) . "%"; ?></td>
		<td><?= 30 - ($d['sakit'] + $d['hadir']) ?></td>
		<td><?= $d['status_displin'] ?></td>

	</tr>
<?php $no++;
} ?>
