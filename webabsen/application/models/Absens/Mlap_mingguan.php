<?php
class Mlap_mingguan extends CI_Model
{
	protected $tabel = 'jadwal_absen_karyawan';
	public function getall()
	{
	return $this->db->query("SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,
				 
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
				GROUP BY `id_karyawan`;")->result_array();
	}
	
	public function shows($param)
	{

		echo $dateStart=date("Y-m-d", strtotime($param['awal']));
		echo $dateEnd=date("Y-m-d", strtotime($param['akhir']));


		// $dateStart="2021-02-06";
		// $dateEnd="2021-02-09";


		// 		return $this->db->query("
		// 					SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,
		// (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` != 'null'AND `status_kehadiran` != '0'  AND `tanggal` BETWEEN '$dateStart' AND '$dateEnd'  )
		// 				 AS hadir,
		// (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's' AND `tanggal` BETWEEN '$dateStart' AND '$dateEnd' )
		// 				 AS sakit,
		// 				 				 `rentangSet`,


		// (SELECT COUNT(`status_displin`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_displin` != 'null'AND `status_displin` = '0' AND `tanggal` BETWEEN '$dateStart' AND '$dateEnd' ) AS status_displin

		// 				 FROM `jadwal_absen_karyawan` 
		// 				JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
		// 				JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
		// 				JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
		// 				GROUP BY `id_karyawan`;
		// 			")->result_array();
// 		return $this->db->query("SELECT nama_karyawan,`lokasi`,attCount('1',$dateStart,$dateEnd,id_karyawan) AS hadir,
// attCount('s',$dateStart,$dateEnd,id_karyawan) AS sakit,
// `rentangSet`,
// attCountDisplin('1',$dateStart,$dateEnd,id_karyawan)  AS status_displin
// FROM `jadwal_absen_karyawan` 
// JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
// JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
// JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
// GROUP BY id_karyawan
// ;")->result_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,
 
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
GROUP BY `id_karyawan`;")->result_array();
	}
}
