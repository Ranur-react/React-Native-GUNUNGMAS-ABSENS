<?php //ob_start(); ?>
<!DOCTYPE html>



<html>
<head>
	<title>Laporan Absensi Bulanan</title>
	<style>

 table {border-collapse:collapse; table-layout:fixed;}
 table td {word-wrap:break-word;text-align: left;}

 </style>
</head>
<body onload="window.print()">
	<h1 align="center">Laporan Data Absensi Bulanan
		 <br>Lorus Cellular</h1>
	<h3 align="center">Kota Padang</h3>
	<table align="center" width="60%" border="0">

		<?php $months = array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"); ?>
	
	<tr>
		<td width="15%">Parameter Bulan :</td>
		<td align="right" width="85%"> <?=  $months[$bulan-1]; ?></td>
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
							<th>Persentase Kehadiran</th>
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
								<td><?= number_format(($d['hadir']/30)*100, 0)."%"; ?></td> 
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
