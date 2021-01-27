							<?php 
										$n=0;
											foreach ($Tmpkaryawan as $data) {
												$n++;

											?>
										<tr>
											<td class="text-center"><?= $n ?></td>
											<td><?= $data['nama_karyawan_tmp'] ?></td>
											<td><?= $data['nohp_tmp'] ?></td>
											<td><?= $data['alamat_tmp'] ?></td>
											<td class="text-center">-</td>
											<?php 	
											}
										 ?>
										</tr>