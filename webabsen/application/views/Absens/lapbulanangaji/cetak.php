<?php //ob_start(); 
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
						<td align="right" width="50%">: 1300056</td>
					</tr>
					<tr>
						<td width="50%">NAMA KARYAWAN </td>
						<td align="right" width="50%">: IMAM</td>
					</tr>
					<tr>
						<td width="50%">JABATAN</td>
						<td align="right" width="50%">: CS</td>
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
						<td align="right" width="50%">: IMAM</td>
					</tr>
					<tr>
						<td width="50%">DIBAYARKAN TANGGAL</td>
						<td align="right" width="50%">: <?= date('D M Y')?></td>
					</tr>
				</table>
			</td>
			<td width="50%">
				<table align="center" width="100%" border="0">
					<tr>
						<td width="50%">HADIR /ALFA </td>
						<td align="right" width="50%">: 28/2</td>
					</tr>
					<tr>
						<td width="50%">PERSENTASI HADIR </td>
						<td align="right" width="50%">: 96%</td>
					</tr>
					<tr>
						<td width="50%">TUNJANGAN </td>
						<td align="right" width="50%">: Rp. 300.000</td>
					</tr>
					<tr>
						<td width="50%">TERLAMBAT </td>
						<td align="right" width="50%">: 10 X</td>
					</tr>
					<tr>
						<td width="50%">POTONGAN :</td>
						<td align="right" width="50%">: Rp. 100.000</td>
					</tr>
					<tr>
						<td width="50%"></td>
						<td align="right" width="50%">---------------------</td>
					</tr>
					<tr>
						<td width="50%">GAJI DITERIMA :</td>
						<td align="right" width="50%">: Rp. 3.2500.000</td>
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
// $html = ob_get_contents();
// ob_end_clean();
// require_once('html2pdf/html2pdf.class.php');
// $pdf = new HTML2PDF('P','A4','en');
// $pdf->WriteHTML($html);
// $pdf->Output('Laporan File.pdf', 'D');
?>
