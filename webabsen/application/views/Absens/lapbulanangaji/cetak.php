<?php //ob_start(); 
foreach ($dataVar as $d) {
	$jumlhaAlfaKotor = alfaHitungBulanan($d['rentangSet'])+1;
	
	?>
	
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
	<?php
	$persentasHadir = (($d['hadir'] + $d['status_displin'] + $d['sakit']) / $jumlhaAlfaKotor) * 100;
	?>
	<?php
	$tuk = 0;
	if ($persentasHadir < 80) {
		$tuk = 0;
	} else {
		$tuk = $d['tdisplin'];
	}
	?>
	<?php
	//logika hadir dengan remisi libur
	$potongan = $d['status_displin'] * $d['pdisplin'];
	$gajiDiterima = 'Rp.' . rupiah($d['gapok'] - $potongan  + $tuk);
	if (($d['hadir'] + $d['status_displin'] + $d['sakit']) < $jumlhaAlfaKotor - 2) {
		$gajiDiterima = 'Rp.' . rupiah((($d['gapok'] / $jumlhaAlfaKotor) * ($d['hadir'] + $d['status_displin'] + $d['sakit'])) - ($d['status_displin'] * $d['pdisplin']) + $tuk);
	}
	?>

	<body onload="window.print()">
		<h1 align="center">SLIP PEMBAYARAN GAJI
			<br>LORUS CELULER
		</h1>
		<h3 align="center">PERIODE : <?= '1 ' . date('M Y') . ' - ' . '30 ' . date('M Y') ?></h3>
		<table align="center" width="80%" border="0">
			<tr>
				<td width="50%">
					<table align="center" width="100%" border="0">
						<tr>
							<td width="50%">NO.ID KARYAWAN </td>
							<td align="right" width="50%">: <?= $d['id_karyawan'] ?></td>
						</tr>
						<tr>
							<td width="50%">NAMA KARYAWAN </td>
							<td align="right" width="50%">: <?= $d['nama_karyawan'] ?></td>
						</tr>
						<tr>
							<td width="50%">JABATAN</td>
							<td align="right" width="50%">: <?= $d['nama_jabatan'] ?></td>
						</tr>
						<tr>
							<td width="50%">BANK TRANSFER</td>
							<td align="right" width="50%">: MANDIRI</td>
						</tr>
						<tr>
							<td width="50%">NOMOR REKENING</td>
							<td align="right" width="50%">: 12312 123 312 </td>
						</tr>
						<tr>
							<td width="50%">ATAS NAMA</td>
							<td align="right" width="50%">: <?= $d['nama_karyawan'] ?></td>
						</tr>
						<tr>
							<td width="50%">DIBAYARKAN TANGGAL</td>
							<td align="right" width="50%">: <?= date('D M Y') ?></td>
						</tr>
					</table>
				</td>
				<td width="50%">
					<table align="center" width="100%" border="0">
						<tr>
							<td width="50%">HADIR /ALFA </td>
							<td align="right" width="50%">: <?= $d['hadir']+ $d['status_displin'] ?>/<?= ($jumlhaAlfaKotor - ($d['hadir'] + $d['sakit']+ $d['status_displin'])) < 0?0 :$d['alfa'] ;  ?></td>
						</tr>
						<tr>
							<td width="50%">Sakit </td>
							<td align="right" width="50%">: <?= $d['sakit'] ?> X</td>
						</tr>
						<tr>
							<td width="50%">PERSENTASI HADIR </td>
							<td align="right" width="50%">: <?= number_format($persentasHadir, 0) . '% ' ?></td>
						</tr>
						<tr>
							<td width="50%">TUNJANGAN </td>
							<td align="right" width="50%">: <?= $persentasHadir < 80 ? '~ kehadiran belum cukup ' : 'Rp. ' . rupiah($d['tdisplin']) ?></td>
						</tr>
						<tr>
							<td width="50%">TERLAMBAT </td>
							<td align="right" width="50%">: <?= $d['status_displin'] ?> X</td>
						</tr>
						<tr>
							<td width="50%">POTONGAN :</td>
							<td align="right" width="50%">: <?= 'Rp.' . rupiah($potongan) ?></td>
						</tr>
						<tr>
							<td width="50%"></td>
							<td align="right" width="50%">---------------------</td>
						</tr>
						<tr>
							<td width="50%">GAJI DITERIMA :</td>
							<td align="right" width="50%">: <?= $gajiDiterima  ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<center><br>Padang,
			<?php echo date('d-M-y') ?>
			<br><br><br><br>
			<u>(......................................)</u><br>
			<b>Owner Toko</b>
		</center>
	</body>

	</html>
<?php
}
?>
