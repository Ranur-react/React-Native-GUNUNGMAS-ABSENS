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
						<td width="50%">TERLMABTA </td>
						<td align="right" width="50%">: 10 X</td>
					</tr>
					<tr>
						<td width="50%">POTONGAN :</td>
						<td align="right" width="50%"> Rp. 100.000</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table align="center" border="1">
		<thead>
			<tr>
				<th class="text-center" width="20%">No.</th>
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
					<td><?= number_format(($d['hadir'] / 30) * 100, 0) . "%"; ?></td>
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
		<b>Pemilik Toko</b>
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
