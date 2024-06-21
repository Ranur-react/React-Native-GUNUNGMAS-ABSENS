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
								<td>
									
									<?php
										$c=$d['status_kehadiran'];
									if ($c !==0 & $c !== null){
										if ($c == "m") {
										echo "Masuk";
											# code...
										}else if ($c == "i") {
										echo "Izin Tidak Masuk";

											# code...
										}else if ($c == "s") {
										echo "Sakit Tidak Masuk";
											# code...
										}


										else{
										echo "Hadir";

										}
									}
									else {
										echo "Alpa";
									}

									 ?>
								</td>
								

              <td>
              	<?php
										$c=$d['status_kehadiran'];
									if ($c !==0 & $c !== null){
										if ($c == "i") {?>

														<a href="<?= $d['surat_izinnya'] ?>" download class="btn btn-app">
              										  <i class="fa fa-download"></i> Download File
            										  </a>
											<?php
											# code...
										}else if ($c == "s") {?>
														<a href="<?= $d['surat_sakitnya'] ?>" download class="btn btn-app">
              											  <i class="fa fa-download"></i> Download File
            											  </a>
            								 <?php
											# code...
										}


									}
									
									 ?>
              	

								</td>
							</tr>
						<?php $no++;
						} ?>