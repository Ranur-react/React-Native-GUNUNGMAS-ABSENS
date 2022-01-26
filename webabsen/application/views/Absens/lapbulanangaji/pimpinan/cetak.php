
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
		<h3 align="center">PERIODE : <?= $bulan . ' - ' . $tahun ?></h3>

		<center><br>Padang,
			<?php echo date('d-M-y') ?>
			<br><br><br><br>
			<u>(......................................)</u><br>
			<b>Owner Toko</b>
		</center>
	</body>

	</html>
