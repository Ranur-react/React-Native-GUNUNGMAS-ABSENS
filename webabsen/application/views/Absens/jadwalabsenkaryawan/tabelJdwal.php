						<?php $no = 1;
						foreach ($dataJadwal as $d) { ?>
							<tr>
								<td class="text-center" width="40px"><?= $no . '.'; ?></td>
								<td><?= $d['id_jadwal'] ?></td>
								<td><?= $d['tanggal'] ?></td>
								<td><?= $d['ket_waktu'] ?></td>
								<td><?= $d['lokasi'] ?></td>
								<td><?= $d['nama_karyawan'] ?></td>
								<td class="text-center" width="60px">
									<!-- <a href="javascript:void(0)" onclick="edit('<?= $d['id_jadwal'] ?>')"><i class="icon-pencil7 text-green" data-toggle="tooltip" data-original-title="Edit Data"></i></a> -->
									<a href="<?= site_url('Absens/JadwalAbsenKaryawan/destroy/' . $d['id_jadwal']) ?>" onclick="return confirm('Yakin akan hapus data ini ?');"><i class="icon-trash text-red" data-toggle="tooltip" data-original-title="Hapus Data"></i></a>
								</td>
							</tr>
						<?php $no++;
						} ?>