SELECT `nama_karyawan`,`lokasi`   FROM `jadwal_absen_karyawan` 
JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
GROUP BY `id_karyawan`
;



SELECT `nama_karyawan`,`lokasi`, `status_kehadiran`

(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` ) AS HADIR   

FROM `jadwal_absen_karyawan` 
JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
GROUP BY `id_karyawan`
;

SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,
 
(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = '1')
 AS hadir,

 (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's')
 AS sakit,
 
  (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 'i')
 AS izin

 FROM `jadwal_absen_karyawan` 
JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
GROUP BY `id_karyawan`