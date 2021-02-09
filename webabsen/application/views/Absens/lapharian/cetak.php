<?php //ob_start(); ?>
<!DOCTYPE html>
<style type="text/css">
	.foto{
		width: 80px;
		height: 80px; 
		border-radius: 50%
	}
</style>
<html>
<head>
	<title>Laporan Absensi Karyawan</title>
	<style>

 table {border-collapse:collapse; table-layout:fixed;}
 table td {word-wrap:break-word;text-align: left;}

 </style>
</head>
<body onload="window.print()">
	<h1 align="center">Laporan Data Absensi Karyawan Harian
		 <br>Konter Gunung Mas Cellular</h1>
	<h3 align="center">Kota Padang</h3>
	<table align="center" width="60%" border="0">
	
	<tr>
		<td width="20%">Parameter tanggal :</td>
		<td align="right" width="80%"> <?= $awal; ?></td>
	</tr>
</table>
<table align="center"  border="1">
	<thead>
						<tr>
							<th class="text-center" width="5%">No.</th>
							<th>Nama Karyawan</th>
							<th>Waktu Masuk</th>
							<th>Foto Masuk</th>
							<th>Waktu Pulang</th>
							<th>Foto Pulang</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['jam_masuk'] ?></td>
								<td><img class="foto" src="<?= $d['foto_masuk'] ?>"></td>
								<td><?= $d['jam_keluar'] ?></td>
								<td><img class="foto" src="<?= $d['foto_keluar'] ?>"></td>
								<td><?= $d['ket'] ?></td>
							</tr>
						<?php $no++;
						} ?>
					</tbody>
	<tfoot>
						
					</tfoot>
</table>
<center><br>Padang,
<?php echo date('d-M-y') ?>
<br><br><br><br>
<u>(......................................)</u><br>
<b>Pemilik Toko</b></center>
</body>
</html>
<?php
// $html = ob_get_contents();
// ob_end_clean();
// require_once('html2pdf/html2pdf.class.php');
// $pdf = new HTML2PDF('P','A4','en');
// $pdf->WriteHTML($html);
// $pdf->Output('Laporan File.pdf', 'D');
?>