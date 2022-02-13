<?php $no = 1;
foreach ($dataVar as $d) {
	$jumlhaAlfaKotor = alfaHitungMingguan($d['rentangSet'], $dateMax);
	$jumlhaAlfaKotorFull = alfaHitungBulanan($d['rentangSet']);
?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir'] ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= $d['alfa'] ?></td>
		<td><?= $d['status_displin'] ?></td>
	</tr>
<?php $no++;
} ?>
