<?php $no = 1;
foreach ($dataVar as $d) {
	$jumlhaAlfaKotor = alfaHitungBulanan($d['rentangSet'])+1;
	if($jumlhaAlfaKotor<1){
		$jumlhaAlfaKotor=30;
	}
	?>

	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir']+ $d['status_disiplin'] ?></td>
		<td><?= $d['sakit'] ?></td>
		<td><?= number_format((($d['hadir']+ $d['sakit']+ $d['status_disiplin']) / $jumlhaAlfaKotor) * 100, 0) . "%"; ?></td>
		<td><?= $d['alfa'] ?></td>
		<td><?= $d['status_displin'] ?></td>

	</tr>
<?php $no++;
} ?>
