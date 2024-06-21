<?php //ob_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<title>Laporan Absensi Karyawan per Periode Tanggal</title>
	<style>

 table {border-collapse:collapse; table-layout:fixed;}
 table td {word-wrap:break-word;text-align: left;}

 </style>
</head>
<body onload="window.print()">
	<h1 align="center">Laporan Data Absensi Karyawan per Periode Tanggal
		 <br>Konter Lorus Cellular</h1>
	<h3 align="center">Kota Padang</h3>
	<table align="center" width="60%" border="0">
	
	<tr>
		<td width="20%">Parameter tanggal :</td>
		<td align="right" width="15%"> <?= $awal; ?></td>
		<td align="right" width="5%"> s/d</td>
		<td align="right" width="10%"> <?= $akhir; ?> </td>
		<td align="right" width="50%">  </td>
	</tr>
</table>

<table align="center"  border="1">
	<thead>

						<tr>
							<th class="text-center" width="5%">No.</th>
							<th>Nama Karyawan</th>
							<th>Lokasi</th>
							<th>Hadir</th>
							<th>Sakit</th>
							<th>Izin</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['lokasi'] ?></td>
								<td><?= $d['hadir'] ?></td>
								<td><?= $d['sakit'] ?></td>
								<td><?= $d['izin'] ?></td>
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
