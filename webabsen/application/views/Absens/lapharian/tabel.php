<?php $no = 1;
						foreach ($dataVar as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td><?= $d['tanggal'] ?></td>
								<td><?= $d['jam_masuk'] ?></td>
								<td><img class="foto" src="<?= $d['foto_masuk'] ?>"></td>
								<td><?= $d['jam_keluar'] ?></td>
								<td><img class="foto" src="<?= $d['foto_keluar'] ?>"></td>
								<td><?= $d['status_kehadiran'] ?></td>
							</tr>
						<?php $no++;
						} ?>