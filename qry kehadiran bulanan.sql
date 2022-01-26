SELECT `id_karyawan`,nama_karyawan,`lokasi`,
attCount('1',
STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 1, 2),'-',SUBSTRING(`rentangSet`, 4, 2)),'%Y-%m-%d'),
STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 14, 2),'-',SUBSTRING(`rentangSet`, 17, 2)),'%Y-%m-%d'),
id_karyawan) AS hadir,

attCount('0',
STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 1, 2),'-',SUBSTRING(`rentangSet`, 4, 2)),'%Y-%m-%d'),
STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 14, 2),'-',SUBSTRING(`rentangSet`, 17, 2)),'%Y-%m-%d'),
id_karyawan) AS alfa,

attCount('s',
STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 1, 2),'-',SUBSTRING(`rentangSet`, 4, 2)),'%Y-%m-%d'),

STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 14, 2),'-',SUBSTRING(`rentangSet`, 17, 2)),'%Y-%m-%d'),
id_karyawan) AS sakit,

attCountDisplin('1',
STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 1, 2),'-',SUBSTRING(`rentangSet`, 4, 2)),'%Y-%m-%d'),

STR_TO_DATE(CONCAT('2022-',SUBSTRING(`rentangSet`, 14, 2),'-',SUBSTRING(`rentangSet`, 17, 2)),'%Y-%m-%d'),
id_karyawan)  AS status_displin,
				 tanggal,
				`rentangSet`,
				`tb_jabatan`.`gapok` AS gapok,
				`tb_jabatan`.`tunjangan_disiplin` AS tdisplin,
				`tb_jabatan`.`potongan_disiplin` AS pdisplin
FROM `jadwal_absen_karyawan` 
JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
JOIN `tb_jabatan` ON `tb_jabatan`.`id_jabatan`=karyawan.`jabatan_id`
WHERE `rentangSet` LIKE '%02/%' AND `rentangSet` LIKE '%/2022%'
GROUP BY id_karyawan;

SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,`nama_jabatan`,
				 
				(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` != 'null'AND `status_kehadiran` != '0' )
				 AS hadir,

				 (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's')
				 AS sakit,
				 
				  (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 'i')
				 AS izin,
				 (SELECT COUNT(`status_displin`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_displin` != 'null' AND `status_displin` = '0')
				 AS status_displin,
				 tanggal,
				`rentangSet`,
				`tb_jabatan`.`gapok` AS gapok,
				`tb_jabatan`.`tunjangan_disiplin` AS tdisplin,
				`tb_jabatan`.`potongan_disiplin` AS pdisplin
				 FROM `jadwal_absen_karyawan` 
				JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
				JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
				JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
				JOIN `tb_jabatan` ON `tb_jabatan`.`id_jabatan`=karyawan.`jabatan_id`
				WHERE  MONTH(tanggal)='$v' AND YEAR(tanggal)='$thun' 
				GROUP BY `id_karyawan`