<?php $no = 1;
foreach ($dataVar as $d) {
	$jumlhaAlfaKotor = alfaHitungBulanan($d['rentangSet']);
	?>

	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir'] ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= number_format(($d['hadir'] / $jumlhaAlfaKotor) * 100, 0) . "%"; ?></td>
		<td><?= ($jumlhaAlfaKotor - ($d['hadir'] + $d['sakit'])) < 0 ? 0 : ($jumlhaAlfaKotor - ($d['hadir'] + $d['sakit'])); ?></td>
		<td><?= $d['status_displin'] ?></td>

	</tr>
<?php $no++;
} ?>
