						<?php $no = 1;
						foreach ($data as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_jadwal'] ?></td>
								<td><?= $d['rentang_tanggal'] ?></td>
								<td><?= $d['id_shift_absensi'] ?></td>
								<td><?= $d['id_lokasi_absensi'] ?></td>
								<td><?= $d['id_karyawan_absensi'] ?></td>
								<td class="text-center" width="60px">
									<a href="javascript:void(0)" onclick="edit('<?= $d['id_jadwal'] ?>')"><i class="icon-pencil7 text-green" data-toggle="tooltip" data-original-title="Edit Data"></i></a>
									<a href="<?= site_url('Absens/JadwalAbsenKaryawan/destroy/' . $d['id_jadwal']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
								</td>
							</tr>
						<?php $no++;
						} ?>