<?php $no = 1;
foreach ($dataVar as $d) { 
	$jumlhaAlfaKotor= alfaHitung($d['rentangSet']);
	$jumlhaAlfaKotorFull= $d['alfa']+$d['hadir'];;
	?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= $d['lokasi'] ?></td>
		<td><?= $d['hadir']+ $d['status_displin'] ?></td>
		<td><?=  $d['alfa']; ?></td>
		<td><?= $d['sakit'] ?></td>

		<td><?= $d['status_displin'] ?></td>
		<td><?= 'Rp.' . rupiah($d['gapok']) ?></td>
		<td><?= 'TUK (PH>80%) = ' . 'Rp. ' . rupiah($d['tdisplin']) ?></td>

		<?php
		$persentasHadir = (($d['hadir']+ $d['status_displin'] + $d['sakit']) / $jumlhaAlfaKotorFull) * 100;
		?>
		<td>
			<table>
				<tr>
					<td><?= 'PH = ' ?></td>
					<td>
						<?= number_format($persentasHadir, 0) . '% ' ?>
					</td>
				</tr>
				<tr>
					<?php
					$tuk = 0;
					if ($persentasHadir < 80) {
						$tuk = 0;
					} else {
						$tuk = $d['tdisplin'];
					}
					?>
					<td>
						<?= $persentasHadir < 80 ? '~ kehadiran belum cukup ' : 'Rp. ' . rupiah($d['tdisplin']) ?>
					</td>
				</tr>
			</table>
		</td>

		<td>
			<?= 'Rp.' . rupiah($d['pdisplin']) . " / Telat" ?>
		</td>
		<?php
		//logika hadir dengan remisi libur
		//$potongan=0;
		$potongan = $d['status_displin'] * $d['pdisplin'];
		$gajiDiterima= 'Rp.' . rupiah($d['gapok']- $potongan  + $tuk);
		if (($d['hadir']+ $d['status_displin']+ $d['sakit']) < $jumlhaAlfaKotorFull - 2) {
			$gajiDiterima = 'Rp.' . rupiah((($d['gapok'] / $jumlhaAlfaKotorFull) * ($d['hadir']+ $d['status_displin'] + $d['sakit'])) - ($d['status_displin'] * $d['pdisplin']) + $tuk);
		}
		?>
		<td>
			<table>
				<tr>
					<td>
						<?= 'Rp.' . rupiah($potongan) ?>
					</td>
				</tr>
			</table>

		</td>
			<td><?= "(" . ($jumlhaAlfaKotorFull) . ")  "  ?></td>
		<td>
			<?=   $gajiDiterima;  ?>
		</td>
		<td>
			<a href="#" onclick="printSlipPerMOnth('<?= $d['id_karyawan'] ?>')" class="btn btn-primary">
				<i class="fa fa-print"></i> PaySlip Print
			</a>

		</td>
	</tr>
<?php $no++;
} ?>
