<?php //ob_start(); ?>
<!DOCTYPE html>

<html>
<head>
	<title>Laporan Absensi Karyawan</title>
	<style>

 table {border-collapse:collapse; table-layout:fixed;}
 table td {word-wrap:break-word;text-align: left;}

 </style>
</head>
<body onload="window.print()">
	<h1 align="center">Laporan Data Karyawan
		 <br>Konter Gunung Mas Cellular</h1>
	<h3 align="center">Kota Padang</h3>
	<table align="center" width="60%" border="0">
	
	<!-- 	<tr>
		<td width="20%">Status Pangkat</td>
		<td align="right" width="20%">: <?= $a; ?></td>
		<td align="right" width="60%"> </td>
	</tr> -->
</table>
<table align="center"  border="1">
	<thead>
						<tr>
							<th class="text-center" width="5%">No.</th>
							<th>Id Karyawan</th>
							<th>Nama Karyawan</th>
							<th>Email</th>
							<th>No Handphone</th>
							<th>Alamat</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_karyawan'] ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['email'] ?></td>
								<td><?= $d['nohp'] ?></td>
								<td><?= $d['alamat'] ?></td>
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