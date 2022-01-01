<?php $no = 1;
$totsal = 0;
foreach ($dataVar as $d) {
	$jumlhaAlfaKotor = alfaHitung($d['rentangSet']);
	$jumlhaAlfaKotorFull = alfaHitungBulanan($d['rentangSet']);
	if($jumlhaAlfaKotorFull<1){
		$jumlhaAlfaKotorFull=30;
	}
?>
	<?php
	$persentasHadir = (($d['hadir'] + $d['sakit']) / $jumlhaAlfaKotorFull) * 100;
	?>
	<tr>
		<td class="text-center" width="40px"><?= $no . '.'; ?></td>
		<td><?= $d['nama_karyawan'] ?></td>
		<td><?= number_format($persentasHadir, 0) . '% ' ?></td>


		<td><?= 'Rp.' . rupiah($d['gapok']) ?></td>


		<td>

			<?php
			$tuk = 0;
			if ($persentasHadir < 80) {
				$tuk = 0;
			} else {
				$tuk = $d['tdisplin'];
			}
			?>
			<?= $persentasHadir < 80 ? '~ kehadiran belum cukup ' : 'Rp. ' . rupiah($d['tdisplin']) ?>
		</td>


		<?php
		//logika hadir dengan remisi libur
		$potongan = 0;
		$formula = $d['gapok']  + $tuk;

		if (($d['hadir'] + $d['sakit']) < $jumlhaAlfaKotorFull - 2) {
			$potongan = $d['status_displin'] * $d['pdisplin'];
			$formula = (($d['gapok'] / $jumlhaAlfaKotorFull) * ($d['hadir'] + $d['sakit'])) - ($d['status_displin'] * $d['pdisplin']) + $tuk;
		}
		$gajiDiterima= 'Rp.' . rupiah($formula);
		$totsal+= $formula;

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

		<td>
			<?= $gajiDiterima;  ?>
		</td>
	</tr>
<?php $no++;
	$totsal ;
} ?>
<tr>
	<td colspan="5">
		<h3>
			Total Gaji Yang Dikeluarkan
		</h3>
	</td>
	<td>
		<h3>
			<?= 'Rp.' . rupiah($totsal); ?>
		</h3>
	</td>
</tr>
